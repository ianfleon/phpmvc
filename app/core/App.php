<?php

class App {

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    
    // Constructor
    public function __construct()
    {
        $url = $this->parseURL(); // ambil nilai dari func. parseURL

        if ( $url != NULL ) {
            if ( file_exists('../app/controllers/' . $url[0]. '.php') ) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if ( isset($url[1]) ) {
            if ( method_exists($this->controller, $url[1]) ) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if ( !empty($url) ) {
            $this->params = array_values($url);
        }

        // var_dump($this->params);

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    // Parsing URL
    public function parseURL()
    {
        // mengecek url yang dikirim
        if ( isset($_GET['url']) ) {
            $url = rtrim($_GET['url'], '/'); // menghilangkan '/' pada akhir URL
            $url = filter_var($url, FILTER_SANITIZE_URL); // membersihkan URL dari karater aneh selain angka dan huruf
            $url = explode('/', $url); // memecah string menjadi array dengan delimiter '/'

            return $url; // return nilai
        }
    }

}