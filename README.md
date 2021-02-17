# Teste Full Stack(PHP/Vue) - Pesquisa de Satisfação
**Tecnologias utilizadas:**
PHP, MySQL, Rest, Lumen, ORM, Docker

**Objetivo:**
API de avaliações para medir a experiência dos clientes

**Descrição:**
O sistema a ser feito deverá ajudar a empresa a medir o nível de satisfação que os clientes tem da marca, para isso, o cliente deverá poder dar uma nota (0 a 10), e receber um comentário em que a mesma deve indicar o que gostou ou não.

## Módulos obrigatórios:
**Clientes**
- Criar um cliente (POST) recebendo o nome, email(validar), telefone(validar) e cpf (validar);
- Retornar os clientes cadastrados (GET);
- Editar dados do cliente (PUT);
- Inativar/Excluir um cliente (DELETE);

**Transações / Experiências**
- Criar uma transação experiência de cliente(POST), em uma loja(desejável), com participação de um
colaborador (desejável) em data informada (validar) que tinha um valor específico (validar);
- Editar os dados da transações (PUT);

**Avaliação da experiências**
- Receber as avaliações com a nota e um comentário que serão respondida pelo cliente baseado na transação/experiência(POST);
- Retornar todas as avaliações (GET);

##**Módulos opcionais:**
- **Colaborador**​ (Entidade que participa da transação)
  - Criar um colaborador com nome (POST);
  - Editar um colaborador (PUT);
  - Retornar os colaboradores (GET);
  - Excluir/Inativar colaboradores;

- **Loja**​ (Local em que a pessoa teve a transação/experiência)
  - Criar uma unidade comum nome (POST)
  - Editar o nome (PUT)
  - Retornar as unidades disponíveis (GET)
  - Excluir/Inativar unidades (DELETE)

**Obs:**
Os módulos deverão conter validações básicas dos dados em todos os métodos para poder executar as
operações.

**Pontos que serão observados:**
-  Capacidade de entrega;
-  Rotas coesas com a funcionalidade;
-  Organização de código, utilizando padrões OO;
-  Versionamento do código usando GIT;
-  Instruções corretas para levantar aplicação (Read Me);
-  Utilização de containers (docker) para rodar sistemas em qualquer lugar;
-  Modelagem correta do BD;
-  Diagrama de entidade-relacionamento para o BD;
-  Composer para gerenciamento de dependências;
-  Elaborar documentação da API seguindo recomendações OpenAPI;
-  Utilização de framework PHP para API Rest (Lumen, Slim);
-  Utilização de ORM para conexão ao banco de dados;

## Como executar a aplicação

```bash

# Scripts
$ sh scripts.sh

```