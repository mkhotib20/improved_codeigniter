<?php

class Controller extends CI_Controller 
{
    public $models;
    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->models);
    }
    public function render($view, Array $params = [])
    {
        $this->load->view('layouts/header', [
            'view' => $view,
            'params' => $params
        ]);
    }
}
