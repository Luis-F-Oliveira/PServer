# Primeiros Passos

Clone o repositório e instale as dependências:
```
git clone https://github.com/Luis-F-Oliveira/PServer.git
cd ./PServer
composer install
```

# Arquivo .env

Copie o arquivo `.env.example` para criar o arquivo `.env`:
```bash
cp .env.example .env
```

Em seguida, preencha as informações de configuração:

### Configurações da Aplicação
```env
APP_PORT= # Porta que o aplicativo iniciara
FRONTEND_URL= # URL do frontend
```

### Banco de Dados

Certifique-se de preencher as variáveis de conexão com o banco de dados:
```env
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### Configurações para Envio de E-mails

Para enviar e-mails, crie uma senha de aplicativo (ex: para Gmail, pesquise sobre "senha de app"). 

Insira os detalhes nas variáveis de e-mail:
```env
MAIL_USERNAME= # E-mail responsável
MAIL_PASSWORD= # Senha de app
```

# Configurações finais

Gere a chave de aplicação e execute as migrações do banco de dados:
```php
php artisan key:generate
php artisan migrate
php artisan serve
```
