Este projeto tem como objetivo realizar a proposta da rinha de backend de 2024
O projeto não tem a menor intenção de realizar alguma participação na competição, servindo apenas para estudo pessoal.

Caso tenha interesse em ver mais sobre as informações da competição, segue o link da mesma:
[text](https://github.com/zanfranceschi/rinha-de-backend-2024-q1)

endpoint transações: /clientes/[id]/transacoes - Método POST
endpoint extrato: /clientes/[id]/extrato - Método GET

[Regras de Negócio]
RN1 - Uma transação pode ser do tipo crédito ou débito.
RN2 - Uma transação não pode deixar o saldo do cliente menor que seu limite.

[Requisitos Funcionais]

-- Extrato -- 
RF1 - O sistema deve ter um endpoint, que utilize o método GET, onde o cliente pode consultar seu extrato
RF2 - O sistema deve responder com o status 200 na resposta quando uma requisição for bem sucedida.
RF3 - O sistema deve deverá retornar o código 404 como resposta quando o ID fornecido não existir no sistema.   
RF4 - O sistema deve apresentar as informações do saldo atual, a data da consulta do extrato, o limite do cliente e as informações das últimas transações (valor, descrição, tipo e quando foi realizada)               

-- Transação -- 

RF5 - O sistema deve ter um endpoint, que utilize o método POST, onde o cliente pode realizar uma transação de crédito ou débito - RN1 
RF6 - O sistema deve retornar o status 422, sem completar a transação, sempre que uma requisição deixar o saldo cliente inconsistente - RN2
RF7 - O sistema deve retornar o status 422, sem completar a transação, quando um dos campos do payload estiver fora das especificações.
RF8 - O sistema deve retornar o status 404 quando o ID fornecido não existir.

[Requisitos Não Funcionais]
RNF1 - O sistema deve ser compatível com requisições em formato JSON
RNF2 - O sistema deve sempre retornar erros de forma estruturada, contendo o código do erro, mensagem amigável e detalhamento técnico