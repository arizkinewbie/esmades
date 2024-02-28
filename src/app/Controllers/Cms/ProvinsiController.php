<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class ProvinsiController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/provinsi/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Provinsi';
    }

    public function index()
    {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/provinsi',
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());

        } else {
            $result = "";
        }

        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Index',
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
            'subTitle' => 'Add New',
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }
    
    public function create() {
        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/provinsi',
            'form_params' => [
                'kode' => $kode,
                'nama' => $nama,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/provinsi/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->to('/admin/provinsi/index')->with('error', 'Data gagal disimpan.');
        }
    }
    
    public function edit($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/provinsi/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit',
                    'token' => session('jwtToken'),
                    'view' => $this->var['viewPath'] . 'edit',
                ];
                $data = array_merge($data, $result);
                return $this->render($data);
            }
        }
    }

    public function update($id = null) {
        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/provinsi/update/' . $id,
            'form_params' => [
                'id' => $id,
                'kode' => $kode,
                'nama' => $nama,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/provinsi/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->to('/admin/provinsi/index')->with('error', 'Data gagal disimpan.');
        }
    }

    public function delete($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/provinsi/delete/' . $id,
            ];

            $response = $this->request($dataRequest);

            if($response->getStatusCode() == 200) {
                return $this->respond(['status' => true, 'message' => 'Data berhasil dihapus']);
            } else {
                return $this->respond(['status' => false, 'message' => 'Data gagal dihapus']);
            }
            
        } else {
            return $this->respond(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
    }
}
