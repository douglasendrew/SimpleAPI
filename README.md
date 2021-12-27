<h1>SimpleAPI - PHP</h1>

<div>
<img src="https://img.shields.io/static/v1?label=PHP&message=Projeto em desenvolvimento&color=blue&style=for-the-badge&logo=PHP"/>
</div>

<p>Uma simples estrutura para desenvolvimento de sua API em PHP.</p>
<hr>

<h2>Instalação</h2>
<p>Utilize o comando no seu terminal: <code>git clone https://github.com/douglasendrew/SimpleAPI-PHP.git</code>
  
<h2>Dependências</h2>
<p>- Composer</p>

<h2>Como utilizar</h2>
<p>No arquivo <code>index.php</code> temos a inicialização da API e todos Métodos/Módulos. No caminho <code>Core/Run.php</code> é onde tem todas verificações da API, por exemplo, se o usuário forneceu os parametros de autenticação da API.</p>

<h2>Iniciar</h2>
<p>Para iniciar a API devemos utilizar o seguinte método:</p>

```` 

require "vendor/autoload.php";
  
use Core\Run;

Run::init();

````

<h2>Parametros do header</h2>
<p>Como todas API's, temos o os parametros de Autenticação na API. No caminho <code>Core/Requisicao.php</code> podemos encontrar a função <code>auth()</code>, aqui configuramos todos parâmetros que recebemos do header.</p>

```` 
foreach (getallheaders() as $header => $value) {

  if ($header == "Token")
  {
    $this->token = $value;
  }

  if ($header == "Usuario")
  {
    $this->usuario = $value;
  }

  if ($header == "Client-Id")
  {
    $this->client_id = $value;
  }
  
}

````

<p>Por padrão já está configurado os parâmetros <code>Token, Usuario, Client-Id (Obrigatórios)</code>. A resposta dessa função deve ser <code>true</code> ou <code>false</code>
  
<h2>Estrutura do link</h2>
<p>O link de requisição deverá ter a seguinte estrutura: <code>www.dominio.com/Módulo/TipoRequest/Método</code>, como por exemplo: <code>www.google.com/usuarios/get/listAll</code></p>

<p>A configuração dos Módulos e dos Métodos deverão estar dentro de <code>Methods/Nome_Modulo/Metodo.php</code></p>
<div>PS: o nome do "arquivo método" deve ser <b>exatamente</b> como aparece no link por exempo: </div>

<code>https://www.dominio.com/produtos/get/All</code>

<div>Dentro da pasta <code>Methods</code> deverá estar:</div>

```` 
Methods
    |_ produtos 
           |_ All.php
           |_ ...
````

<h2>Rotas</h2>
<p>O sistema de rotas deverá ser informado em <code>api/rotas.php</code>, utilizando a seguinte função</p>
<code>Rotas::set("Módulo/Método", "Requisição HTTP (Por exemplo: get, post, etc...)")</code></p>

```` 
use Routes\Rotas;

Rotas::set("usuarios/list", "GET");
````
