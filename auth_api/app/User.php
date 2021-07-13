<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UsuariosResetPasswordNotification;
use App\Plano;

use PagarMe\Client as PagarMe;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'image', 'role_id', 'username',
        'fone','cep','cidade','endereco','estado',
        'numero','complemento','bairro',
        'pais'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco
    URL determinada no .env */
    public function getImageAttribute($value) {
        if($value) {
            return config('app.url').'uploads/usuarios/'.$value;
        }
    }

    /* Atribuir USUÁRIO a uma ROLE. (Usuários são pertencentes a uma role - belongsTo) */
    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function especialidades(){
        return $this->hasMany('App\MedicosEspecialidade', 'user_id');
    }

    public function userespecialidades(){
        return $this->hasMany('App\UserEspecialidade', 'user_id');
    }

    public function especialidadeslogs(){
        return $this->hasMany('App\UserEspecialidadeLog', 'user_id');
    }

    public function perguntas(){
        return $this->hasMany('App\Pergunta');
    }

    public function respostas(){
        return $this->hasMany('App\Resposta');
    }

    public function cartoes(){
        return $this->hasMany('App\Cartao');
    }

    public function transacoes(){
        return $this->hasMany('App\Transacao', 'user_id');
    }

    public function avaliacoes(){
        return $this->hasMany('App\Avaliacao', 'user_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UsuariosResetPasswordNotification($token));
    }

    /* Verificar e validar tipo do usuário */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }

        return $this->hasRole($roles);
    }

    /* Verificação de múltiplas roles */
    public function hasAnyRole($roles)
    {
        return null !== $this->role()->whereIn('id', $roles)->first();
    }

    /* Verificação role única */
    public function hasRole($role)
    {
        return null !== $this->role()->where('id', $role)->first();
    }

    //Validar se cliente possui saldo de perguntas
    public function hasQuestionsRemaining(){

        $lastAssinatura = $this->assinaturas()->where('status','!=','canceled')->latest()->first();

        //Se não possuir assinatura, o usuario esta com plano gratuito (id - 1)
        if(!$lastAssinatura){

            $plano = Plano::where('id',1)->first();

            $perguntas = $this->perguntas()->whereNull('assinatura_id')->get();

            if(count($perguntas) < $plano->perguntas){
                return true;
            }else{
                return false;
            }

        }else{

            $plano = Plano::where('id',$lastAssinatura->api_plan_id)->first();

            $dt1 = date("Y-m-d", strtotime($lastAssinatura->current_period_start));
            $dt2 = date("Y-m-d", strtotime($lastAssinatura->current_period_end));

            $perguntas = $this->perguntas()
                ->where('assinatura_id',$lastAssinatura->id)
                ->where('created_at','>=',$dt1)
                ->where('created_at','<',$dt2)
                ->get();

            if(count($perguntas) < $plano->perguntas){
                return $lastAssinatura;
            }else{
                return false;
            }

        }
    }

    //Retornar perguntas restantes contador
    public function questionsRemainingCounter(){

        $lastAssinatura = $this->assinaturas()->where('status','!=','canceled')->latest()->first();

        if(!$lastAssinatura){

            $plano = Plano::where('id',1)->first();
            $perguntas = $this->perguntas()->whereNull('assinatura_id')->get();
            $diff = ($plano->perguntas - count($perguntas));
            return $diff;

        }else{

            $plano = Plano::where('id',$lastAssinatura->api_plan_id)->first();

            $dt1 = date("Y-m-d", strtotime($lastAssinatura->current_period_start));
            $dt2 = date("Y-m-d", strtotime($lastAssinatura->current_period_end));

            $perguntas = $this->perguntas()
                ->where('assinatura_id',$lastAssinatura->id)
                ->where('created_at','>=',$dt1)
                ->where('created_at','<',$dt2)
                ->get();

            $diff = ($plano->perguntas - count($perguntas));
            return $diff;
        }
    }

    //Validar se cliente possui saldo de trocas de especialidades
    public function hasChangesRemaining(){

        $lastAssinatura = $this->assinaturas()->where('status','!=','canceled')->latest()->first();

        //Se não possuir assinatura, o usuario esta com plano gratuito (id - 1)
        if(!$lastAssinatura){

            $plano = Plano::where('id',1)->first();

            $useresp = $this->especialidadeslogs()->whereNull('assinatura_id')->get();

            if(count($useresp) <= $plano->trocas_especialidade){
                return true;
            }else{
                return false;
            }

        }else{

            $plano = Plano::where('id',$lastAssinatura->api_plan_id)->first();

            $dt1 = date("Y-m-d", strtotime($lastAssinatura->current_period_start));
            $dt2 = date("Y-m-d", strtotime($lastAssinatura->current_period_end));

            $esp = $this->especialidadeslogs()
                ->where('origem','like','troca_de_especialidade')
                ->where('assinatura_id',$lastAssinatura->id)
                ->where('created_at','>=',$dt1)
                ->where('created_at','<',$dt2)
                ->get();

            if(count($esp) < $plano->trocas_especialidade){
                return $esp;
            }else{
                return false;
            }
        }
    }

    //Contador de trocas de especialidades restantes
    public function changesRemainingCounter(){
        $lastAssinatura = $this->assinaturas()->where('status','!=','canceled')->latest()->first();

        if(!$lastAssinatura){

            $plano = Plano::where('id',1)->first();

            $useresp = $this->especialidadeslogs()->whereNull('assinatura_id')->get();

            $diff = ($plano->trocas_especialidade - count($useresp));

            if($diff < 0) {
                $diff = 0;
            }

            return $diff;

        }else{

            $plano = Plano::where('id',$lastAssinatura->api_plan_id)->first();

            $dt1 = date("Y-m-d", strtotime($lastAssinatura->current_period_start));
            $dt2 = date("Y-m-d", strtotime($lastAssinatura->current_period_end));

            $esp = $this->especialidadeslogs()
                ->where('origem','like','troca_de_especialidade')
                ->where('assinatura_id',$lastAssinatura->id)
                ->where('created_at','>=',$dt1)
                ->where('created_at','<',$dt2)
                ->get();

            $diff = ($plano->trocas_especialidade - count($esp));

            return $diff;
        }
    }

    //Verificar se possui assinatura ativa
    public function hasAssinatura(){
        $lastAssinatura = $this->assinaturas()->where('status','!=','canceled')->latest()->first();

        if($lastAssinatura){
            return $lastAssinatura;
        }else{
            return false;
        }
    }
}
