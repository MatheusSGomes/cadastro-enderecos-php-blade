# API Cadastro de Endereços
API realizada durante o Bootcamp New Thinkers da Squadra.
A proposta do desafio foi criar uma aplicação backend de cadastro de endereços.

## Descrição
Cadastros necessários: UF, MUNICÍPIO, BAIRRO e PESSOA.

Tabelas de UF (tb_uf), Município (tb_municipio), Bairro (tb_bairro), Endereço (tb_endereco) e Pessoa (tb_pessoa).

OBS: O cadastro na tabela de endereços deveria ser feito no endpoint de pessoa.

Respostas 200 para requisições que deram certo e status diferente de 200 para requisições que deram errado.

O projeto deveria ser desenvolvido usando os seguintes itens do Laravel 9:
- Eloquent ORM
- Validação dos dados da Requisição
- Tratamento de erros
- Documentação com Swagger

## Tecnologias
- Laravel 9
- PHP 8.1
- Documentação: OpenAPI / Swagger
- Banco de dados: PostgreSQL

## Endpoints
### UF
- /uf 
- /uf?codigoUF=15&nome=GOIÁS&sigla=GO
- /uf?sigla=GO

### Município
- /municipio 
- /municipio?codigoUF=10&codigoMunicipio=105&nome=Florianópolis
- /municipio?codigoMunicipio=106
- /municipio?codigoMunicipio=109&nome=Goiânia
- /municipio?nome=Cuiabá
- /municipio?status=2

### Bairro
- /bairro 
- /bairro?codigoBairro=15&codigoMunicipio=10&nome=Vila dos Ipês
- /bairro?codigoBairro=12
- /bairro?codigoMunicipio=10&nome=Vila das Pedras
- /bairro?nome=Vila das Pedras
- /bairro?status=2

### Pessoa
- /pessoa
- /pessoa?status=2&codigoPessoa=12&login=diego
- /pessoa?status=2
- /pessoa?codigoPessoa=109&status=1
- /pessoa?login=jose.maria

![](Screenshot-Swagger.png)