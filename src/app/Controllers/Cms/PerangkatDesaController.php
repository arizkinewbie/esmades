<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Files\File;

class PerangkatDesaController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->titleHeader = 'Perangkat Desa';
        $this->var['viewPath'] = 'cms/perangkat_desa/';
        $this->apiDomain = getenv('API_DOMAIN');
    }

    public function index()
    {
        $data = [
            'title' => 'Aset Desa',
            'subTitle' => 'Index '.$this->titleHeader,
            'dataTable' => true,
            'token' => session('jwtToken'),
            'apiDomain' => getenv('API_DOMAIN'),
            'view' => $this->var['viewPath'] . 'index',
        ];
        return $this->render($data);
    }

    public function new() {
        $data = [
            'title' => $this->titleHeader,
            'subTitle' => 'Tambah Data '.$this->titleHeader,
            'select2' => true,
            'pickr' => true,
            'token' => session('jwtToken'),
            'view' => $this->var['viewPath'] . 'new',
        ];
        return $this->render($data);
    }
    
    public function testing() {
        $validationRules      = [
            'foto' => [
                'uploaded[foto]',
                'mime_in[foto,image/png,image/jpg,image/jpeg]',
            ],
            'surat_keputusan' => [
                'uploaded[surat_keputusan]',
                'mime_in[surat_keputusan,application/pdf]',
            ],
        ];

        if (! $this->validate($validationRules)) {
            return $this->respond([
                'status' => false,
                'message' => $this->validator->getErrors(),
            ], 400);
        }

        $fotoNama = '';
        $foto = $this->request->getFile('foto');
        if (! $foto->hasMoved()) {
            $filenameFoto = $foto->getRandomName();
            $foto->move('uploads/perangkat_desa/images', $filenameFoto);
            $fotoNama = $filenameFoto;
        }
        $suratKeputusanNama = '';
        $suratKeputusan = $this->request->getFile('surat_keputusan');
        if (! $suratKeputusan->hasMoved()) {
            $filenameSuratKeputusan = $suratKeputusan->getRandomName();
            $suratKeputusan->move('uploads/perangkat_desa/pdf', $filenameSuratKeputusan);
            $suratKeputusanNama = $filenameSuratKeputusan;
            
        }

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/perangkat_desa/create',
            'form_params' => array_merge($this->request->getPost(), [
                'desa_id' => '29198',
                'foto' => $fotoNama,
                'surat_keputusan' => $suratKeputusanNama,
            ]),
        ];

        $response = $this->request($dataRequest);

        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/perangkat_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages);
        }
    }
    
    public function create() {
        
        $validationRules      = [
            'foto' => [
                'uploaded[foto]',
                'mime_in[foto,image/png,image/jpg,image/jpeg]',
            ],
            'surat_keputusan' => [
                'uploaded[surat_keputusan]',
                'mime_in[surat_keputusan,application/pdf]',
            ],
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
        }

        $fotoNama = '';
        $foto = $this->request->getFile('foto');
        if (! $foto->hasMoved()) {
            $filenameFoto = $foto->getRandomName();
            $foto->move('uploads/perangkat_desa/images', $filenameFoto);
            $fotoNama = $filenameFoto;
        }
        $suratKeputusanNama = '';
        $suratKeputusan = $this->request->getFile('surat_keputusan');
        if (! $suratKeputusan->hasMoved()) {
            $filenameSuratKeputusan = $suratKeputusan->getRandomName();
            $suratKeputusan->move('uploads/perangkat_desa/pdf', $filenameSuratKeputusan);
            $suratKeputusanNama = $filenameSuratKeputusan;
            
        }

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/perangkat_desa/create',
            'form_params' => array_merge($this->request->getPost(), [
                'desa_id' => '29198',
                'foto' => $fotoNama,
                'surat_keputusan' => $suratKeputusanNama,
            ]),
        ];

        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 201) {
            return redirect()->to('/admin/perangkat_desa/index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages);
        }
    }
    
    public function edit($id = null) {

        if($id) {
            $dataRequest = [
                'method' => 'GET',
                'api_path' => '/api/perangkat_desa/edit/' . $id,
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

        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/perangkat_desa/show/' . $id,
        ];
        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 200) {
            $findData = json_decode($response->getBody(), true);
            $validationRulesFoto      = [
                'foto' => [
                    'uploaded[foto]',
                    'mime_in[foto,image/png,image/jpg,image/jpeg]',
                ],
            ];
    
            $fotoNama = '';
            $foto = $this->request->getFile('foto');
            if($foto->isValid()) {
                if(!$this->validate($validationRulesFoto)) {
                    return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
                }
                $foto = $this->request->getFile('foto');
                $nama_foto = $foto->getRandomName();
                $fotoNama = $nama_foto;

                $foto->move('uploads/perangkat_desa/foto', $nama_foto);
                if(file_exists('uploads/perangkat_desa/foto/' . $findData['foto'])) {
                    unlink('uploads/perangkat_desa/foto/' . $findData['foto']);
                }
            }

            $validationRulesSuratKeputusan      = [
                'surat_keputusan' => [
                    'uploaded[surat_keputusan]',
                    'mime_in[surat_keputusan,application/pdf]',
                ],
            ];
            
            $suratKeputusanNama = '';
            $suratKeputusan = $this->request->getFile('surat_keputusan');
            if($suratKeputusan->isValid()) {
                if(!$this->validate($validationRulesSuratKeputusan)) {
                    return redirect()->back()->withInput()->with('listErrors', $this->validator->getErrors());
                }
                $suratKeputusan = $this->request->getFile('surat_keputusan');
                $namaSuratKeputusan = $suratKeputusan->getRandomName();
                $suratKeputusanNama = $namaSuratKeputusan;

                $foto->move('uploads/perangkat_desa/pdf', $namaSuratKeputusan);
                if(file_exists('uploads/perangkat_desa/pdf/' . $findData['surat_keputusan'])) {
                    unlink('uploads/perangkat_desa/pdf/' . $findData['surat_keputusan']);
                }
            }
    
            $addPost['desa_id'] = '29198';
            if($fotoNama) $addPost['foto'] = $fotoNama;
            if($suratKeputusanNama) $addPost['foto'] = $suratKeputusanNama;
            $dataRequest = [
                'method' => 'POST',
                'api_path' => '/api/perangkat_desa/update/' . $id,
                'form_params' => array_merge($this->request->getPost(), $addPost),
            ];
    
            $response = $this->request($dataRequest);
            if ($response->getStatusCode() == 200) {
                return redirect()->to('/admin/perangkat_desa/index')->with('success', 'Data berhasil disimpan.');
            } else {
                return redirect()->back()->withInput()->with('listErrors', json_decode($response->getBody())->messages);
            }
        }
        
    }
}
