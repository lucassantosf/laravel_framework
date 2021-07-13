<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['json.response','cors'], 'prefix' => 'v1'], function () {

    // public routes
    Route::post('/usuario/login', 'Api\UsersController@post_login')->name('api.user.login');
    Route::post('/usuario/cadastro', 'Api\UsersController@post_register')->name('api.user.register');
    Route::post('/usuario/pwemail', 'Api\ForgotPasswordController@sendResetLinkEmail')->name('api.user.forgotpw');
    Route::get('/termosdeuso', 'Api\InformacoesController@get_termosdeuso')->name('api.infos.termosdeuso');

    Route::post('/retornos/postback/pagarme', 'Api\PostbackController@post_back_pagarme_transacions')->name('api.retorno.postback');

    // private routes
    Route::middleware('auth:api')->group(function () {

        //Gerais
        Route::put('/usuario/cadastro', 'Api\UsersController@put_profile')->name('api.user.update'); //32/33
        Route::get('/usuario/logout', 'Api\UsersController@get_logout')->name('api.user.logout');
        Route::get('/usuario/dados', 'Api\UsersController@get_dados')->name('api.user.dados');
        Route::post('/usuario/pwconfirm', 'Api\UsersController@post_password_confirm')->name('api.user.pwconfirm');//40/47

        //Especialidades
        Route::get('/usuario/especialidades', 'Api\UsersController@get_especialidades')->name('api.user.especialidades.get');//16
        Route::put('/usuario/especialidades', 'Api\UsersController@put_especialidades')->name('api.user.especialidades'); //11
        Route::post('/usuario/especialidade', 'Api\UsersController@put_especialidade_usuario')->name('api.user.especialidade');//14
        Route::get('/usuario/especialidades/restantes', 'Api\UsersController@get_especialidades_restantes')->name('api.user.especialidades.restantes');//14 - contador

        Route::post('/usuario/especialidade/alterar', 'Api\UsersController@post_especialidade_alterar')->name('api.user.especialidade.alterar');//18
        Route::get('/especialidades', 'Api\EspecialidadesController@get_lista')->name('api.especialidades.lista');// 10
        Route::get('/busca/especialidades/{busca}', 'Api\EspecialidadesController@get_especialidadesbusca')->name('api.especialidades.busca');// 10

        //Perguntas
        Route::get('/perguntas/medico', 'Api\PerguntasController@get_lista_medico')->name('api.perguntas.medico.lista'); // 12
        Route::get('/usuario/perguntas/realizadas', 'Api\UsersController@get_perguntas_realizadas')->name('api.user.perguntas.realizadas');//15 - contador
        Route::get('/usuario/perguntas/realizadas/list', 'Api\UsersController@get_perguntas_realizadas_list')->name('api.user.perguntas.realizadas.list');//15
        Route::get('/usuario/perguntas/respondidas', 'Api\UsersController@get_perguntas_respondidas')->name('api.user.perguntas.respondidas');//12/15 - contador
        Route::get('/usuario/perguntas/restantes', 'Api\UsersController@get_perguntas_restantes')->name('api.user.perguntas.restantes');//13 - contador

        Route::post('/pergunta', 'Api\PerguntasController@post_pergunta')->name('api.pergunta.post');//24
        Route::put('/pergunta', 'Api\PerguntasController@put_pergunta')->name('api.pergunta.put');//24
        Route::post('/pergunta/responder', 'Api\RespostasController@post_resposta')->name('api.resposta.post');
        Route::put('/pergunta/responder', 'Api\RespostasController@put_resposta')->name('api.resposta.put');
        Route::post('/pergunta/avaliar', 'Api\PerguntasController@post_pergunta_avaliar')->name('api.pergunta.avaliar.post');
        Route::put('/pergunta/avaliar', 'Api\PerguntasController@put_pergunta_avaliar')->name('api.pergunta.avaliar.post');

        Route::post('/filtro/perguntas', 'Api\PerguntasController@post_perguntas_filtro')->name('api.perguntas.filtro');//27
        Route::get('/pergunta/{id}', 'Api\PerguntasController@get_pergunta')->name('api.pergunta');//23/29

        //Cartão
        Route::get('/usuario/cartoes','Api\CartaoController@get_cartoes_list')->name('api.user.cartoes'); // 35
        Route::post('/usuario/cartao','Api\CartaoController@post_cartao')->name('api.user.cartao.post'); // 37
        Route::get('/usuario/cartoes/brand/{brand}','Api\CartaoController@get_cartao_by_bandeira')->name('api.user.cartao.brand'); // 44
        Route::get('/usuario/cartao/{token}','Api\CartaoController@get_cartao_by_token')->name('api.user.cartao.token'); // 46
        Route::delete('/usuario/cartao/{token}','Api\CartaoController@destroy_cartao_by_token')->name('api.user.cartao.destroy'); // 39
        Route::put('/usuario/cartao/{token}','Api\CartaoController@put_cartao')->name('api.user.cartao.put'); // 42,

        //Pacotes(Disponíveis para venda)
        Route::get('/pacotes', 'Api\PacotesController@get_lista')->name('api.pacotes.lista'); // 30
        Route::get('/pacotes/{id}', 'Api\PacotesController@get_plano_dados')->name('api.pacotes.dados'); // 34

        //Pacotes(Compras)
        //Post Pacote
        Route::post('/usuario/pacote','Api\PacotesController@post_pacote_compra')->name('api.user.pacote.compra.post'); // --
        //Get user Pacote list
        Route::get('/usuario/pacotes','Api\PacotesController@get_user_pacotes')->name('api.user.pacotes.historico'); // 34
        //Get Pacote
        Route::get('/usuario/pacote/{id}','Api\PacotesController@get_user_pacote')->name('api.user.pacote'); // --
        //Cancelar Pacote
        Route::post('/usuario/pacote/cancel','Api\PacotesController@cancel_pacote')->name('api.user.pacote.cancel'); // --

    });

});
