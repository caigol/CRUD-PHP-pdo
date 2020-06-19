<?php

class Banco{

	private static $dbNome = 'pdo';
	private static $dbHost = 'localhost:3306';
	private static $dbUsuario = 'root';
	private static $dbSenha = '';

	private static $cont = null;

	public function __construct(){
		die('A função Ini não é permitada!');
	}

	public static function conectar(){
		if(null == self::$cont){
			try{
				self::$cont = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome,self::$dbUsuario,self::$dbSenha);			
			}
			catch(PDOException $exception){
				die($exception->getMessage());
			}
		}
		return self::$cont;
	}

	public static function desconectar(){
		self::$cont = null;
	}
}

?>