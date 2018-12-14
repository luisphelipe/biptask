# Bip Task - Luis Phelipe
   
## Hospedado em: https://bip.luisphelipe.me

## Instruções para usar em localhost    
    
git clone https://github.com/luisphelipe/biptask    
cd biptask    
    
abrir mysql e criar database para ser usada    
copiar .env.example para .env (copy .env.example .env) e configurar:   
1. valores referente a database
2. Token da API do Twitter 
   
### Executar os comandos     
   
1. php composer install
2. php artisan migrate   
3. php artisan serve   

## Considerações
   
Há muito espaço para melhora, vou listar algumas das coisas que me vem a cabeça    
1. Permitir o usuario ter controle dos parametros que a API do twitter oferece, como linguagem e regiao.
2. Implementar Model/Migration para gerar e retornar JWT, caso o ultimo esteja expirado.
3. Fazer uma melhor separacao do view em componentes de vue.js    
4. Padronizar os nomes usados no backend e frontend
5. ...
