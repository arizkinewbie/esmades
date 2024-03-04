<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class KecamatanController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/kecamatan/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Kecamatan';
    }

    public function index()
    {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/kecamatan',
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
            'apiDomain' => $this->apiDomain,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'index',
            'result' => $result
        ];
        return $this->render($data);
    }

    public function new() {

        $data = [
            'title' => $this->titleHeader,
            'select2' => true,
            'subTitle' => 'Tambah '.$this->titleHeader,
            'token' => session('jwtToken'),
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
                'api_path'          => '/api/kecamatan',
                'form_params'       => [
                    'nama'              => $nama,
                    'provinsiKode'      => $provinsiKode,
                    'kabupatenKode'     => $kabupatenKode,
                    'kode'              => $kode1.'.'.$kode2
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/kecamatan/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }
    
    public function edit($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/kecamatan/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit '.$this->titleHeader,
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
        $nama           = $this->request->getPost('nama');
        $provinsiKode   = $this->request->getPost('provinsiKode');
        $kabupatenKode  = $this->request->getPost('kabupatenKode');
        $kode           = $this->request->getPost('kode');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/kecamatan/update/' . $id,
            'form_params' => [
                'id'                => $id,
                'nama'              => $nama,
                'provinsiKode'      => $provinsiKode,
                'kabupatenKode'     => $kabupatenKode,
                'kode'              => $kode
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/kecamatan/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function delete($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/kecamatan/delete/' . $id,
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


