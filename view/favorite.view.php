<?php 
require "view/partials/header.php";
require "config/QueryBuilder.php";
if(!isset($_SESSION['user'])){
  header("Location: /");
}
$user_id = $_SESSION['user_id'];
  
$followings = $db->select("SELECT * FROM followings WHERE user_id=$user_id");

//delete blogs
if(isset($_POST['favorite'])){
  $out = $db->deleteQuery("DELETE FROM followings WHERE id=$_POST[show_id] AND user_id=$user_id");
  header("Location: favorite");
}
?>
<nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="/" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-10 w-auto" src="img/favicon.png">
        </a>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Blogs & News</a>
        <a href="about" class="text-sm font-semibold leading-6 text-gray-900">About</a>
        <?php if(isset($_SESSION['user'])):?>
        <a href="favorite" class="text-sm font-semibold leading-6 text-gray-900">Favorites</a>
        <?php endif;?>
      </div>
      <?php if(trim($_SERVER['REQUEST_URI'], "/") !== 'login' && trim($_SERVER['REQUEST_URI'], "/") !== 'registration' && !isset($_SESSION['user'])): ?>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="login" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
      </div>
      <?php else:?>
        <?php if(isset($_SESSION['user'])):?>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <span class="profile"><img class="vector" src="<?= "img/".$_SESSION['profile']?>"></span>
        <a href="logout" onclick="return confirm('Are you sure to logout?')" class="text-sm font-semibold leading-6 text-gray-900"><?= $_SESSION['user']?><span aria-hidden="true">&rarr;</span></a>
      </div>
      <?php endif;?>
      <?php endif;?>
    </nav>
    <h4 class="display-6 mt-4 fw-bold text-center mb-4">Favorite blogs</h4><hr>
    <div class="fav">
<?php foreach($followings as $show):?>
<div class="col-md-4 mb-4">
          <div class="card card-following">
            <img
              src="img/<?= $show['img']?>"
              class="card-img-top"
              alt="..."
            />
            <div class="card-body">
              <h4 class="card-title"><?= $show['title']?></h4>
              <p class="fs-6 text-secondary">
              <?= $show['author']?>
                <span> - 
                <?php 
                $original=$show['cre'];
                $new=new DateTime($original);
                $current=$new->format('F j, Y');
                echo $current;
                ?></span>
              </p>
              <div class="tags my-3">
              <span class="badge bg-warning text-dark"><?php 
              if($show['category_id'] == 1)
              {
                echo "စိုက်ပျိုးနည်း";
              }else{
                echo "ခေတ်သစ်စိုက်ပျိုးနည်း";
              }
              ?></span>
              </div>
              <p class="card-text mb-3">
                <?= $show['intro']?>
              </p>
              <a href="single?id_blog=<?= $show['id']?>" class="btn get text-white">Read More</a>
              <form action="" method="POST">
              <div class="following d-flex float-end">
                <input type="hidden" name="show_id" value="<?= $show['id']?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']?>">
                <button name="favorite" onclick="return confirm('Are you sure to delete?')" type="submit"><i class="fa-solid fa-trash"></i></button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <?php endforeach?>
        </div>
        <?php if($followings==false):?>
        <div class="card err shadow-sm">
          <p class="text-danger fav-err">Favorite လုပ်ထားခြင်းမရှိပါ။</p>
        </div>
        <?php endif;?>
        <?php require "view/partials/footer.php"?>