<?php
require_once "Conf.php";

class DB
{
	private const DB_HOST = 'localhost';
	private const DB_NAME = 'text_over_image';
	private const DB_USER = 'textoverimage';
    private const DB_PASS = '12345678';
    
    private static $_instance = null;

	private function __construct () {
		self::$_instance = new PDO(
			'mysql:host=' . Conf::DB_HOST . ';dbname=' . Conf::DB_NAME,
	    	Conf::DB_USER,
	    	Conf::DB_PASS,
	    	[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
	    );
	}

	private function __clone () {}
	private function __wakeup () {}

	public static function getInstance()
	{
		if (self::$_instance === null) {
			new self;
		}
        return self::$_instance;
	}
}