<?php

namespace libs;

class Session 
{
	public function init($write = false) {
		session_start();
		error_log('Session start');
        if (!$write) {
             $this->writeClose();
		}
	}	
	
    public function writeClose()
    {
        session_write_close();
		error_log('Session write close');		
    }
	
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	public function get($key, $defaultValue = null) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue;			
	}

	public function destroy() {
		if (session_status() === PHP_SESSION_ACTIVE){
			session_unset();
			session_destroy();
			error_log('Session destroy');					
		}
	}
	
	public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }	
	
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }	
}