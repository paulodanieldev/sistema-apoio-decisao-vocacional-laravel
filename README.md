# AVA

## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

-   Ter PHP instalado na versão 7.4
-   git instalado
-   Composer instalado globalmente
-   Npm instalado globalmente
-   Apache instalado com mod_rewrite
-   Mysql na versão 5.7 ou superior
-   criar chave ssh: https://pplware.sapo.pt/tutoriais/criar-chave-ssh-no-linux/

## 💻 Pré-requisitos para Docker

-   criar instancia com ununtu 20.04 lts (testado)
-   abrir as portas tcp: 80, 8080, 3306, 3308 (na area de redes/network) nginx e mysql (caso não sejam a padrão) configurada no docker-compose-yml
-   adicionar memória swap para evitar travamentos durante a instalação: https://www.digitalocean.com/community/tutorials/how-to-add-swap-space-on-ubuntu-20-04-pt
-   instalar o docker: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04-pt
-   caso precise altenha a senha do usuario: sudo passwd usuario
-   instalar docker-compose: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04-pt
-   git instalado
-   configurar o DB_HOST (MEMCACHED_HOST e REDIS_HOST também se nescessário) no .env (utilizar o ipv4 publico do servidor ou o local da máquina)

## 🌳 Configurando o seu usuário no github ou bitbucket e clonando

-   criar chave no servidor: https://pplware.sapo.pt/tutoriais/criar-chave-ssh-no-linux/
-   adicionar a chave publica às configurações de seu usuário no repositório
-   Clonar o repositório com: git clone git@github.com:paulodanieldev/sistema-apoio-decisao-vocacional-laravel.git

## 🚀 Instalando em servidor php

Instalar dependências (na pasta do projeto):

```
composer install
```

Instalando assets

```
npm install && npm run dev
```

Criar seu próprio .env (com os seus dados):

```
cp .env.example .env
```

Instalar chave:

```
php artisan key:generate
```

Instalar o banco de dados mysql seguindo orientações.

Rodar a Migrate:

```
php artisan migrate
```

Gerar as chaves de autenticação (OAuth Keys).

```
php artisan passport:install
```

## 🚀 Instalando com docker na aws

Atualizar o servidor

```
sudo apt-get update && sudo apt-get upgrade
```

Instalar o make.

```
sudo apt-get install make
```

Instalar o install.sh ou executar maualmente os comandos contidos nele (na pasta do projeto).

```
./install.sh
```

Rodar as migrations - para criação de um banco de dados novo (na pasta do projeto).

```
docker-compose exec app php artisan migrate --path=/database/migrations/backup
```

Rodar as migrations - para banco existente ou após criar as novas tabelas (cria as tabelas de OAuth).

```
docker-compose exec app php artisan migrate
```

Gerar as chaves de autenticação (OAuth Keys).

```
docker-compose exec app php artisan passport:install
```

### Possíveis erros

-   erro cross-env/cross-spaw ao rodar "npm run dev", executar os seguintes passos
    rm -rf node_modules
    rm package-lock.json
    npm install
-   erro Host '172.18.0.1' is not allowed to connect to this MySQL server, ao tentar conectar ao banco de dados
    o ip configurado para a variavel DB_HOST no .env deve ser o ip publico da instancia da aws ou o ip local da maquina
    depois deve matar o container: docker-compose down (ou apenas "make down")
    depois remover a pasta dos volumes do docker: sudo rm -rf .docker/data/
    e por fim iniciar o container novamente: docker-compose up -d (ou apenas make up)

## ☕ Usando o sistema local

Iniciando servidor

```
php artisan serve
```

Ativando compilador

```
npm run watch
```

Acessar:

```
127.0.0.1:8000
```

## ☕ Usando o sistema com Docker

Iniciando servidor

```
docker-compose up -d (ou apenas make up)
```

Ativando compilador

```
npm run watch
```

Acessar (substitua o 127.0.0.1 por seu ip público):

```
127.0.0.1:8088
```

## 🌳 Branchs

1. **MASTER** _Commits que estão em produção_
2. **DEVELOP** _Commits que estão em homologação prontos antes de irem pra produção_
3. **APP** _Commits que estão em desenvolvimento e ainda não foram para homologação_

## 📫 Contribuindo para o sistema

<!---Se o seu README for longo ou se você tiver algum processo ou etapas específicas que deseja que os contribuidores sigam, considere a criação de um arquivo CONTRIBUTING.md separado--->

Para contribuir com o sistema, siga estas etapas:

1. Bifurque este repositório.
2. Crie um branch (a partir de develop (front) ou app (api)): `git checkout -b <nome_branch>`.
3. Faça suas alterações e confirme-as: `git commit -m '<mensagem_commit>'`
4. Envie para o github: `git push origin <nome_branch>`
5. Crie a solicitação de pull request para develop (front) ou app (api).

Como alternativa, consulte a documentação do GitHub em [como criar uma solicitação pull](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).

## 📝 Licença

**Todos os direitos reservados | conciatcloud.com**

[⬆ Voltar ao topo](#AVA)<br>
