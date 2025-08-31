# Introduction



<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>

Documentação da API pra AiQFome. Uma vez que você execute o docker compose up, as migrations e seeders serão executadas automaticamente, disponibilizando 2 usuários necessários para testes.

Esta API tem 2 tipos de usuários:

- **Cliente (client)**: permissões voltadas pra produtos favoritos e ver seu próprio registro  
- **Admin**: voltado para gerenciamento de clientes, porém não tem acesso à lista de produtos favoritos  

Segue os usuários:

- **Admin:** `admin@aiqfome.com.br` | `Me_contrata_ai@123`  
- **Cliente:** `client@aiqfome.com.br` | `Me_contrata_ai@123`  

Outra coisa importante: você vai precisar do **código JWT** fornecido ao iniciar sessão para testar alguns endpoints.

---

### Sugestão de como testar a API

1. Liste os produtos e o produto por ID — esses endpoints **não necessitam de autenticação**.  
Na segunda vez que essa requisição for feita, será mais rápida e menos custosa, pois será **cacheada**.
2. Faça login com o **admin** — gerencie os clientes, crie novos usuários, edite, delete, liste todos.
3. Faça login com o **cliente** — gerencie produtos favoritos.
4. Acesse o “cria nova sessão” e faça o login.

> Obrigado pela oportunidade desde já.  
> **Autor:** Felipe Oliveira

