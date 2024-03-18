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
        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Index ' . $this->titleHeader,
            'dataTable' => true,
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
                'api_path' => '/api/aset_di_desa/show/' . $id,
            ];
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody(), true);
                $data = [
                    'title' => $this->titleHeader,
                    'subTitle' => 'Detail ' . $this->titleHeader,
                    'select2' => true,
                    'dataTable' => true,
                    'token' => session('jwtToken'),
                    'apiDomain' => getenv('API_DOMAIN'),
                    'view' => $this->var['viewPath'] . 'detail',
                ];
                $data = array_merge($data, $result);
                return view('cms/kabar_desa/show', $data);
            }
        }
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
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'gambar wajib diupload.',
                    'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                ]
            ],
            'nik' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'max_length' => '{field} tidak boleh lebih dari 15 karakter.'
                ]
            ],
            'nama_pemilik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
            'jenis_aset' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'penggunaan_lahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'status_pemilik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'penduduk_asli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'luas_lahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'koordinat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'koordinat wajib di isi.'
                ]
            ],

            'poligon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'pengamanan_fisik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'keterangan_fisik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
            'pengamanan_fisik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
            'keterangan_hukum' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
        ];

        if ($this->request->getPost('pengamanan_hukum') == 'ada') :
            $validationRules += [
                'file_surat_kepemilikan' => [
                    'rules' => 'uploaded[file_surat_kepemilikan]|mime_in[file_surat_kepemilikan,application/pdf]|max_size[file_surat_kepemilikan,2048]',
                    'errors' => [
                        'uploaded' => 'File Surat Kepemilikan wajib diupload.',
                        'mime_in' => 'File Surat Kepemilikan harus bertipe (PDF).',
                        'max_size' => 'Ukuran file PDF tidak boleh lebih dari 2 MB.'
                    ]
                ],
                'nomor_bukti_kepemilikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di isi.'
                    ]
                ],
                'nomor_bukti_kepemilikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di isi.'
                    ]
                ],
            ];
        endif;

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }

        // Grab the file by name given in HTML form
        $files = $this->request->getFileMultiple('foto');

        $no = 0;

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

        if ($this->request->getPost('pengamanan_hukum') == 'ada') :
            $pdfNama = '';
            $pdf_file = $this->request->getFile('file_surat_kepemilikan');
            if (!$pdf_file->hasMoved()) :
                $filenamepdf_file = $pdf_file->getRandomName();
                $pdf_file->move('uploads/aset_di_desa/pdf', $filenamepdf_file);
                $file_surat_kepemilikan = $filenamepdf_file;
            endif;
        else :
            $file_surat_kepemilikan = '';
        endif;

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/aset_di_desa/create',
            'form_params' => [
                'nik'           => $this->request->getPost('nik'),
                'nama_pemilik'  => $this->request->getPost('nama_pemilik'),
                'no_npwp'  => $this->request->getPost('no_npwp'),
                'letak_objek_pajak'  => $this->request->getPost('letak_objek_pajak'),
                'jenis_pajak'  => $this->request->getPost('jenis_pajak'),
                'perkiraan_nilai_objek_pajak'  => $this->request->getPost('perkiraan_nilai_objek_pajak'),
                'bulan_jatuh_tempo'  => $this->request->getPost('bulan_jatuh_tempo'),
                'penggunaan_lahan' => $this->request->getPost('penggunaan_lahan'),
                'jenis_aset'    => $this->request->getPost('jenis_aset'),
                'status_pemilik' => $this->request->getPost('status_pemilik'),
                'penduduk_asli' => $this->request->getPost('penduduk_asli'),
                'luas_lahan' => $this->request->getPost('luas_lahan'),
                'koordinat' => $this->request->getPost('koordinat'),
                'poligon' => $this->request->getPost('poligon'),
                'pengamanan_fisik' => $this->request->getPost('pengamanan_fisik'),
                'keterangan_fisik' => $this->request->getPost('keterangan_fisik'),
                'pengamanan_hukum' => $this->request->getPost('pengamanan_hukum'),
                'keterangan_hukum' => $this->request->getPost('keterangan_hukum'),
                'nomor_bukti_kepemilikan' => $this->request->getPost('nomor_bukti_kepemilikan'),
                'foto' => json_encode($hasil),
                'file_surat_kepemilikan' => $file_surat_kepemilikan
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

        $validationRules = [
            'nik' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'max_length' => '{field} tidak boleh lebih dari 15 karakter.'
                ]
            ],
            'nama_pemilik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'penggunaan_lahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'jenis_aset' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'status_pemilik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'penduduk_asli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'luas_lahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'koordinat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'koordinat wajib di isi.'
                ]
            ],

            'poligon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'pengamanan_fisik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],

            'keterangan_fisik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
            'pengamanan_fisik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
            'keterangan_hukum' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'
                ]
            ],
        ];

        if (!empty($_FILES['foto']['name'])) :
            $validationRules += [
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'gambar wajib diupload.',
                        'mime_in' => 'gambar harus bertipe (PNG, JPG, JPEG).'
                    ]
                ]
            ];
        endif;

        if ($this->request->getPost('pengamanan_hukum') == 'ada') :
            $validationRules += [
                'nomor_bukti_kepemilikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di isi.'
                    ]
                ],
                'nomor_bukti_kepemilikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di isi.'
                    ]
                ],
            ];
            if (!empty($_FILES['file_surat_kepemilikan']['name'])) :
                $validationRules += [
                    'file_surat_kepemilikan' => [
                        'rules' => 'uploaded[file_surat_kepemilikan]|mime_in[file_surat_kepemilikan,application/pdf]|max_size[file_surat_kepemilikan,2048]',
                        'errors' => [
                            'uploaded' => 'File Surat Kepemilikan wajib diupload.',
                            'mime_in' => 'File Surat Kepemilikan harus bertipe (PDF).',
                            'max_size' => 'Ukuran file PDF tidak boleh lebih dari 2 MB.'
                        ]
                    ]
                ];
            endif;
        endif;

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }

        if (!empty($_FILES['foto']['name'])) :
            // Grab the file by name given in HTML form
            $files = $this->request->getFileMultiple('foto');

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

        if (!empty($_FILES['file_surat_kepemilikan']['name'])) :

            $pdfNama = '';
            $pdf_file = $this->request->getFile('file_surat_kepemilikan');
            if (!$pdf_file->hasMoved()) :
                $file_pdf = $this->request->getPost('nama_file_pdf');
                if (file_exists('uploads/aset_di_desa/pdf/' . $file_pdf)) :
                    unlink('uploads/aset_di_desa/pdf/' . $file_pdf);
                endif;

                $filenamepdf_file = $pdf_file->getRandomName();
                $pdf_file->move('uploads/aset_di_desa/pdf', $filenamepdf_file);
                $file_surat_kepemilikan = $filenamepdf_file;
            endif;
        else :
            $file_surat_kepemilikan = $this->request->getPost('nama_file_pdf');
        endif;

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/aset_di_desa/update/' . $id,
            'form_params' => [
                'id'            => $id,
                'nik'           => $this->request->getPost('nik'),
                'nama_pemilik'  => $this->request->getPost('nama_pemilik'),
                'no_npwp'  => $this->request->getPost('no_npwp'),
                'letak_objek_pajak'  => $this->request->getPost('letak_objek_pajak'),
                'penggunaan_lahan'  => $this->request->getPost('penggunaan_lahan'),
                'jenis_pajak'  => $this->request->getPost('jenis_pajak'),
                'perkiraan_nilai_objek_pajak'  => $this->request->getPost('perkiraan_nilai_objek_pajak'),
                'bulan_jatuh_tempo'  => $this->request->getPost('bulan_jatuh_tempo'),
                'jenis_aset'    => $this->request->getPost('jenis_aset'),
                'status_pemilik' => $this->request->getPost('status_pemilik'),
                'penduduk_asli' => $this->request->getPost('penduduk_asli'),
                'luas_lahan' => $this->request->getPost('luas_lahan'),
                'koordinat' => $this->request->getPost('koordinat'),
                'poligon' => $this->request->getPost('poligon'),
                'pengamanan_fisik' => $this->request->getPost('pengamanan_fisik'),
                'keterangan_fisik' => $this->request->getPost('keterangan_fisik'),
                'pengamanan_hukum' => $this->request->getPost('pengamanan_hukum'),
                'keterangan_hukum' => $this->request->getPost('keterangan_hukum'),
                'nomor_bukti_kepemilikan' => $this->request->getPost('nomor_bukti_kepemilikan'),
                'foto' => $hasil_array,
                'file_surat_kepemilikan' => $file_surat_kepemilikan
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

                if (file_exists('uploads/aset_di_desa/pdf/' . $result['file_surat_kepemilikan'])) :
                    unlink('uploads/aset_di_desa/pdf/' . $result['file_surat_kepemilikan']);
                endif;

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
