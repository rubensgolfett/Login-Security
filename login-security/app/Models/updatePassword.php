<?php
$path = "../../storage/app/private/users.json";

$email = strtolower($_POST['email'] ?? '');
$newPassword = $_POST['new_password'] ?? '';

if (!$email || !$newPassword) {
    die("Invalid data. <a href='forgot-password.html'>Try again</a>");
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
    echo "<p>Password successfully updated. <a href='../../resources/views/login.html'>Log in</a></p>";
} else {
    echo "<p>Email not found. <a href='../../resources/views/reset.html'>Try again</a></p>";
}
?>
