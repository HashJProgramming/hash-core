<?php
function sign_in(){
    $con = mysqli_connect(settings('database','host'), settings('database','username'), settings('database','password'), settings('database','database'));
    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            if ($row = $result-> fetch_assoc()) {
                $_SESSION['ID'] = hash('sha256', $row['ID']);
                $location_success = settings('site-settings','dashboard');
                header("Location: $location_success?sign-in-success=true");
                exit();
            }
        }else {
            $location_failed = settings('site-settings','site-sign-in');
            header("Location: $location_failed?sign-in-failed=true");
            exit();
        }
    }
}

function sign_in_form(){
    if(!authenticator('auth-bool')){
        $location = settings('site-settings','dashboard');
        header("Location: $location");
    }
    echo '<!doctype html>
<html lang="en">
<head>
    <title>'.settings('site-settings','site-name').'</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html,body {
            height: 100%;
        }

        .global-container{
            height:100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        form{
            padding-top: 10px;
            font-size: 14px;
            margin-top: 30px;
        }

        .card-title{ font-weight:300; }

        .btn{
            font-size: 14px;
            margin-top:20px;
        }


        .login-form{
            width:330px;
            margin:20px;
        }

        .sign-up{
            text-align:center;
            padding:20px 0 0;
        }

        .alert{
            margin-bottom:-30px;
            font-size: 13px;
            margin-top:20px;
        }
    </style>
</head>
<body>

<div class="global-container">
    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Sign In to '.settings('site-settings','site-name').'</h3>
            <div class="card-text">';

                if (isset($_GET['sign-in-failed'])){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div>';
                }

                echo'<form method="post" action="'.sign_in().'">

                    <div class="form-group">
                        <label for="ExampleInputusername">username</label>
                        <input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputpassword">Password</label>
                        <input type="password" class="form-control form-control-sm" id="exampleInputPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Sign in</button>

                    <div class="sign-up">
                        Dont have an account? <a href="'.settings('site-settings', 'site-sign-up').'">Create One</a>
                    </div>
                </form>';



            echo '</div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>';
}