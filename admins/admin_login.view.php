<?php 
session_start();
if(isset($_SESSION['user_name'])){
    header("Location: dashboard");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link rel="icon" type="image/x-icon" href="img/favicon.png" />
    <script
      src="https://kit.fontawesome.com/225a355f8f.js"
      crossorigin="anonymous"
    ></script>
    <style>
        .card{
            width: 500px;
        }
        .col-md-4 {
            margin-top: 200px;
        }
    </style>
</head>
<body>
<?php 
require "config/QueryBuilder.php";
$status = false; 
if(isset($_POST['btn_login'])){
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $out = $db->select("SELECT * FROM admins WHERE email='$email' AND password='$password'");
 if($out==true){
    $outputs = $db->select("SELECT * FROM admins WHERE email='$_POST[admin_email]' AND password='$_POST[admin_password]'");
    $name = "";
    foreach($outputs as $output){
        $name = $output['name']; 
    }
    $_SESSION['user_name'] = $name;
    header("Location: dashboard");
 }else{
    $status = true; 
 }
}
?>    
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
        <div class="card shadow-sm">
            <form action="" method="POST">
                <div class="card-body">
                <?php if($status):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email or password invalid!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <?php endif;?>
                    <div class="form-group">
                    <label>Email:</label>
                    <input placeholder="Enter admin email" name="admin_email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                    <label>Password:</label>
                    <input placeholder="Enter password" name="admin_password" type="password" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button name="btn_login" type="submit" class="btn btn-primary">Login</button>
                </div>
                </form>
        </div>
        <div class="col-md-4">

        </div>
    </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/225a355f8f.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>