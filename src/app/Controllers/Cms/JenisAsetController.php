<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class JenisAsetController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/jenis_aset/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Jenis Aset';
    }

    public function index()
    {
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/jenis_aset',
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());
        } else {
            $result = "";
        }

        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Index ' . $this->titleHeader,
            'dataTable' => true,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'index',
            'result' => $result
        ];
        return $this->render($data);
    }

    public function new()
    {
        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Tambah ' . $this->titleHeader,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }

    public function create()
    {
        $nama = $this->request->getPost('nama');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/jenis_aset',
            'form_params' => [
                'nama' => $nama,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/jenis_aset/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/jenis_aset/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit ' . $this->titleHeader,
                    'token' => session('jwtToken'),
                    'view' => $this->var['viewPath'] . 'edit',
                ];
                $data = array_merge($data, $result);
                return $this->render($data);
            }
        }
    }

    public function update($id = null)
    {
        $nama = $this->request->getPost('nama');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/jenis_aset/update/' . $id,
            'form_params' => [
                'nama' => $nama,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/jenis_aset/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function delete($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/jenis_aset/delete/' . $id,
            ];

            $response = $this->request($dataRequest);

            if ($response->getStatusCode() == 200) {
                return $this->respond(['status' => true, 'message' => 'Data berhasil dihapus']);
            } else {
                return $this->respond(['status' => false, 'message' => 'Data gagal dihapus']);
            }
        } else {
            return $this->respond(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
    }
}
