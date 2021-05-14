<?php

// Session Start
if ( !session_id() ) session_start();

// Bootstraping (memanggil satu file yang akan memanggil file lain)
require_once '../app/init.php';

// Init. Class App
$app = new App;