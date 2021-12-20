<?php

    // Não mostrar os erros
    error_reporting(0);

    // Definir header para receber um json como retorno
    header('Content-Type: application/json; charset=utf-8');

    // Incluir todas funções
    require "vendor/autoload.php";

    // Iniciar todos módulos da API
    use Core\Run;
    Run::init();

?>