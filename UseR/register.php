<?php
session_start();

// Initialize variables
$username = "";
$email    = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project');

// When the register button is clicked
if (isset($_POST['reg_user'])) {
    // Receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Form validation: Ensure that the form is correctly filled
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // Check if the user already exists
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // If user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // Register user if no errors
    if (count($errors) == 0) {
        $password = md5($password_1); // Encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password) 
                  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php'); // Redirect to home page
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="f">
        <!-- Action attribute points to the same file, 'register.php' -->
        <form method="post" action="register.php">
            <?php if (count($errors) > 0): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <div class="xxx">
                <h1 id="seeyzx">Sign Up</h1>
                <a href="login.php"><h1 id="cfghg">X</h1></a>
            </div>
            <div class="in">
                <label for="username"></label>
                <input type="text" id="username" name="username" required placeholder="Name" value="<?php echo $username; ?>">
            </div>
            <div class="in">
                <label for="email"></label>
                <input type="email" id="email" name="email" required placeholder="Email" value="<?php echo $email; ?>">
            </div>
            <div class="in">
                <label for="password"></label>
                <input type="password" id="password" name="password_1" required placeholder="Password">
            </div>
            <div class="in">
                <label for="password_2"></label>
                <input type="password" id="password_2" name="password_2" required placeholder="Confirm Password">
            </div>
            <div class="btn">
                <button type="submit" class="btn" name="reg_user">Create account</button>
            </div>
            <div class="prp">
                <input type="checkbox" name="pp" id="pp" class="c2-pp" required>
                <div class="pp1">
                    <label for="pp">By continuing, I agree to the terms of use & privacy policy.</label>
                </div>
            </div>
            <div class="nusr">
                Already have an account?<a href="login.php"><span>Login here</span></a>
            </div>
        </form>
    </div>
</body>
</html>
