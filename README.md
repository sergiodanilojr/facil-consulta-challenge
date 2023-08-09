## Desafio Fácil Consulta

### Requisitos

Para inicializar o projeto é necessário ter, preferencialmente, o Docker em sua máquina e ao executar via terminal o comando `docker-composer up -d` dois serviços estarão disponíveis, sendo eles p `laravel.test`que estará executando o Laravel Sail e o `MySQL` que está sendo executado com driver de banco de dados da aplicação.

Como a aplicação está usando o Laravel Sail, é interessante que o seu terminal tenha registrado o `alias` como orienta a documentação do pacote. Configure as entradas do banco no seu arquivo `.env`, caso não esteja disponível, faz-se necessário copiar o arquivo `.env.example` para fazer a entrada a ser lida pelo sistema de configurações do Laravel. 

```bash
cp .env.example .env
sail up -d --build
sail composer install
sail artisan migrate --seed
```

### Usuário padrão

A subir a sua seed um usuário padrão será criado, a fim proporcionar a autenticação pa os endpoints que possuem restrição de acesso, em conformidade com o que fora proposto neste desafio. Abaixo seguem as credenciais deste.

```
email: contato@facilconsulta.com.br
senha: #Facil@Consulta#2023
```

### Observações

Alguns endpoints da aplicação contacom recursos extras, como o carregamento de relacionamentos sob demanda, como exemplifica abaixo.

#### Aninha a cidade na listagem de médicos
```
/api/medicos?with=cidade
```

#### Aninha a medicos na listagem das cidades
```
/api/cidades?with=medicos
```

### Paginação

Por padrão todos os recursos de listagem (`/cidades`, `/medicos`, `/medicos/{medico_id}/pacientes`) são paginados

```
/api/medicos?page=2&per_page=5
```

### Ressalvas

O conjunto de recursos dispostos aqui foi desenvolvido utilizando algumas boas práticas, como a criação de repositórios, para cada recurso existe um repositório respeitando os comportamentos desejados e 'obedecendo' a inversão de controle. As abstrações estão mapeadas no `service container` do laravel através do `\App\Providers\FacilConsultaServiceProvider`, dando garantias de fácil manutenção e desacoplamento de regras dentro dos controllers.

Certamente se esta API tivesse um nível de complexidade maior, e caso algum dia ainda tenha, fica mais tranquila a adoção de modelos arquiteturais mais robustos com foco no domínio da aplicação, permitindo uso de adaptadores na sua estrutura (mas isso é assunto para um outro momento xD).



