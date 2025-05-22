<?php
$path = "../../storage/app/private/users.json";
$email = strtolower($_POST['email'] ?? null);

if (!$email) {
    die("<p>Email not provided. <a href='../../resources/views/reset.html'>Go back</a></p>");
}

$users = json_decode(file_get_contents($path), true);
$found = false;

foreach ($users as $user) {
    if (strtolower($user['email']) === $email) {
        $found = true;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #372991;
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #ffffff;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label span.material-icons {
            font-size: 40px;
            color: #ffffff;
        }

        input[type="password"] {
            padding: 12px 15px;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            background-color: #fff;
            color: #372991;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        input[type="password"]:focus {
            outline: none;
            background-color: #f0f0ff;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
        }

        input[type="submit"] {
            padding: 12px;
            border: none;
            background-color: #6150e9;
            color: white;
            border-radius: 10px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #7c65f3;
            transform: scale(1.05);
        }

        a {
            color: #ffd;
            text-decoration: underline;
            display: block;
            margin-top: 20px;
        }
    </style>
    <link rel="shortcut icon" href="../../resources/img/logo-white.png" type="image/x-icon">
</head>
<body>
    <main>
        <?php if ($found): ?>
            <h2>Enter New Password</h2>
            <form action="updatePassword.php" method="post" autocomplete="off">
                <label for="ipassword"><span class="material-icons">vpn_key</span></label>
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <input type="password" name="new_password" id="ipassword" placeholder="New password" required minlength="8" maxlength="20">
                <input type="submit" value="Update Password">
            </form>
        <?php else: ?>
            <p>Email not found.</p>
            <a href="../../resources/reset.html">Try again</a>
        <?php endif; ?>
    </main>
</body>
</html>
