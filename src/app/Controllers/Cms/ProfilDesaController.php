<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class ProfilDesaController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/profil/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Profil';
    }

    public function index()
    {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/profil',
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());

        } else {
            $result = "";
        }

        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Index '.$this->titleHeader,
            'dataTable' => true,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'index',
            'result' => $result
        ];
        return $this->render($data);
    }

    public function new() {
        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Tambah '.$this->titleHeader,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }
    
    public function create() {
        $nama = $this->request->getPost('nama');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/profil',
            'form_params' => [
                'nama' => $nama,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/profil/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->to('/admin/profil/index')->with('error', 'Data gagal disimpan.');
        }
    }
    
    public function edit($id = null) {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/profil?desa_id=29198',
        ];
        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
            $data = [
                'title' => $this->titleHeader,
                'subTitle' => 'Edit '.$this->titleHeader,
                'view' => $this->var['viewPath'] . 'edit',
            ];
            $data = array_merge($data, $result[0]);
            return $this->render($data);
        } else {
            return $this->notFound('Halam tidak ditemukan!');
        }
    }

    public function update($id = null) {
        $nama = $this->request->getPost('nama');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/profil/update/' . $id,
            'form_params' => $this->request->getPost(),
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/profil')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages);
        }
    }
}
