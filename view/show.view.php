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
  $shows = $db->select("SELECT * FROM shows");
  $countShow = $db->count("SELECT * FROM shows");
  if(isset($_GET['id_blog_delete'])){
    $db->deleteQuery("DELETE FROM shows WHERE id=$_GET[id_blog_delete]");
    header("Location: show");
  }
  if(isset($_GET['pageno'])){
    $pageno = $_GET['pageno'];
  }else{
    $pageno = 1;
  }
  $noOfrec = 5;
  $offset = ($pageno - 1) * $noOfrec;
  $total_pages = ceil($countShow / $noOfrec);
  $offsetQuery = $db->select("SELECT * FROM shows ORDER BY id LIMIT $offset,$noOfrec");
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
    <?php if(isset($_SESSION['post'])):?>
    <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['post']; unset($_SESSION['post']);?>
    </div>
    <?php endif;?>
      <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between">
                    <h3>Shows</h3>
                    <a href="add" class="btn btn-primary float-right">Create Shows</a>
                    </div> 
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>image</th>
                                <th>intro</th>
                                <th>body</th>
                                <th>category</th>
                                <th>created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($offsetQuery as $show):?>
                            <tr>
                                <td><?= $show['id']?></td>
                                <td><?= $show['title']?></td>
                                <td><img class="image" src="<?= "img/".$show['cover']?>" alt=""></td>
                                <td><?= $show['intro']?></td>
                                <td><textarea row="30"><?= $show['body']?></textarea></td>
                                <td><?= $show['category_id']?></td>
                                <td><?= $show['created_at']?></td>
                                <td><a class="btn btn-warning" href="edit?id_update=<?= $show['id']?>">Edit</a> |
                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" href="?id_blog_delete=<?= $show['id']?>">delete</a>
                            </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>  
                </div>
            </div>
            <nav aria-label="Page navigation example" style="float: right;">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                    <li class="page-item <?php if($pageno <= 1){echo "disabled";}?>"><a class="page-link" href="<?php if($pageno <= 1){echo "#";}else{echo "?pageno=".($pageno - 1);}?>">Periovs</a></li>
                    <li class="page-item"><a class="page-link" href="#"><?= $pageno;?></a></li>
                    <li class="page-item <?php if($pageno >= $total_pages){echo "disabled";}?>"><a class="page-link" href="<?php if($pageno >= $total_pages){echo "#";}else{echo "?pageno=".($pageno + 1);}?>">Next</a></li>
                    <li class="page-item"><a class="page-link" href="?pageno=<?= $total_pages?>">Last</a></li>
                </ul>
            </nav>
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
