<?php

class mySQL
{
	private $_connection = false;
	private $_host = NULL;
	private $_user = NULL;
	private $_password = NULL;
	private $_dbname = NULL;
	private $_verbindung = NULL;
	private $_last_querry = NULL;
	private $_counter = NULL;
	
	public function __construct($id = db_standard)
	{
		global $___mySQL;
		
		$this->host = $___mySQL[$id][host];
		$this->user = $___mySQL[$id][user];
		$this->password = $___mySQL[$id][password];
		$this->dbname = $___mySQL[$id][dbname];
		
		$this->connect();
	}
	
	private function connect()
	{		
		$this->verbindung = @mysql_connect($this->host,$this->user,$this->password);
		
		if ($this->verbindung === false)
		{
			$this->errorReport("mysql_connect");
		}
		if (@mysql_select_db($this->dbname, $this->verbindung) === false)
		{
			$this->errorReport("mysql_select_db");
		}
		else
		{
			$this->connection = true;
		}
	}
	
	public function query($sql)
	{
		if (!($this->connection))
		{
			$this->errorReport("mysql_connect");
		}
		else
		{
			
			$this->last_querry = $sql;
			$this->counter++;
			$result = @mysql_query($this->last_querry, $this->verbindung) or $this->errorReport("mysql_query",mysql_error(),$sql);

			return $result;
		}
	}
	
	public function select($sql,&$anzahl = NULL)
	{
		if (!($this->connection))
		{
			$this->errorReport("mysql_connect");
		}
		else 
		{
			$result = $this->query($sql);
			if ($result !== FALSE) 
			{
				$anzahl1 = @mysql_num_rows($result);
				$anzahl = $anzahl1;
				for($i = 0; $i < $anzahl; $i++)
				{
					$array[$i] = @mysql_fetch_object($result);
				}
			}
		}
		return $array; 
	}
	public function getAnzahl($sql)
	{
		if (!($this->connection))
		{
			$this->errorReport("mysql_connect");
		}
		else 
		{
			$result = $this->query($sql);
			if ($result !== FALSE) 
			{
				$anzahl1 = @mysql_num_rows($result);
				$anzahl = $anzahl1;
			}
		}
		return $anzahl;
	}
	public function insert_id()
	{
		$last_id = mysql_insert_id($this->verbindung);
		return $last_id;
	}
	
	public function __destruct()
	{
		if (!$this->connection)
		{
			$this->errorReport("destruct");
		}
		else
		{
			if (@mysql_close($this->verbindung) === false)
			{
				$this->error("mysql_close");
			}
		}
	}
	
	private function errorReport($error,$mysqlerror = NULL,$select = NULL)
	{
		switch ($error)
		{
			case 'mysql_connect': $var = "Die Verbindung zur MySQL Datenbank konnte nicht hergestellt werden!";break;
			case 'mysql_select_db': $var = "Bei der Auswahl der Datenbank ist ein Fehler aufgetreten!";break;
			case 'destruct': $var = "Die Verbindung konnte nicht beendet werden, da sie nicht initiert worden ist!";break;
			case 'mysql_close':$var = "Es ist ein Fehler beim beenden der MySQL Verbindung aufgetreten!";break;
			case 'mysql_query':$var = "Query Fehler in Query $this->counter: Follgender Select: <b>$select</b>";break;
		}
		if ($mysqlerror != NULL) $var .= " $mysqlerror";
		die ("MySQL ERROR: ".$var."\n<br />\n");
	}
}
?>