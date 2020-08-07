<?php

function autoload($className)
{
	include($className . '.php');
}
spl_autoload_register('autoload');