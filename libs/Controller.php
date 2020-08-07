<?php

namespace libs;

class Controller
{
	protected $view;
	
	public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->view = new View();
	}
}
