<?php 
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location: admin_login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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
      .container {
        margin-top: 50px;
        margin-right: 200px;
        float: right; 
      }
      .number {
        font-weight: bold;
      }
      .container-nav {
        background-color: #071e3d;
        height: 80px;
      }
      .navi {
        width: 85rem;
        display: flex;
        justify-content: space-between;
        padding-top: 19px;
        margin: 0 auto;
      }
      .font {
        font-weight: bold;
        color: white;
        font-size: 25px;
      }
      .font_admin {
        font-size: 20px;
        color: white;
      }
      ul {
        list-style: none;
        margin-top: 20px;
      }
      a {
        color: whitesmoke;
        font-size: 20px;
      }
      li {
        padding-bottom: 30px;
      }
      .image{
        width: 55%;
      }
      section {
        background-color: #1f4287;
        width: 230px;
        display: inline-block;
        height: 200rem;
      }
      .flex {
        width: 200px;
        display: flex;
        justify-content: space-between;
      }
    </style>
  </head>
  <?php 
  require "config/QueryBuilder.php";
  $adminNameErr="";
  $emailErr="";
  $passErr="";
  if(isset($_POST['btn_post'])){
    if(empty($_POST['admin_name'])){
      $adminNameErr = "The name field is required!";
    }
    if(empty($_POST['email_admin'])){
      $emailErr = "The email field is required!";
    }
    if(empty($_POST['password_admin'])){
      $passErr = "The password field is required!";
    }
    if(!empty($_POST['admin_name']) && !empty($_POST['email_admin']) && !empty($_POST['password_admin'])){
        $db->insertAdmin([
            'name' => $_POST['admin_name'],
            'email' => $_POST['email_admin'],
            'password' => $_POST['password_admin']
        ]);
    $_SESSION['post'] = "Admin created successfully";
    header("Location: admins_in");
    }
  }
  ?>
  <body>
    <div class="container-nav">
      <nav class="navi">
        <span class="font">BURMESE AGRICULTURE</span>
        <div class="flex">
          <span class="font_admin"><?= $_SESSION['user_name']?></span>
          <?php if(isset($_SESSION['user_name'])):?>
          <a onclick="return confirm('Are you sure to logout?')" href="logout"
            >Logout</a
          >
          <?php endif;?>
        </div>
      </nav>
    </div>
    <section>
    <ul>
        <li>
          <a href="dashboard">Home</a>
        </li>
        <li>
          <a href="admins_in">Admins</a>
        </li>
        <li>
          <a href="show">Shows</a>
        </li>
      </ul>
    </section>
    <div class="container">
      <div class="row">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between">
                    <h3>Add new admins</h3>
                    </div> 
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                    <div class="form-group">
                    <input name="admin_name" class="form-control" type="text" value="<?php if(isset($_POST['btn_post'])){echo $_POST['admin_name'];}?>" placeholder="Enter admin name">
                    <span class="text-danger"><?= $adminNameErr;?></span>
                    </div>
                    <div class="form-group">
                    <input name="email_admin" class="form-control" type="email" value="<?php if(isset($_POST['btn_post'])){echo $_POST['email_admin'];}?>" placeholder="Enter admin email">
                    <span class="text-danger"><?= $emailErr;?></span>
                    </div>
                    <div class="form-group">
                    <input name="password_admin" class="form-control" type="password" value="<?php if(isset($_POST['btn_post'])){echo $_POST['password_admin'];}?>" placeholder="Enter password">
                    <span class="text-danger"><?= $passErr;?></span>
                    </div>
                </div>
                <div class="card-footer">
                <button name="btn_post" class="btn btn-primary">Add++</button>
                </div>
                </form>
            </div>
        </div>
      </div>
    </div>

    <script
      src="https://kit.fontawesome.com/225a355f8f.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
