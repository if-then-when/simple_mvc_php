<?php

namespace libs;

use libs\bootstrap;
use libs\Controller;
use libs\View;

class Database 
{
	protected $connection;
	
	public function init() {
		$config = include 'config\Db.php';
		$this->connection = new \mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
		if (mysqli_connect_errno()) {
            error_log(
                'Database connection Error | Code: ' . $this->connection->connect_errno . ' | Message: ' . $this->connection->connect_error);
			exit();				
        }
		error_log('Database open');
		return $this->connection;		
	}
	public static function execute($query, $param_type=null, array $params=null) 
	{
		if(is_null($params)){
			return $this->connection->query($query);
		}
		
		$stmt = Bootstrap::$db->prepare($query);

		if($param_type&&$params)
        {
            $bind_names[] = $param_type;
            for ($i=0; $i<count($params);$i++) 
            {
                $bind_name = 'bind' . $i;
                $$bind_name = $params[$i];
                $bind_names[] = &$$bind_name;
            }
            $return = call_user_func_array(array($stmt,'bind_param'),$bind_names);
        }		

		if($stmt == false) {
			trigger_error('Wrong SQL: ' . $query . ' Error: ' . Bootstrap::$db->errno . ' ' . Bootstrap::$db->error, E_USER_ERROR);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		if (strpos($query, 'UPDATE') > -1){
			return true;
		}
		else{
			return $result->num_rows ? $result->fetch_all(MYSQLI_ASSOC) : [];
		}
	}
	
	public function close()
    {
        $this->connection->close();
		error_log('Database close');
	}
}
