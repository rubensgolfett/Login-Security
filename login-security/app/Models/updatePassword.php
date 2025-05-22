<?php
$path = "../../storage/app/private/users.json";

$email = strtolower($_POST['email'] ?? '');
$newPassword = $_POST['new_password'] ?? '';

function showMessage($title, $message, $linkText, $linkHref) {
    $accentColor = "#AB48D8";
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$title}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background-color: #ffffff;
                border: 1px solid #e0d8ed;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                text-align: center;
                width: 90%;
                max-width: 400px;
            }
            h1 {
                color: {$accentColor};
                margin-bottom: 10px;
            }
            p {
                color: #333333;
            }
            a {
                display: inline-block;
                margin-top: 15px;
                padding: 10px 20px;
                background-color: {$accentColor};
                color: #ffffff;
                text-decoration: none;
                border-radius: 6px;
                transition: opacity 0.2s ease;
            }
            a:hover {
                opacity: 0.9;
            }
            .password-box {
                margin-top: 15px;
                padding: 8px;
                background: #f9f4fa;
                border: 1px solid #e0d8ed;
                border-radius: 6px;
                font-family: monospace;
                color: #333333;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>{$title}</h1>
            <p>{$message}</p>
            <a href='{$linkHref}'>{$linkText}</a>
        </div>
    </body>
    </html>";
    exit;
}

if (!$email || !$newPassword) {
    showMessage("Invalid Data", "Please provide both email and new password.", "Try Again", "forgot-password.html");
}

$users = json_decode(file_get_contents($path), true);
$updated = false;

foreach ($users as &$user) {
    if (strtolower($user['email']) === $email) {
        $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        $updated = true;
        break;
    }
}

if ($updated) {
    file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT));
    showMessage(
        "Password Updated",
        "Your password has been successfully changed."
        . "<div class='password-box'>{$newPassword}</div>",
        "Log In",
        "../../resources/views/login.html"
    );
} else {
    showMessage("Email Not Found", "We couldn't find an account with that email.", "Try Again", "../../resources/views/reset.html");
}
?>
