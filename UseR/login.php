<?php
session_start();
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project');

// When the login button is clicked
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Validate form inputs
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // If no errors, attempt login
    if (count($errors) == 0) {
        $password = md5($password); // Encrypt the password to match the stored one
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php'); // Redirect to homepage after successful login
        } else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tomato/LogIn</title>
        <link rel="icon" href="fruits-and-vegetables-tomato-pack.png" type="image/icon">
        <link rel="stylesheet" href="lg.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    </head>
<body>
    <div class="box">
        <div class="c1">
            <h1 class="inside-c1-1">Login</h1>
            <form method="post" action="login.php">
                <?php if (count($errors) > 0): ?>
                    <div class="error">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <a href="index.php"><button class="inside-c1-2" type="button">X</button></a>
        </div>
        <div class="c2">
            <input type="email" name="email" class="c2-em" placeholder="Your email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
            <input type="password" name="password" class="c2-pass" placeholder="Password" required>
            <button type="submit" class="c2-btn" name="login_user">Login</button>
            <div class="prp">
                <input type="checkbox" name="pp" id="pp" class="c2-pp">
                <div class="pp1">
                    <label for="pp">By continuing, I agree to the terms of use & privacy policy.</label>
                </div>
            </div>
            <div class="nusr">
                Create a new account?<a href="register.php"><span>Click here</span></a>
            </div>
        </div>
    </div>
</body>
</html>
