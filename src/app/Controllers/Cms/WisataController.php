<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class WisataController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/wisata/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Wisata';
    }

    public function index()
    {

        $array = array('test1', 'test2', 'test3', 'test4', 'test5', 'test6', 'test7', 'test8');

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/wisata',
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
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }

    public function create()
    {
        if (!empty($_FILES['file']['name'])) :
            $validationRules = [
                'file' => [
                    'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'gambar wajib diupload.',
                        'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                    ]
                ],
                'nama_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'jenis_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'alamat_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

                'nomor_kontak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

                'keterangan_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

                'lokasi_wisata' => [
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

            $no = 0;

            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/wisata/images', $newName);

                    $hasil[$no] = array(
                        'nama_file' => $newName,
                        'path_file' => 'uploads/wisata/images/' . $newName
                    );
                }
                $no++;
            }

            $foto_wisata = json_encode($hasil);
        else :
            $foto_wisata = '';
        endif;

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/wisata',
            'form_params' => [
                'nama_wisata' => $this->request->getPost('nama_wisata'),
                'jenis_wisata' => $this->request->getPost('jenis_wisata'),
                'alamat_wisata' => $this->request->getPost('alamat_wisata'),
                'nomor_kontak' => $this->request->getPost('nomor_kontak'),
                'keterangan_wisata' => $this->request->getPost('keterangan_wisata'),
                'lokasi_wisata' => $this->request->getPost('lokasi_wisata'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'whatsapp' => $this->request->getPost('whatsapp'),
                'foto_wisata' => $foto_wisata,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/wisata/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/wisata/edit/' . $id,
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
                    'path_file' => 'uploads/wisata/images/' . $file_name[$i]
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
                'nama_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'jenis_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],
                'alamat_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

                'nomor_kontak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

                'keterangan_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ],

                'lokasi_wisata' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diupload.'
                    ]
                ]
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
            }


            // Grab the file by name given in HTML form
            $files = $this->request->getFileMultiple('file');

            $no = 0;

            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/wisata/images', $newName);

                    $hasil[$no] = array(
                        'nama_file' => $newName,
                        'path_file' => 'uploads/wisata/images/' . $newName
                    );
                }
                $no++;
            }

            $hasil_array = (!empty($file_array)) ? json_encode(array_merge($hasil, $file_array)) : json_encode($hasil);
        else :
            $hasil_array = (!empty($file_array)) ? json_encode($file_array) : '';
        endif;

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/wisata/update/' . $id,
            'form_params' => [
                'nama_wisata' => $this->request->getPost('nama_wisata'),
                'jenis_wisata' => $this->request->getPost('jenis_wisata'),
                'alamat_wisata' => $this->request->getPost('alamat_wisata'),
                'nomor_kontak' => $this->request->getPost('nomor_kontak'),
                'keterangan_wisata' => $this->request->getPost('keterangan_wisata'),
                'lokasi_wisata' => $this->request->getPost('lokasi_wisata'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'whatsapp' => $this->request->getPost('whatsapp'),
                'foto_wisata' => $hasil_array,
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/wisata/index')->with('success', 'Data berhasil disimpan.');
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
                'api_path' => '/api/wisata/edit/' . $id,
            ];
            $response1 = $this->request($dataRequest1);
            if ($response1->getStatusCode() == 200) {
                $result = json_decode($response1->getBody(), true);

                if (!empty($result['foto_wisata'])) :
                    foreach (json_decode($result['foto_wisata']) as $f) :
                        if (file_exists('uploads/wisata/images/' . $f->nama_file)) :
                            unlink('uploads/wisata/images/' . $f->nama_file);
                        endif;
                    endforeach;
                endif;
            }
            //end hapus gambar dlu sebelum hapus record 

            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/wisata/delete/' . $id,
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

        if (file_exists('uploads/wisata/images/' . $nama_file)) :
            unlink('uploads/wisata/images/' . $nama_file);
        endif;
    }
}
