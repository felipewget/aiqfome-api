## Etapas do desenvolvimento.

## 1. Analizando requisitos e o que vou desenvolver antes da implementacao
- Evitar duplicidade dedados
- Posso escolher entre diversas linguagens
- API documentation
- Tem q ser escalavel, performatico e com boas praticas
- Regras de negocios envolvendo uma API, favoritos e login

## 2. Selecionando as stacks

### Banco de dados: PostgreSQL
- Escolhi o PostgreSQL por que tem uma tag "preferencial" nos requisitos e tambem por que e mais robusto em tipagem de dados que o Mysql.
- Mongodb eu to considerando ma pegadinha uma vez que MongoDB nao e um banco relacional e isso propicia um ambiente de duplicidade de dados em favor da performance.
- Ja estava claro que iria selecionar um banco com o SQL quando li "Evite duplicidade de dados"

#### Linguagem escolhida: PHP com Laravel
- Na vaga esta escrito conhecimento em PHP ou Python: https://remotar.com.br/job/99698/magazine-luiza/desenvolvedor-backend-senior
"Para Essa Vaga é Preciso: Que experiência sólida com PHP ou python: você já deve ter construído sistemas complexos e de alta performance."
-  Laravel e um dos frameworks mais robustos e completos que eu ja conheci
- Ponto fraco de escolher PHP
--- Node tem um controle de thread melhor que o PHP com o event loop e tenho conhecimento profundo em node, eu usari o NestJS no caso
-- Golang e uma linguagem mais performatica que o PHP e consegue regenciar a memoria muito bem... mas eu nao tenho um conhecimento profundo em Golang, ainda.

## 3. Como vou desenvolver(Tem q ser escalavel, performatico e com boas praticas)

- Tenho uma ideia aki, a API generica nao e voltada pro nosso sistema, por causa disso e vou fazer um decorator ou proxy pattern, com isso nos conseguimos adicionar a API como composicao e usar nosso cliente, podemos ate usar mocks ou outras libs com facilidade e sem quebrar a nossa regra de negocio, deixando o codigo simples.
- Cache aside: O ideal e que nao facamos a msm requisicao pra uma API externa num intervalo curto de tempo, ainda mais um GET de listagem de produtos onde os dados podem ter um delay sem afetar a aplicacao.
- TDD -> vou desenvolver testes primeiro, implementar o codigo e rodar o teste, vou usar o PHP unit ou Pest PHP pra isso
- Docker -> uma vez que a aplicacao esta dentro do container, vai ser facil escalar com um genreciador de container... um load balancer + escalonamento horizontal
- Indexes no banco de dados pode ser uam boa, posso adicionar shards tambem, mas isso teria que ser acordado com o time primeiro pra ver como eu criaria os shards, acho que por id do produto ou nome
- Usar S.O.L.I.D e o que vi em object calistenics pra melhorar a qualidade do codigo
- Uma replica no banco de dados talvez? acho que ja seria dms pra uma primeira versao que ainda e um PoC
- Vou adicionar umas thread pools + connections pools pra melhorar a plataforma

Lista de favoritos por cliente
- Tava pensando em fazer 1 to many mas talvez nao seja uma boa ideia por que eu duplicaria os produtos, ao inves disso vou fazer uma relacao poliformifca no banco de dados, pra nao repetir dados
- Pro login eu acho que o proprio laravel ja da suporte, eu so acho que vou alterar de verificacao de sessao em memoria pra JWT, com isso eu consigo melhorar a performance, Laravel tem um sistema de blacklist quando se desloga e com isso msm que o JWT seja assinado pra 50 dias, se deslogado, o Laravel comeca a rejeitar o JWT anterior.
- Nao vejo motivo pra adicionar queues uma vez que nao se tem um mega processamento de dados ao aditionar um item na lista de favoritos, nao vou aditionar queues

----

Vou abreviar esse projeto pra 

AQF(AiQueFome), com isso posso criar tarefas AQF-1, AQF-2... a AQF-1 vai ser o setup inicial por exemplo

@author Felipe Oliveira