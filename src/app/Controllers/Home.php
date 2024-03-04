<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $var = [];
    protected $apiDomain;
    protected $token;


    public function __construct()
    {
        $this->var['viewPath'] = 'home/';
        $this->apiDomain = getenv('API_DOMAIN');
    }

    public function index()
    {
        $this->setJwtToken();
        //Get Profile
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/profil?desa_id=29198',
        ];
        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 200) {
            $profileData = json_decode($response->getBody(), true);
            $data = [
                'title' => 'Beranda | ' . getenv('APP_NAME'),
                'view' => $this->var['viewPath'] . 'index',
            ];
            $data = array_merge($data, $profileData[0]);
            return $this->render($data);
        } else {
            return $this->notFound('Halaman tidak ditemukan!');
        }
    }
}
