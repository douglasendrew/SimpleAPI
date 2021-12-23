<?php 

    namespace Core;

    use Core\Requisicao;

    use PDO;

    class Conection
    {

        private static $host = "localhost";
        private static $usuario = "root";
        private static $senha = "";
        private static $dbname = "api_v1";
        private static $dbtype = "mysql";

        public static function init()
        {
            $pdo = new PDO(self::$dbtype . ":host=". self::$host . ";dbname=". self::$dbname, self::$usuario, self::$senha);
            return $pdo;
        }

    }

?>