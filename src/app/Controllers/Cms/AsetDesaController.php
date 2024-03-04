<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class AsetDesaController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/aset_desa/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Aset Desa';
    }

    public function index()
    {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/aset_desa',
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());

        } else {
            $result = "";
        }

        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Index '. $this->titleHeader,
            'dataTable' => true,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'index',
            'result' => $result
        ];
        return $this->render($data);
    }

    public function new() {
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/provinsi',
        ];
        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
        }
        else{
            $result = "";
        }

        $data = [
            'title' => $this->titleHeader,
            'select2' => true,
            'dataTable' => true,
            'dropzone' => true,
            'result' => $result,
            'subTitle' => 'Tambah Baru',
            'token' => session('jwtToken'),
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }
    
    public function create() {
        $nama           = $this->request->getPost('nama');
        $provinsiKode   = $this->request->getPost('provinsiKode');
        $kabupatenKode  = $this->request->getPost('kabupatenKode');
        $kode1   = $this->request->getPost('kode1');
        $kode2   = $this->request->getPost('kode2');

        $dataRequest = [
                'method'            => 'POST',
                'api_path'          => '/api/aset_desa',
                'form_params'       => [
                    'nama'              => $nama,
                    'provinsiKode'      => $provinsiKode,
                    'kabupatenKode'     => $kabupatenKode,
                    'kode'              => $kode1.'.'.$kode2
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/aset_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }
    
    public function edit($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/aset_desa/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit '. $this->titleHeader,
                    'select2' => true,
                    'token' => session('jwtToken'),
                    'view' => $this->var['viewPath'] . 'edit',
                ];
                $data = array_merge($data, $result);
                return $this->render($data);
            }
        }
    }

    public function update($id = null) {
        $nama = $this->request->getPost('nama');
        $provinsiKode   = $this->request->getPost('provinsiKode');
        $kabupatenKode  = $this->request->getPost('kabupatenKode');
        $kode   = $this->request->getPost('kode');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/aset_desa/update/' . $id,
            'form_params' => [
                'id'                => $id,
                'nama'              => $nama,
                'provinsiKode'      => $provinsiKode,
                'kabupatenKode'     => $kabupatenKode,
                'kode'              => $kode
            ],
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/aset_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function delete($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/aset_desa/delete/' . $id,
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
