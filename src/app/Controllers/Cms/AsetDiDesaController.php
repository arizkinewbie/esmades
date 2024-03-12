<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class AsetDiDesaController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->titleHeader = 'Aset Di Desa';
        $this->var['viewPath'] = 'cms/aset_di_desa/';
        $this->apiDomain = getenv('API_DOMAIN');
    }

    public function index()
    {
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/aset_di_desa',
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
        $validationRules = [
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'gambar wajib diupload.',
                    'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                ]
            ],
            'jenis_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diupload.'
                ]
            ],
            'judul_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diupload.'
                ]
            ],
            'isi_berita' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diupload.'
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }

        // Grab the file by name given in HTML form
        $files = $this->request->getFileMultiple('file');

        $no = 1;

        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/aset_di_desa/images', $newName);

                $hasil[$no] = array(
                    'nama_file' => $newName,
                    'path_file' => 'uploads/aset_di_desa/images/' . $newName
                );
            }
            $no++;
        }

        $jenis_berita   = $this->request->getPost('jenis_berita');
        $judul_berita   = $this->request->getPost('judul_berita');
        $isi_berita     = $this->request->getPost('isi_berita');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/aset_di_desa/create',
            'form_params' => [
                'jenis_berita'  => $jenis_berita,
                'judul_berita'  => $judul_berita,
                'isi_berita'    => $isi_berita,
                'foto'          => json_encode($hasil),
            ],
        ];

        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/aset_di_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages);
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/aset_di_desa/edit/' . $id,
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

        if (!empty($file_name)) :
            for ($i = 0; $i < count($file_name); $i++) :
                $file_array[$i] = array(
                    'nama_file' => $file_name[$i],
                    'path_file' => 'uploads/aset_di_desa/images/' . $file_name[$i]
                );
            endfor;
        else :
            $file_array = '';
        endif;

        if (!empty($_FILES['file']['name'])) :
            $validationRules = [
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'gambar wajib diupload.',
                        'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                    ]
                ],
                'jenis_berita' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'judul_berita' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'isi_berita' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
            }


            // Grab the file by name given in HTML form
            $files = $this->request->getFileMultiple('file');

            $no = 1;

            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/aset_di_desa/images', $newName);

                    $hasil[$no] = array(
                        'nama_file' => $newName,
                        'path_file' => 'uploads/aset_di_desa/images/' . $newName
                    );
                }
                $no++;
            }

            $hasil_array = (!empty($file_array)) ? json_encode(array_merge($hasil, $file_array)) : json_encode($hasil);
        else :
            $hasil_array = (!empty($file_array)) ? json_encode($file_array) : '';
        endif;

        $jenis_berita   = $this->request->getPost('jenis_berita');
        $judul_berita   = $this->request->getPost('judul_berita');
        $isi_berita     = $this->request->getPost('isi_berita');

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/aset_di_desa/update/' . $id,
            'form_params' => [
                'jenis_berita' => $jenis_berita,
                'judul_berita' => $judul_berita,
                'isi_berita' => $isi_berita,
                'foto' => $hasil_array
            ],
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/aset_di_desa/index')->with('success', 'Data berhasil disimpan.');
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
                'api_path' => '/api/aset_di_desa/edit/' . $id,
            ];
            $response1 = $this->request($dataRequest1);
            if ($response1->getStatusCode() == 200) {
                $result = json_decode($response1->getBody(), true);

                if (!empty($result['foto'])) :
                    foreach (json_decode($result['foto']) as $f) :
                        if (file_exists('uploads/aset_di_desa/images/' . $f->nama_file)) :
                            unlink('uploads/aset_di_desa/images/' . $f->nama_file);
                        endif;
                    endforeach;
                endif;
            }
            //end hapus gambar dlu sebelum hapus record 

            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/aset_di_desa/delete/' . $id,
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
        if (file_exists('uploads/aset_di_desa/images/' . $nama_file)) :
            unlink('uploads/aset_di_desa/images/' . $nama_file);
        endif;
    }
}
