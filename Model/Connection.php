<?php

namespace Model;

use PDO;
use PDOException;


require_once __DIR__."/../config/Configuration.php";
class Connection{
    private static $smt;

    public static function getIntance():PDO{  
        if(empty(self::$smt)){
        try{
            self::$stmt = new PDO('mysql:host='. DB_HOST. ';port='.  DB_PORT. ';dbname=' .DB_NAME . '', DB_USER , DB_PASSWORD); 
        } catch(PDOException $e){
            echo $e->getMessage('falhou');
            die($e->getMessage('falhou'));

        }
    }
    return self::$stmt;
}
}
?>