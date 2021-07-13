@component('mail::message')
# Olá, {{ $data['name'] }}!

Criamos uma conta para você.
Sua senha de acesso é: {{ $data['password'] }}

@component('mail::button', ['url' => route('dashboard')])
Acessar painel
@endcomponent

Atenciosamente,<br>
Equipe EmpresaNome
@endcomponent
