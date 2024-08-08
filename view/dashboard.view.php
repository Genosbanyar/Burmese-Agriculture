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
      .card {
        width: 350px;
        height: 120px;
        margin-left: 50px;
      }
      .container-admin {
        display: flex;
        margin-top: 50px;
        margin-right: 700px;
        width: 700px;
        float: right;
        justify-content: space-between;
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
      section {
        background-color: #1f4287;
        width: 230px;
        display: inline-block;
        height: 730px;
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
  $showCount = $db->count("SELECT * FROM shows"); $adminCount =
  $db->count("SELECT * FROM admins"); $categories = $db->select("SELECT * FROM
  categories"); //Name category $name_category = "";
  if(isset($_GET['id_catego'])){ $catego_id = $_GET['id_catego']; $cate_names =
  $db->select("SELECT * FROM categories WHERE id = $catego_id");
  foreach($cate_names as $cate_name){ $name_category = $cate_name['name']; } }
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
    <div class="container container-admin">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="number mb-3">Blogs</div>
          <div class="">
            Number of blogs
            <?= $showCount?>
          </div>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="number mb-3">Admins</div>
          <div class="">
            Number of admins
            <?= $adminCount?>
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
