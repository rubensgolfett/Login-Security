<?php 
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(403); // Forbidden
        die('Access denied.');
    }



    $email = $_POST['email'];
    $password = $_POST['password'];
