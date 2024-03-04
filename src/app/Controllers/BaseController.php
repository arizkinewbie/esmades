<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    protected function notFound($message = 'Not Found')
    {
        // Load helper 'html' untuk menggunakan fungsi link_tag() dan heading()
        helper('html');
        // Buat tampilan HTML untuk pesan 404
        $data = [
            'title' => '404 Not Found',
            'message' => $message
        ];
        $body = view('errors/html/error_404', $data);
        // Return response dengan status code 404 dan tampilan HTML
        return $this->response->setStatusCode(404)->setBody($body);
    }
    protected function render($data = [])
    {
        // Load main
        $main = view('public/templates/main', $data);
        return $main;
    }
    protected function request($data = [])
    {
        $url = getenv('API_DOMAIN') . $data['api_path'];
        $token = session('jwtToken');
        $options = [];

        $client = \Config\Services::curlrequest();
        $options['http_errors'] = false;
        $options['headers'] = ['Authorization' => 'Bearer ' . $token];

        if (isset($data['form_params'])) {
            $options['form_params'] = $data['form_params'];
        }
        if (isset($data['multipart'])) {
            $options['multipart'] = $data['multipart'];
        }

        $response = $client->request($data['method'], $url, $options);
        return $response;
    }
    protected function setJwtToken()
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
    }
}
