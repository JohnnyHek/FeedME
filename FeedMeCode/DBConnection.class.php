<?php
error_reporting(0);
class DBConnection
{
    public $host = "mysql.dur.ac.uk";
    public $username = "cqnl46";
    public $password = "f59east";
    public $dbname = "Xcqnl46_FeedME";


    public function query($sql)
    {

        $dbConn = new mysqli($this->host,$this->username,$this->password,$this->dbname);
		if ($dbConn->connect_error)
		{
			echo $dbConn->connect_error;
		}
		
		$dbConn->set_charset('utf8');
		
		$result = $dbConn->query($sql);
		
		return $result;
    }

}



?>