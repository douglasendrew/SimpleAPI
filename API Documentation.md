    ### Como fazer autenticação na API? ###
    
    - Pegar o token do cliente
    - Nome de usuario da sua conta (Email)
    - Client-Id

    Obs: tudo pode ser extraido no painel do cliente.

    Exemplo de chamada com os parametros obrigatorios: 
    
    curl -i -H "Token: {{Token}}" -H "Usuario: {{Usuario}}" -H "Client-Id: {{Client-Id}}" https://api.excelent.com.br/