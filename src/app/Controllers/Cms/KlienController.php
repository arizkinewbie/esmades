<?php

namespace App\Controllers\Cms;

use App\Controllers\Cms\BaseAdminController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;

class KlienController extends BaseAdminController
{
    use ResponseTrait;
    protected $var = [];
    protected $apiDomain;
    protected $titleHeader;

    public function __construct()
    {
        $this->var['viewPath'] = 'cms/agama/';
        $this->apiDomain = getenv('API_DOMAIN');
        $this->titleHeader = 'Agama';
    }

    public function validasi()
    {

        $dataRequest = [
            'method' => 'POST',
            'api_path' => '/api/klien',
        ];
        $response = $this->request($dataRequest);

        $result = json_decode($response->getBody());
        return $this->respond($result);
    }
}
