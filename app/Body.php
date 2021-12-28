<?php 

   /**
   * Classe para tratar o body das requisições 
   * @author douglasendrew
   */

   namespace SimpleAPI;

   class Body 
   {

        private static $body;

        public static function body($body)
        {

            $allBody = array();

            self::$body = urldecode($body);

            $hh = explode("&", self::$body);

            for ($a = 0; $a < count($hh); $a++)
            {
                $tt = explode("=", $hh[$a]);
                $allBody[$tt[0]] = $tt[1];
            }

            return $allBody;

        }

   }