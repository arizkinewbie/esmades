<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use CodeIgniter\Files\File;

class KabarDesaController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->titleHeader = 'Kabar Desa';
        $this->var['viewPath'] = 'cms/kabar_desa/';
        $this->apiDomain = getenv('API_DOMAIN');
    }

    public function index()
    {
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/kabar_desa',
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
            'select2' => true,
            'ckeditor' => true,
            'dropzone' => true,
            'token' => session('jwtToken'),
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }

    public function create()
    {
        helper('filesystem');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/kabar_desa/create',
            'form_params' => [
                'jenis_berita'  => $this->request->getPost('jenis_berita'),
                'judul_berita'  => $this->request->getPost('judul_berita'),
                'isi_berita'    => $this->request->getPost('isi_berita'),
                'foto'          => $this->request->getPost('files'),
            ],
        ];

        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 201) {
            $files = json_decode((string) $this->request->getPost('files'));
            $countFiles = count($files);
            if ($countFiles > 0) {
                foreach ($files as $row) {
                    $fileToMove = FCPATH . 'uploads/temp/images/' . $row->filename;
                    $file = new File($fileToMove);

                    $destinationFolder = FCPATH . 'uploads/kabar_desa/images/';
                    if (!is_dir($destinationFolder)) {
                        mkdir($destinationFolder, 0777, true);
                    }
                    $file->move($destinationFolder, $row->filename);
                }
            }

            return redirect()->to('/admin/kabar_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages);
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/kabar_desa/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit ' . $this->titleHeader,
                    'token' => session('jwtToken'),
                    'select2' => true,
                    'ckeditor' => true,
                    'dropzone' => true,
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
        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/kabar_desa/update/' . $id,
            'form_params' => [
                'jenis_berita'  => $this->request->getPost('jenis_berita'),
                'judul_berita'  => $this->request->getPost('judul_berita'),
                'isi_berita'    => $this->request->getPost('isi_berita'),
                'foto'          => $this->request->getPost('files'),
            ],
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            $files = json_decode((string) $this->request->getPost('files'));
            $countFiles = count($files);
            if ($countFiles > 0) {
                foreach ($files as $row) {
                    $fileToMove = FCPATH . 'uploads/temp/images/' . $row->filename;
                    $file = new File($fileToMove);

                    $destinationFolder = FCPATH . 'uploads/kabar_desa/images/';
                    if (!is_dir($destinationFolder)) {
                        mkdir($destinationFolder, 0777, true);
                    }
                    if (file_exists('uploads/temp/images/' . $row->filename)) :
                        $file->move($destinationFolder, $row->filename);
                    endif;
                }
            }

            return redirect()->to('/admin/kabar_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function delete($id = null)
    {
        if ($id) {

            //start hapus gambar dlu sebelum hapus record 
            $dataRequest1 = [
                'method' => 'GET',
                'api_path' => '/api/kabar_desa/edit/' . $id,
            ];
            $response1 = $this->request($dataRequest1);
            if ($response1->getStatusCode() == 200) {
                $result = json_decode($response1->getBody(), true);

                if (!empty($result['foto'])) :
                    foreach (json_decode($result['foto']) as $f) :
                        if (file_exists('uploads/kabar_desa/images/' . $f->filename)) :
                            unlink('uploads/kabar_desa/images/' . $f->filename);
                        endif;
                    endforeach;
                endif;
            }
            //end hapus gambar dlu sebelum hapus record 

            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/kabar_desa/delete/' . $id,
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

    public function hapus_gambar()
    {
        $nama_file = $this->request->getPost('nama_file');
        if (file_exists('uploads/kabar_desa/images/' . $nama_file)) :
            unlink('uploads/kabar_desa/images/' . $nama_file);
        endif;
    }

    public function uploadFile()
    {
        $validationRules = [
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'gambar wajib diupload.',
                    'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                ]
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
