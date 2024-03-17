<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class PeraturanController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/peraturan/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Peraturan';
    }

    public function index()
    {

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/peraturan',
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
        $validationRules = [
            'file_upload' => [
                'rules' => 'uploaded[file_upload]|mime_in[file_upload,application/pdf]',
                'errors' => [
                    'uploaded' => 'file wajib diupload.',
                    'mime_in' => 'file harus bertipe PDF.'
                ]
            ],
            'judul_peraturan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],
            'nomor_peraturan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],

            'jenis_peraturan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],

            'isi_peraturan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],

            'ditetapkan_oleh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],
            'tanggal_ditetapkan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],

            'tanggal_diundangkan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],

            'keyword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],

        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }

        $pdf_file = $this->request->getFile('file_upload');
        if (!$pdf_file->hasMoved()) :
            $filenamepdf_file = $pdf_file->getRandomName();
            $pdf_file->move('uploads/peraturan/pdf', $filenamepdf_file);
            $file_upload = $filenamepdf_file;
        endif;

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/peraturan',
            'form_params' => [
                'judul_peraturan' => $this->request->getPost('judul_peraturan'),
                'nomor_peraturan' => $this->request->getPost('nomor_peraturan'),
                'jenis_peraturan' => $this->request->getPost('jenis_peraturan'),
                'isi_peraturan' => $this->request->getPost('isi_peraturan'),
                'ditetapkan_oleh' => $this->request->getPost('ditetapkan_oleh'),
                'file_upload' => $file_upload,
                'tanggal_ditetapkan' => $this->request->getPost('tanggal_ditetapkan'),
                'tanggal_diundangkan' => $this->request->getPost('tanggal_diundangkan'),
                'keyword' => $this->request->getPost('keyword'),
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/peraturan/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('listErrors', json_decode($response->getBody())->messages)->withInput();
        }
    }

    public function edit($id = null)
    {

        if ($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/peraturan/edit/' . $id,
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
        $file_sementara = $this->request->getPost('file_sementara');
        if (!empty($_FILES['file_upload']['name'])) :
            $validationRules = [
                'file_upload' => [
                    'rules' => 'uploaded[file_upload]|mime_in[file_upload,application/pdf]',
                    'errors' => [
                        'uploaded' => 'file wajib diupload.',
                        'mime_in' => 'file harus bertipe PDF.'
                    ]
                ],
                'judul_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'nomor_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],

                'jenis_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],

                'isi_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],

                'ditetapkan_oleh' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'tanggal_ditetapkan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],

                'tanggal_diundangkan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],

                'keyword' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],

            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
            }

            //menghapus file sebelumnya atau di replace
            if (!empty($file_sementara)) {
                if (file_exists('uploads/peraturan/pdf/' . $file_sementara)) :
                    unlink('uploads/peraturan/pdf/' . $file_sementara);
                endif;
            }

            $pdf_file = $this->request->getFile('file_upload');
            if (!$pdf_file->hasMoved()) :
                $filenamepdf_file = $pdf_file->getRandomName();
                $pdf_file->move('uploads/peraturan/pdf', $filenamepdf_file);
                $file_upload = $filenamepdf_file;
            endif;

        else :
            $file_upload = $file_sementara;
        endif;
        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/peraturan/update/' . $id,
            'form_params' => [
                'judul_peraturan' => $this->request->getPost('judul_peraturan'),
                'nomor_peraturan' => $this->request->getPost('nomor_peraturan'),
                'jenis_peraturan' => $this->request->getPost('jenis_peraturan'),
                'isi_peraturan' => $this->request->getPost('isi_peraturan'),
                'ditetapkan_oleh' => $this->request->getPost('ditetapkan_oleh'),
                'file_upload' => $file_upload,
                'tanggal_ditetapkan' => $this->request->getPost('tanggal_ditetapkan'),
                'tanggal_diundangkan' => $this->request->getPost('tanggal_diundangkan'),
                'keyword' => $this->request->getPost('keyword'),
            ],
        ];
        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 200) {
            return redirect()->to('/admin/peraturan/index')->with('success', 'Data berhasil disimpan.');
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
                'api_path' => '/api/peraturan/edit/' . $id,
            ];
            $response1 = $this->request($dataRequest1);
            if ($response1->getStatusCode() == 200) {
                $result = json_decode($response1->getBody(), true);

                if (file_exists('uploads/peraturan/pdf/' . $result['file_upload'])) :
                    unlink('uploads/peraturan/pdf/' . $result['file_upload']);
                endif;
            }
            //end hapus gambar dlu sebelum hapus record 

            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/peraturan/delete/' . $id,
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
