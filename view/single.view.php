<?php 
require "view/partials/header.php";
// <!-- navbar -->
require "view/components/nav.php";
require "config/QueryBuilder.php";

$title = "";
$body = "";
$time = "";
$cover = "";
$intro = "";
$author="";
$show_id = $_GET['id_blog'];

//single blog swee htoke
if(isset($_GET['id_blog'])){
  $blog_id = $_GET['id_blog'];
  $singles = $db->select("SELECT * FROM shows WHERE id=$blog_id");
  foreach($singles as $single){
    $title = $single['title'];
    $intro = $single['intro'];
    $body = $single['body'];
    $time = $single['created_at'];
    $cover = $single['cover'];
    $author = $single['author'];
  }
}

//comment add
if(isset($_POST['btn_comment'])){
  $db->insertComment([
    'body' => $_POST['comment'],
    'profile' => $_SESSION['profile'],
    'user_id' => $_SESSION['user_id'],
    'show_id' => $_GET['id_blog'],
    'username' => $_SESSION['user']
]);
}

//favorite add
if(isset($_POST['favorite'])){
  $db->insertFavorite([
    'title' => $title,
    'category_id' => $time,
    'intro' => $intro,
    'author' => $author,
    'body' => $body,
    'img' => $cover,
    'user_id' => $_SESSION['user_id'],
    'show_id' => $_GET['id_blog']
]);
}
//comment count
$rowCount = $db->count("SELECT * FROM comment WHERE show_id = $show_id"); 
//comment session show
$comments = $db->select("SELECT * FROM comment WHERE show_id = $show_id");
//following count
if(isset($_SESSION['user_id'])){
  $checkFollowings = $db->count("SELECT * FROM followings WHERE show_id=$_GET[id_blog] AND user_id=$_SESSION[user_id]");
}
?>
<!-- single blog section -->
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="card shadow-sm">
      <div class="following d-flex justify-content-between">
        <img src="img/<?= $cover?>" class="card-img-top img"/>
        <?php if(isset($_SESSION['user'])):?>
        <form action="" method="POST">
                  <?php if($checkFollowings > 0):?>
                  <button name="favorite" class="mt-4 mr-4" disabled type="submit">
                  <i class="fa-solid fa-heart"></i>
                  </button>
                  <?php else:?>
                  <button name="favorite" class="mt-4 mr-4" type="submit">
                  <i class="fa-regular fa-heart"></i>
                  </button>
                  <?php endif;?>
                  </form>
                <?php endif;?>
              </div>
        <div class="card-body">
          <div class="text-info">
          <span><?= $author;?></span> | <span><?php 
                $original=$time;
                $new=new DateTime($original);
                $current=$new->format('F j, Y');
                echo $current;
                ?></span></span>
          </div>
        
        <h3 class="title my-4"><strong><?= $title?></strong></h3>
      <p class="lh-md paragraph">
        <?= $body?>
      </p>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="container">
  <div class="col-md-8 mx-auto">
    <h5 class="my-3 text-secondary">Comments (<?= $rowCount?>)</h5>
    <!--single-->
    <?php foreach($comments as $comment):?>
    <div class="card d-flex p-3 my-3 shadow-sm">
      <div class="d-flex">
        <div>
          <img style="background-position: center;
        object-fit: cover;" src="img/<?= $comment['profile']?>" class="vector_comment">
        </div>
        <div class="ms-3">
          <h6><?= $comment['username']?></h6>
          <p class="text-secondary"><?php 
                $original=$comment['created_at'];
                $new=new DateTime($original);
                $current=$new->format('F j, Y');
                echo $current;
                ?></p>
        </div>
      </div>
      <p class="mt-1"><?= $comment['body']?>
      </p>
    </div>
    <?php endforeach;?>
  </div>
</section>

<!-- comment -->
<?php if(isset($_SESSION['user'])):?>
<section class="container my-5 text-center" id="subscribe">
  <div class="row">
    <div class="col-md-5 mx-auto">
      <div class="card shadow-sm">
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3">
              <textarea
                name="comment"
                placeholder="Enter your comment..."
                class="form-control border border-0"
              ></textarea>
            </div>
            <div class="btn btn-success text-white float-end">
              <button name="btn_comment" type="submit">Enter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else:?>
  <p class="text-center my-5">Please <a class="text-info" href="login">login</a> to participate in this discussion.</p>
<?php endif;?>

<h4 class="text-center my-4 fw-bold">Blogs You May Like</h4>

<?php require "view/components/blog-you-may-like.php"?>
<!-- footer -->

<?php require"view/partials/footer.php";?>
