<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class GaleriDesaController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->titleHeader = 'Galeri Desa';
        $this->var['viewPath'] = 'cms/galeri_desa/';
        $this->apiDomain = getenv('API_DOMAIN');
    }

    public function index()
    {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/galeri_desa',
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
            'subTitle' => 'Tambah '. $this->titleHeader,
            'token' => session('jwtToken'),
            'select2' => true,
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }
    
    public function create() {

        $validationRules      = [
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/png,image/jpg,image/jpeg]',
            ]
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }

        $fileNama = '';
        $file = $this->request->getFile('file');
        if (! $file->hasMoved()) {
            $filenamefile = $file->getRandomName();
            $file->move('uploads/galeri_desa/images', $filenamefile);
            $fileNama = $filenamefile;
        }

        $jenis_galeri = $this->request->getPost('jenis_galeri');
        $keterangan = $this->request->getPost('keterangan');
        $file = $this->request->getPost('file');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/galeri_desa',
            'form_params' => [
                'jenis_galeri' => $jenis_galeri,
                'keterangan' => $keterangan,
                'file' => $fileNama,
            ],
        ];

        print_r($dataRequest);
        die();
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/galeri_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }
    
    public function edit($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/galeri_desa/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit '. $this->titleHeader,
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

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/galeri_desa/update/' . $id,
            'form_params' => [
                'nama' => $nama,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/galeri_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function delete($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/galeri_desa/delete/' . $id,
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
