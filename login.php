<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <?php
    require 'database.php';
    if(isset($_POST['submit'])){
        if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!='' && $_POST['password'] !=''){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM admin WHERE username = '$username' AND passwd = '$password'";
            $result = mysqli_query($conn,$sql);
            if ($result){
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header ('location:index.php');
            }else{
                echo "<script>alert('username or password wrong')</script>";
            }

        }else{
            echo "<script>alert('some thing went wrong or, username or id wrong')</script> ";
        }
    }
    ?>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>