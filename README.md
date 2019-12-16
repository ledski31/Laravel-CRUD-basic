# CRUD básico PHP com Laravel

### Iniciar
Para testar o projeto, é necessário ter instalado php e composer, e ter os dois no PATH do sistema.
Digite no diretório raiz do projeto o seguinte:

`> composer install`

Para instalar as dependências do projeto.

`> php artisan serve`

Para iniciar o servidor, e mostrar o endereço que deve ser digitado no navegador.
O endereço irá mostrar a página de teste da API Funcionários.

### Página de teste da API
Cada seção da página de teste é referente a um dos endpoints da API, e o endpoint está escrito no cabeçalho das seções. Toda seção possui um botão para fazer a requisição correspondente. Todos os endpoints da API retornam
exclusivamente uma resposta no formato JSON. O formato do JSON é comum a todos os endpoints, e é da seguinte forma:

`{`  
`"error": "mensagem de erro se houver ou então null",`\
`"data": "dados retornados da api"`\
`}`  

O campo "ID do registro" da seção de Modificar registro, e os campos "Cargo" fazem uma requisição  para a api
sempre que modificados, para poder atualizar a visualização dos campos, mas não fazem parte da demosntração
principal da API. As chamadas através dos botões é que são a demonstração principal.

### Base de dados
A base de dados usadas é Sqlite por motivos de facilidade de uso para o teste. Um arquivo da base de dados
já está incluso no projeto com alguns registros já inseridos.

### Arquivos
Os princiapis arquivos do projeto são:


`/routes/web.php`\
`/views/funcionarios-pannel.blade.php`\
`/views/layout-basic.blade.php`\
`/database/leandro.sqlite`\
`/database/factories/FuncionarioFactory.php`\
`/database/migrations/2014_10_12_000000_create_users_table.php`\
`/database/migrations/2014_10_12_100000_create_password_resets_table.php`\
`/database/migrations/2019_08_19_000000_create_failed_jobs_table.php`\
`/database/migrations/2019_12_14_203201_create_cargos_table.php`\
`/database/migrations/2019_12_14_211841_create_funcionarios_table.php`\
`/Http/Cargo.php`\
`/Http/Funcionario.php`\
`/Http/Requests/FuncionarioSaveValidation.php`\
`/Http/Controllers/CargoCtrl.php`\
`/Http/Controllers/FuncionarioCtrl.php`\
`/setupBasicDB.php`\
`/resetDB.bat`
