<?php

class About extends Controller {

    public function index($nama = 'Ian')
    {
        $data['judul'] = 'About';
        $data['nama'] = $nama;
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    public function page($nama = "Ian")
    {
        echo "LOKASI: About/page";
        echo "<br/>";
        echo "Halo! Saya " . $nama;
    }


}