<?php 

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(403); // Forbidden
        die('Access denied.');
    }

    function emailExist($pathJson, $verifyEmail) {
        if (!file_exists($pathJson)) {
            http_response_code(500);
            die('file of users not found. <a href="../../resources/views/login.html"> Try Again </a>');
        }

        $jsonData = file_get_contents($pathJson);
        $users = json_decode($jsonData, true);

        if (!is_array($users)) {
            http_response_code(500);
            die('Error decoding JSON. <a href="../../resources/views/login.html"> Try Again </a>');
        }

        foreach ($users as $user) {
            if (isset($user['email']) && strtolower($user['email']) === $verifyEmail) {
                return true;
            }
        }
        return false;
    }

    function verifyPassword($pathJson, $email, $password) {
        if (!file_exists($pathJson)) {
            http_response_code(500);
            die('File of users not found. <a href="../../resources/views/login.html"> Try Again </a>');
        }

        $jsonData = file_get_contents($pathJson);
        $users = json_decode($jsonData, true);

        if (!is_array($users)) {
            http_response_code(500);
            die('Error decoding JSON. <a href="../../resources/views/login.html"> Try Again</a>');
        }

        foreach ($users as $user) {
            if (
                isset($user['email'], $user['password']) &&
                strtolower($user['email']) === strtolower($email)
            ) {
                return password_verify($password, $user['password']);
            }
        }

        return false;
    }

    $path = "../../storage/app/private/users.json";
    $email = strtolower($_POST["email"] ?? null);
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        http_response_code(400); // Bad Request
        die('Email or Password not provided. <a href="../../resources/views/login.html"> Try Again </a>');
    }

    // Etapas separadas
    if (!emailExist($path, $email)) {
        echo "<p>Email not found. <a href='../../resources/views/login.html'> Try Again </a></p>";
    } elseif (!verifyPassword($path, $email, $password)) {
        echo "<p>Incorrect password. <a href='../../resources/views/login.html'> Try Again </a></p>";
    } else {
        echo "<p>You are logged in. <a href='../../public'> Go to Project </a></p>";
    }
?>

<style>
    * {
        margin: 0px;
        padding: 12px;
        box-sizing: border-box;
    }
    
    body {
        border-radius: 7px;
        background-color: white;
        overflow: hidden;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 50%;
        left: 50%;
        transition-timing-function: ease;
        transition: width 0.5s, height 0.6s;
        transform: translate(-50%, -50%);
    }

    a {
        display: block;
        margin: 0 auto;
        text-align: center;
        padding: 10px 20px;
        border: 1px solid teal;
        border-radius: 10px;
        background-color: white;
        color: teal;
        margin-top: 8px;
        text-decoration: none;
        font-size: 1.5em;
        cursor: pointer;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.438);
    }
    a:hover {
        text-decoration: underline;
        padding: 6px;
        background-color: aliceblue;
        color: lightgray;
        text-shadow: 1px 1px 3px black;
        transition: padding 0.4s;
    }
</style>