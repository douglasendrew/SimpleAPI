<h1>SimpleAPI - PHP</h1>
<p>Uma simples estrutura para desenvolvimento de sua API em PHP.</p>
<hr>

<h3>Instalação</h3>
<p>Utilize o comando no seu terminal: <code>git clone https://github.com/douglasendrew/SimpleAPI-PHP.git</code>
  
<h3>Dependências</h3>
<p>- Composer</p>

<h3>Passo-a-Passo</h3>
<p>No arquivo <code>index.php</code> temos a inicialização da API e todos Métodos/Módulos. No caminho <code>Core/Run.php</code> é onde tem todas verificações da API, por exemplo, se o usuário forneceu os parametros de autenticação da API.</p>

<p>Para iniciar a API devemos utilizar o seguinte método:</p>
  ```php

    require "vendor/autoload.php";
  
    use Core\Run;

    Run::init();

  ```
  
