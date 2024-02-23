<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $var = [];

    public function __construct()
    {
        $this->var['viewPath'] = 'home/';
    }
    
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'subTitle' => '',
            'view' => $this->var['viewPath'] . 'index',
        ];
        return $this->render($data);
    }
}