<?php
//echo "<br/>Ruta de la DB". getcwd();

if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

class DB {
	protected static $conPDO;

	private function __construct() {

		try {
			self::$conPDO = new PDO( 'pgsql:host=plop.inf.udec.cl;port=5432;dbname=bdi2017d;user=$bdi2017d;password=bdi2017d; ' );
			self::$conPDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			self::$conPDO->setAttribute( PDO::ATTR_PERSISTENT, false );


		} catch (PDOException $e) {
			echo "Could not connect to database.";
			echo $e;
			exit;
		}

	}


	public static function getConnection() {

		if (!self::$conPDO) {
			new DB();
		}

		return self::$conPDO;
	}
}

$conPDO = DB::getConnection();
?>
