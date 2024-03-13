<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use CodeIgniter\Files\File;

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

        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Index ' . $this->titleHeader,
            'dataTable' => true,
            'select2' => true,
            'token' => session('jwtToken'),
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'index',
        ];
        return $this->render($data);
    }
    
    public function show($id = null)
    {
        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/aset_desa/show/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit ' . $this->titleHeader,
                    'select2' => true,
                    'dropzone' => true,
                    'dataTable' => true,
                    'token' => session('jwtToken'),
                    'apiDomain' => getenv('API_DOMAIN'),
                    'view' => $this->var['viewPath'] . 'detail',
                ];
                $data = array_merge($data, $result);
                return view('cms/aset_desa/show', $data);
            }
        }
    }

    public function new()
    {
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/provinsi',
        ];
        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
        } else {
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

    public function create()
    {

        helper('filesystem');

        $validationRules      = [
            'file_surat_kepemilikan' => [
                'uploaded[file_surat_kepemilikan]',
                'mime_in[file_surat_kepemilikan,image/png,image/jpg,image/jpeg]',
            ],
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }
        $fileSuratKepemilikanNama = '';
        $fileSuratKepemilikan = $this->request->getFile('file_surat_kepemilikan');
        if (!$fileSuratKepemilikan->hasMoved()) {
            $filename = $fileSuratKepemilikan->getRandomName();
            $fileSuratKepemilikan->move('uploads/aset_desa/hukum', $filename);
            $fileSuratKepemilikanNama = $filename;
        }

        $dataRequest = [
            'method'            => 'POST',
            'api_path'          => '/api/aset_desa',
            'form_params'       => array_merge(
                $this->request->getPost(),
                ['desa_id' => '29198', 'file_surat_kepemilikan' => $fileSuratKepemilikanNama]
            ),
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            $files = json_decode((string) $this->request->getPost('files'));
            $countFiles = count($files);
            if ($countFiles > 0) {
                foreach ($files as $row) {
                    $fileToMove = FCPATH . 'uploads/temp/images/' . $row->filename;
                    $file = new File($fileToMove);

                    $destinationFolder = FCPATH . 'uploads/aset_desa/';
                    if (!is_dir($destinationFolder)) {
                        mkdir($destinationFolder, 0777, true);
                    }
                    $file->move($destinationFolder, $row->filename);
                }
            }

            return redirect()->to('/admin/aset_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/aset_desa/edit/' . $id,
            ];

            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit ' . $this->titleHeader,
                    'select2' => true,
                    'dropzone' => true,
                    'dataTable' => true,
                    'token' => session('jwtToken'),
                    'apiDomain' => getenv('API_DOMAIN'),
                    'view' => $this->var['viewPath'] . 'edit',
                ];
                $data = array_merge($data, $result);
                return $this->render($data);
            }
        }
    }

    public function update($id = null)
    {

        $validationRules      = [
            'file_surat_kepemilikan' => [
                'uploaded[file_surat_kepemilikan]|max_size[file,2048]',
                'mime_in[file_surat_kepemilikan,application/pdf]',
            ],
        ];

        $fileSuratKepemilikanNama = '';
        $fileSuratKepemilikan = $this->request->getFile('file_surat_kepemilikan');
        if ($fileSuratKepemilikan->isValid()) {
            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
            }

            if (!$fileSuratKepemilikan->hasMoved()) {
                $filename = $fileSuratKepemilikan->getRandomName();
                $fileSuratKepemilikan->move('uploads/aset_desa/hukum', $filename);
                $fileSuratKepemilikanNama = $filename;
            }
        }

        $addPost['desa_id'] = '29198';
        if ($fileSuratKepemilikanNama) $addPost['file_surat_kepemilikan'] = $fileSuratKepemilikanNama;

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/aset_desa/update/' . $id,
            'form_params' => array_merge($this->request->getPost(), $addPost),
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/aset_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function delete($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/aset_desa/delete/' . $id,
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

    public function uploadFile()
    {
        $validationRules      = [
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/png,image/jpg,image/jpeg]',
            ],
        ];
        if (!$this->validate($validationRules)) {
            return $this->respond([
                'status' => false,
                'message' => $this->validator->getErrors(),
            ], 400);
        }

        $file = $this->request->getFile('file');
        if (!$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/temp/images', $filename);
            return $this->respond(['filename' => $filename]);
        }
    }
}
