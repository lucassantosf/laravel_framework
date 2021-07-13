## Requisitos
- PHP 7.1 ou +
- MSYQL/PHPMyADMIN (Windows: Recomendado usar WAMP - http://www.wampserver.com/en/)
- Composer (https://getcomposer.org/)

## Como utilizar
- 1) Renomeie o arquivo ".env.example" para ".env" e e configure os campos APP_URL com a URL completa do projeto, DB_DATABASE com o nome do banco de dados criado no PHPMYADMIN, DB_USERNAME e DB_PASSWORD com login e senha do banco de dados. (Utilize o WAMP caso utilize Windows e acesse o PHPMYADMIN para criar o banco de dados para o site.)
- 2) No terminal digite (sem aspas): "composer install" - Para que seja instalado todas as dependências do LARAVEL
- 3) Após instalar as dependências do LARAVEL, digite no terminal (sem aspas): "php artisan key:generate" - Para gerar sua chave de aplicação parar encriptar seus dados.
- 4) No terminal digite (sem aspas): "npm install" - Para que seja instalado todas as dependências do WEBPACK
- 5) No terminal digite (sem aspas): "php artisan migrate --seed" - Para que o sistema crie todas as tabelas e colunas do banco de dados e popule com informações fake de acordo com as Migrations criadas.
- 6) No terminal difite (sem aspas): "php artisan passport:install" para que o sistema crie o "secret" para acesso via api utilizando passport. O secret tipo "passoword" será utilizado na requisição de autenticação da API
- 7) Para rodar o webpack: "npm run watch" - Para monitorar alterações. "npm run production" - Para compilar e minificar para produção.

Obs.: É necessário que o seu ambiente de produção tenha o PHP 7.2 configurado. (Para usuários Windows, utilize o Wamp.)

## Regras de utilização do GIT
- 1) Antes de qualquer alteração, verifique se há diferença entre local e repositório (git status).
- 2) Utilize apenas sua branch (git checkout -b idtarefa_dev) para atualizações, nunca a MASTER. Caso aconteça, dê um rollback e refaça a ação com a branch correta.
- 3) Não esqueça de comentar (git commit -m "sua mensagem entre aspas") de forma coerente, detalhada e de fácil entendimento.
- 4) Todas as branches deverão dar MERGE na RELEASE, pois é a branch de homologação. O merge na master deverá ser feito apenas após o site ser entregue.
- 5) Em caso de mais de um desenvolvedor no projeto, deve-se criar as branches de acordo com sua função. Exemplo: Para 1 DEV = id_dev ou dev. Para 2 ou mais DEVs = id_fx_dev (frontend), id_bx_dev (backend). Onde 'x' é o número de devs, exemplo: id_b1_dev, id_b2_dev.

## Regras de utilização do LARAVEL
- 1) Não utilize tags <?php?> nas views. Toda e qualquer manipulação de dados devem ser feitas no CONTROLLER. Em caso de necessidade, utilize as blades: @if - @endif, @foreach - @endforeach, @php - @endphp.
- 2) Utilize os ELOQUENTS que o sistema possui para criar vínculos de conteúdo. Ex.: Categoria 'belongsTo' Post. Post hasMany Categorias https://laravel.com/docs/5.7/eloquent
- 3) Utilize o AppServiceProvider para enviar informações fixas no site. Exemplo: informações de HEADER e FOOTER aparecem em todas as páginas. Instâncie o MODEL > Dentro da função COMPOSER envie a informação. (Possui exemplo pronto do usuário logado)
- 4) O CMS já possui listagem de Cidades e Estados, utilize nos selects. Existe uma função que faz a busca de cidades de acordo com a escolha de estados.
- 5) Há um arquivo JS chamado CUSTOM.JS em '/public/assets/cms/js' com funções de máscara para os inputs. Caso não possua alguma máscara específica, adicione conforme necessidade. (https://igorescobar.github.io/jQuery-Mask-Plugin/)