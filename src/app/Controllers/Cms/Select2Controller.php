<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;

class Select2Controller extends BaseAdminController
{
    use ResponseTrait;

    public function jabatan($id = null)
    {
        $data = [];

        $api_path = '/api/jabatan';
        if($id) {
            $api_path = '/api/jabatan/show/' . $id;
        }
        
        $dataRequest = [
            'method' => 'GET',
            'api_path' => $api_path,
        ];        

        $response = $this->request($dataRequest);
        
        if($response->getStatusCode() != 200) {
            return $this->respond($data, 404);
        }

        if($response->getStatusCode() == 200) {
            $decodeResponse = json_decode($response->getBody(), true);
            if($id) {
                $data['id'] = $decodeResponse['id'];
                $data['text'] = $decodeResponse['nama'];
            } else {
                foreach($decodeResponse as $row) {
                    $item['id'] = $row['id'];
                    $item['text'] = $row['nama'];
                    $data[] = $item;
                }
            }
        }
        
        return $this->respond($data, 200);
    }
    
    public function pendidikan($id = null)
    {
        $data = [];

        $api_path = '/api/pendidikan';
        if($id) {
            $api_path = '/api/pendidikan/show/' . $id;
        }
        
        $dataRequest = [
            'method' => 'GET',
            'api_path' => $api_path,
        ];        

        $response = $this->request($dataRequest);
        
        if($response->getStatusCode() != 200) {
            return $this->respond($data, 404);
        }

        if($response->getStatusCode() == 200) {
            $decodeResponse = json_decode($response->getBody(), true);
            if($id) {
                $data['id'] = $decodeResponse['id'];
                $data['text'] = $decodeResponse['nama'];
            } else {
                foreach($decodeResponse as $row) {
                    $item['id'] = $row['id'];
                    $item['text'] = $row['nama'];
                    $data[] = $item;
                }
            }
        }
        
        return $this->respond($data, 200);
    }

    public function provinsi($id = null)
    {
        $data = [];

        $api_path = '/api/provinsi';
        if($id) {
            $api_path = '/api/provinsi?kode=' . $id;
        }
        
        $dataRequest = [
            'method' => 'GET',
            'api_path' => $api_path,
        ];        

        $response = $this->request($dataRequest);
        
        if($response->getStatusCode() != 200) {
            return $this->respond($data, 404);
        }

        if($response->getStatusCode() == 200) {
            $decodeResponse = json_decode($response->getBody(), true);
            if($id) {
                $data['id'] = $decodeResponse['kode'];
                $data['text'] = $decodeResponse['nama'];
            } else {
                foreach($decodeResponse as $row) {
                    $item['id'] = $row['kode'];
                    $item['text'] = $row['nama'];
                    $data[] = $item;
                }
            }
        }
        
        return $this->respond($data, 200);
    }
}
