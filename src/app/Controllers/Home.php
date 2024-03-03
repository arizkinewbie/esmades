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
        $session = session();
        $url = getenv('API_DOMAIN') . "/api/auth/login";
        $data = [
            'email' => getenv('KLIEN_EMAIL'),
            'password' => getenv('KLIEN_PASS'),
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $session->set('jwtToken', json_decode($response)->token);

        curl_close($ch);

        //Get Profile
        $dataRequest = [
            'method' => 'GET',
            'api_path' => '/api/profil?desa_id=29198',
        ];
        $response = $this->request($dataRequest);
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
            $data = [
                'title' => 'Beranda | ' . getenv('APP_NAME'),
                'view' => $this->var['viewPath'] . 'index',
            ];
            $data = array_merge($data, $result[0]);
            return $this->render($data);
        } else {
            return $this->notFound('Halaman tidak ditemukan!');
        }
    }
}
