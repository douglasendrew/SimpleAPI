<?php

    // Não mostrar os erros
    error_reporting(0);

    // Definir que irá receber um json como retorno
    header('Content-Type: application/json; charset=utf-8');

    // Pegar todas funções
    require "vendor/autoload.php";

    // Incluir a função de iniciar a API
    use Core\Run;

    // Iniciar todos módulos da API
    Run::init();

?>