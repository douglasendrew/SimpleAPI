<?php

    require __DIR__ . "/../../vendor/autoload.php";

    // Classe de rotas
    use Routes\Rotas;

    // Classe de conexão
    use Core\Conection;

    // 
    // Caso precisar recuperar o Body, somente utilziar a variável self::$body.
    //

    echo self::$body;