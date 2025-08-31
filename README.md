# Documentação da API pra AiQFome

Esta API é integrada com uma API de produtos de terceiros(third-party), lista de produtos favoritos e usuários com autenticação e permissões onde os usuários podem ser **admin** ou **clientes**.

---

## Passo a passo de como testar

1. **Clonar o projeto e configurar:**
   - Faça `git clone` do projeto.
   - Entre na pasta e instale as dependências com `composer install`.
   - Renomeie o arquivo `example.env` para `.env`.
   - Inicie o projeto com `docker compose up`.
   - O projeto esta em container e a aplicação já estará prota pra uso

2. **Usuários disponíveis após iniciar o projeto:**
   - As migrations e seeders serão executadas automaticamente.
   - Você terá acesso a 2 usuários e poderá acessar a aplicação na porta 80:
     - **Admin:** `admin@aiqfome.com.br` | `Me_contrata_ai@123`  
     - **Cliente:** `client@aiqfome.com.br` | `Me_contrata_ai@123`  

3. **Testes da API:**
   - No endpoint `/docs` há uma documentação completa, com sugestões de testes e exemplos de como testar cada endpoint item por item.

---

# O que foi pedido

## Clientes
- Criar, visualizar, editar e remover clientes. (✅ Apenas admin pode gerenciar clientes)
- Dados obrigatórios: nome e e-mail. (✅)
- Um mesmo e-mail não pode se repetir no cadastro. (✅)

## Favoritos
- Um cliente deve ter uma lista de produtos favoritos. (✅)
- Os produtos devem ser validados via API externa. (✅)
- Um produto não pode ser duplicado na lista de um cliente. (✅ Usando relacionamento many-to-many)
- Produtos favoritos devem exibir: ID, título, imagem, preço e review. (✅)

## Regras Gerais
- A API deve ser pública, mas conter autenticação e autorização. (✅)
- Evite duplicidade de dados. (✅)
- Estruture bem o código, seguindo boas práticas REST. (✅)
- Pense em performance e escalabilidade. (✅ Sempre há espaço para melhorias: shard, replicas, mais paginacoes, indexes, microserviços ou modularização)
- Documente sua API (OpenAPI/Swagger é bem-vindo, mas opcional). (✅)
- Não use IA ou cópias. Será passível de eliminação. (✅)

## Linguagem Escolhida
- PHP com Laravel uma vez que PHP ou Python estava como desejavel na vaga e Laravel e um ótimo framwork pra se trabalhar, porem eu poderia usar Node.js (JS/TS) também por que eu sou muito bom, nesse caso usaria o NestJS.

## Banco de Dados
- PostgreSQL, pois o requisito de não duplicidade se enquadra bem aki, em outro ponto, o MongoDB é um banco nao relacional, então ele nao parece ser a melhor escolha se eu nao quero duplicar dados

## Boas praticas utilizadas
- Testes unitarios (Poderia ter feito mais testes)
- S.O.L.I.D
- Object calistenics
- Pull requests(e poderia ter quebrado essa api em mais taferas pequenas)
- Relationship many-to-many pra nao replicar dados
- Design Patterns e cache-aside
- Documentação
- Deployment: Eu to criando Pull Requests pra Devleop e vou fazer um deployment pra main como se fosse em produto, numa situacao real teria a producao -> task  -> dev -> uat -> deploy pra producao... ou RC com cada dev com seu proprio ambiente e candidates release no dev
- Usando dinheiro como string por que isso garante que as operacoes matematicas estarao 100% corretas, calculos envolvendo floats podem apresentar pequenas discrepancias em calculalos matematicos, por exemplo: 0.7 + 0.1 = 0.7999... (facil testar no navegador, developer tools)

Destaque pra Proxy Pattern no API client de produtos uma vez que estou usando composicao pra selecionar a Lib, facilitando a manutancao e a troca de lib se necessario e ate addicao de mocks, tambem adicionei um Singleton no Provider na qual eu adiciono a lib

## O que poderia melhorar

- CD/CI (Buddy?)
- Github Workflow verificando testes automatizados antes do merge
- Shards, replicas e mais indexes
- Adicionar load balancers e DNS por regiao
- Auto scaling
- Search engines 
- Dessacoplar mais ainda as entidades baseado no tamanho da requisicao
- Testes de estresse
- Limites de requisicao por tempo baseado em IP
- Setar o sentry pra receber logs de erros quando/se eles acontecerem
- Produto favoritos poderia ter um contador uma vez que e many-to-many, poderia ter um "quantos clintes favoritaram esse produto"
- Paginacao na API externa de produtos, nos usuarios tambem
- Na minha memoria por agora e isso, mas sempre da pra melhorar