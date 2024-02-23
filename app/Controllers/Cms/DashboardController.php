<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseAdminController
{

    protected $var = [];

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/dashboard/';
    }
    
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'view' => $this->var['viewPath'] . 'index',
        ];
        return $this->render($data);
    }
}
