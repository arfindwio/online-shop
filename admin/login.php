<?php
session_start();
require "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
        <div class="p-5 rounded-3 shadow-lg" style="width: 500px; height: 350px; box-sizing: border-box;">
            <h1 class="text-center mb-3" style="color: red; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">LOGIN ADMIN</h1>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mt-1">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-success mt-3" type="submit" name="btn-login" style="width: 100%;">Login</button>
                </div>
            </form>
        </div>
        <div class="mt-3" style="width: 500px;">
            <?php
            if (isset($_POST['btn-login'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");
                $count_data = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($count_data > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: ../admin');
                    } else {
            ?>
                        <div class="alert alert-danger">
                            Password Salah
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning">
                        Akun Tidak Tersedia
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>