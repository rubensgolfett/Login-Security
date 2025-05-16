<?php
    

    use Illuminate\Validation\Rules\Email;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(403); // Forbidden
        die('<h1>Access denied.</h1>');
    }

    // Path to the JSON file
    $path = "../../storage/app/private/users.json";
        // Function to validate username, email, and password
    function validateData($username, $email, $password) {

        // Validate username
        if (!$username || strlen($username) > 75) {
            return "<p>Invalid username! <a href='../../resources/views/register.html'>to go back</a></p>";
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "<p>Invalid email! <a href='../../resources/views/register.html'>to go back</a></p>";
        }

        // Validate password length between 8 and 20 characters
        if (strlen($password) < 8 || strlen($password) > 20) {
            return "<p>Password must have between 8 and 20 characters! <a href='../../resources/views/register.html'>to go back</a></p>";
        }

        return null; // Data is valid
    }

    // Function to check if the user already exists
    function userExists($email, $username, $creatUser) {
        foreach ($creatUser as $user) {
            if ($user['email'] === $email || $user['username'] === $username) {
                return true;
            }
        }
        return false;
    }

    // Function to save new user data
    function saveNewUser($username, $email, $password, $path, $creatUser) {
        // Add new user to the array
        $creatUser[] = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ];

        // Save data to the JSON file
        if (file_put_contents($path, json_encode($creatUser, JSON_PRETTY_PRINT)) === false) {
            return "Error saving data! <a href='../../resources/views/register.html'>to go back</a>";
        }
        return "<p>User successfully registered!<p>";
    }
    

    // Get form data
    $username = $_POST["username"] ?? null;
    $email = strtolower($_POST["create-email"] ?? null);
    $password = $_POST["create-password"] ?? null;

    
    // Validate received data
    $error = validateData($username, $email, $password);
    if ($error) {
        echo $error;
        exit; // Exit script if there's an error
    }

    // Read the JSON file and check if it's valid
    $creatUser = json_decode(file_get_contents($path), true);
    if (!is_array($creatUser)) {
        $creatUser = [];
    }

    // Check if the user already exists
    if (userExists($email, $username, $creatUser)) {
        echo "<p>This email or username is already registered. <a href='../../resources/views/register.html'>to go back</a></p>";
        exit;
    }
    
    // Save the new user
    $result = saveNewUser($username, $email, $password, $path, $creatUser);
    echo $result;
?>


<?php 
    $data = json_decode(file_get_contents("../../storage/app/private/users.json"), true) ?? [];
    $finaldata = end($data);
    echo "
    Last registered user{
    <ul>
        <li class='parament'> Username =>". $finaldata["username"] ."
        <li class='parament'> Email =>". $finaldata["email"] ."
    </ul>
    }";
?>
    <a href="../../public/index.html">Confirm data</a>
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
        text-decoration: none;
        margin: 0 auto;
        text-align: center;
        padding: 10px 20px;
        border: 1px solid teal;
        border-radius: 10px;
        background-color: white;
        color: teal;
        margin-top: 8px;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.438);
    }

    a:hover {
        text-decoration: underline;
        background-color: aliceblue;
        color: lightgray;
        transition: color 0.4s;
    }

    ul {
        list-style-type: none;
    }

    .parament {
        color: #372991;
        font-size: 1.1em;
    }
</style>