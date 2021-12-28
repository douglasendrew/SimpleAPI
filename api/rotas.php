<?php 

    // Usar classe rotas
    use Routes\Rotas;

    // Listagem de todas rotas da API
    Rotas::set("usuarios/novo", "POST");
    Rotas::set("usuarios/listAll", "GET");

?>