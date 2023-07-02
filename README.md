# Cadastro de Pacientes 📋
Este projeto tem como propósito o estudo e aperfeiçoamento no framework Laravel.
Tem como funcionalidades o cadastro de pacientes, cadastro de consultas para os pacientes, geração de PDF da consulta agendada e uma tela de login inicial.



## Capturas das telas principais 🖥️
### Tela de Login
![Tela de Login](public/images/tela_login.png)

### Listagem de pacientes
![Listagem de pacientes](public/images/lista_pacientes.png)

### Lista de consultas marcadas
![Lista de consultas marcadas](public/images/consultas_marcadas.png)

### Agendamento de consulta
![Agendamento de consulta](public/images/agendar_consulta.png)



## Instalação 🛠️

Baixe o projeto com:
```bash
    git clone https://github.com/DevNetinho/cadastro_pacientes
```

Navegue para o diretório do projeto e execute o comando para instalar todas as dependências:
```bash
    composer install
```

Crie o arquivo .env com base no .env_example e configure o mesmo de acordo com suas configurações locais,
caso seu sistema operacional seja o Windows, substitua o " cp " para " copy ":
```bash
    cp .env_example .env
```

Gerar a chave do aplicativo:
```bash
    php artisan key:generate
```

Execute as migrations:
```bash
    php artisan migrate
```

Por fim, sirva a aplicação ;D
```bash
    php artisan serve
```
    

## Aprendizados 📚

Os principais aprendizados que eu tive com este projeto foram: O relacionamento de 1 para N(onde 1 paciente pertence a N consultas) no Eloquent ORM, Implementação e uso do pacote [Laravel UI](https://github.com/laravel/ui) com Bootstrap e Autenticação, uso do pacote [DomPdf](https://github.com/dompdf/dompdf) para exportação de pdf da consulta do paciente e também houve muita prática do CRUD em todos os formulários criados.
