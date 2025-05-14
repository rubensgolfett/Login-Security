<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="styles/media.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <main>
        <section id="login">
            <div id="image">
            </div>

            <div id="forms">
                <h1>Login</h1>
                <p>Welcom again. Acess your account here down!</p>

                <form action="<?= $_SERVER['PHP_SELF']?>" method="post" autocomplete="on">
                    <div class="camp">

                        <label for="ilogin"><span class="material-icons">person</span></label>
                        <input type="email" name="email" id="ilogin" placeholder="Enter your E-mail" required autocomplete="email" maxlength="50" class="btn">
                        
                    </div>

                    <div class="camp">

                        <label for="ipassword"><span class="material-icons">vpn_key</span></label>
                        <input type="password" name="password" id="ipassword" placeholder="Enter your Password" required autocomplete="current-password" minlength="4" maxlength="20" class="btn">
                    </div>
                    <input type="submit" value="Login">
                    <a href="#" class="botton">forgot password</a>

                </a>
                </form>
            </div>
        </section>
    </main>
</body>
</html>