# language: pt
Funcionalidade: Saque

  Cenário: Conta possui saldo suficiente
    Dado uma conta com saldo de "100"
    Quando o cliente solicitar um saque de "10"
    Então o saque deve ser autorizado
    E o saldo da conta deve ser "90"

  Cenário: Conta não possui saldo suficiente
    Dado uma conta com saldo de "100"
    Quando o cliente solicitar um saque de "101"
    Então o saque deve ser negado
    E o saldo da conta deve ser "100"
