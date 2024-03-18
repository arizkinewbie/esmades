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
        $data = [
            'title' => 'Aset Desa',
            'subTitle' => 'Index ' . $this->titleHeader,
            'dataTable' => true,
            'token' => session('jwtToken'),
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'index',
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
            'token' => session('jwtToken'),
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }

    public function create()
    {
        $validationRules = [
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'gambar wajib diupload.',
                    'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                ]
            ],
            'jenis_galeri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diupload.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diupload.'
                ]
            ],

        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }


        $fotoNama = '';
        $foto = $this->request->getFile('file');
        if (!$foto->hasMoved()) {
            $filenameFoto = $foto->getRandomName();
            $foto->move('uploads/galeri_desa/images', $filenameFoto);
            $fotoNama = $filenameFoto;
        }

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/galeri_desa/create',
            'form_params' => array_merge($this->request->getPost(), [
                'file' => $fotoNama,
            ]),
        ];

        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/galeri_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages);
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/galeri_desa/edit/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Edit ' . $this->titleHeader,
                    'token' => session('jwtToken'),
                    'select2' => true,
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

        $file_name = $this->request->getPost('file_name');
        if (!empty($_FILES['file']['name'])) :
            $validationRules = [
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'gambar wajib diupload.',
                        'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                    ]
                ],
                'jenis_galeri' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
            }

            //menghapus file sebelumnya atau di replace
            if (!empty($file_name)) {
                if (file_exists('uploads/galeri_desa/images/' . $file_name)) :
                    unlink('uploads/galeri_desa/images/' . $file_name);
                endif;
            }


            $fotoNama = '';
            $foto = $this->request->getFile('file');
            if (!$foto->hasMoved()) :
                $filenameFoto = $foto->getRandomName();
                $foto->move('uploads/galeri_desa/images', $filenameFoto);
                $fotoNama = $filenameFoto;
            endif;
        else :
            $fotoNama = $file_name;
        endif;

        $jenis_galeri = $this->request->getPost('jenis_galeri');
        $Keterangan = $this->request->getPost('keterangan');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/galeri_desa/update/' . $id,
            'form_params' => [
                'jenis_galeri' => $jenis_galeri,
                'keterangan' => $Keterangan,
                'file' => $fotoNama
            ],
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/galeri_desa/index')->with('success', 'Data berhasil disimpan.');
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
                'api_path' => '/api/galeri_desa/edit/' . $id,
            ];
            $response1 = $this->request($dataRequest1);
            if ($response1->getStatusCode() == 200) {
                $result = json_decode($response1->getBody(), true);

                if (file_exists('uploads/galeri_desa/images/' . $result['file'])) :
                    unlink('uploads/galeri_desa/images/' . $result['file']);
                endif;
            }
            //end hapus gambar dlu sebelum hapus record 

            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/galeri_desa/delete/' . $id,
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
