<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/register.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <main>
        <section id="login">
            <div id="image">
            </div>

            <div id="forms">
                <h1>Registrer</h1>
                <p>Hello, are you new here? Sign up now below!</p>

                <form action="<?= $_SERVER['PHP_SELF']?>" method="post" autocomplete="on">
                    <div class="camp">
                        
                        <label for="iusername"><span class="material-icons">person</span></label>

                        <input type="text" name="username" id="iusername" placeholder="Create your UserName" require autocomplete="name" maxlength="100" class="btn">

                        <label for="ilogin"><span class="material-icons">account_circle</span></label>

                        <input type="email" name="create-email" id="ilogin" placeholder="User your E-mail" required autocomplete="email" maxlength="50" class="btn">
                        
                    </div>

                    <div class="camp">

                        <label for="ipassword"><span class="material-icons">vpn_key</span></label>
                        <input type="password" name="create-password" id="ipassword" placeholder="Create your Password" required autocomplete="current-password" minlength="4" maxlength="20" class="btn">
                    </div>

                    <input type="submit" value="Register">
                    <p>You have a account? <a href="login.php" id="min-bottom">Login here!</a></p>

                </a>
                </form>
            </div>
        </section>
    </main>
</body>
</html>