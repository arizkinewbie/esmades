<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use \Hermawan\DataTables\DataTable;
use CodeIgniter\HTTP\ResponseInterface;

class AsetDesaController extends BaseAdminController
{
    protected $var = [];

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/aset_desa/';
    }

    public function index()
    {
        $data = [
            'title' => 'Aset Desa',
            'subTitle' => 'Index',
            'dataTable' => true,
            'view' => $this->var['viewPath'] . 'index',
        ];
        return $this->render($data);
    }

    public function indexDataTable() {
        $db = db_connect();
        $builder = $db->table('t_aset_desa')
        ->select('
            t_aset_desa.id,
            m_jenis_aset.nama as jenis_aset,
            t_aset_desa.deskripsi,
        ')
        ->join('m_jenis_aset','t_aset_desa.jenis_aset_id = m_jenis_aset.id');
        
        return DataTable::of($builder)->addNumbering()->toJson(TRUE);
    }
}
