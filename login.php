<?php
session_start();
include 'databaase.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php

    $loggedInUser = null;
    $isValid = true;

    $username_error = $passwordErr = "";
    $username = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = !empty($_POST["username"]) ? trim($_POST["username"]) : null;
        $password = !empty($_POST["password"]) ? md5($_POST["password"]) : null;

        if (empty($username)) {
            $username_error = "Username is required";
            $isValid = false;
        }

        if (empty($password)) {
            $passwordErr = "Password is required";
            $isValid = false;
        }

        if ($isValid) {
            $sql = "SELECT * FROM login_clients_users WHERE username='$username' AND password='$password'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['loggedInUser'] = $row;

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully Logged In',
                    text: 'Welcome back, " . htmlspecialchars($row['username']) . "!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = 'dashboard.php';
                });
            </script>";
                exit;
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'Invalid username or password!',
                    showConfirmButton: true
                });
            </script>";
            }
        }
    }
    ?>

    <div class="container-x">
        <div class="left-section">
            <div class="left-content">
                <h1>Login To Dashboard</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fringilla rhoncus nunc, et vulputate orci. Aliquam scelerisque lacus non amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="right-section">
            <div class="inner-right-sec">
                <h2>Login</h2>
                <form id="login-form" action="" method="POST">
                    <label for="username">Username :</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($username); ?>">
                    <div class="error-msg" id="username-error">
                        <span class="text-danger"><?= $username_error; ?></span>
                    </div>

                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password">
                    <div class="error-msg" id="password-error">
                        <span class="text-danger"><?= $passwordErr; ?></span>
                    </div>

                    <button type="submit">Login</button>
                    <div class="forgot">
                        <a href="#">Forget Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/select2.min.js"></script>
    <script src="./js/script.js" defer></script>
</body>

</html>