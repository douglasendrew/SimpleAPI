<?php

    // Não mostrar erros
    error_reporting(0);

    // Definir header para receber json de retorno
    header('Content-Type: application/json; charset=utf-8');

    // Incluir todas classes
    require "vendor/autoload.php";

    // Iniciar a API
    use Core\Run;

    Run::init();

?>