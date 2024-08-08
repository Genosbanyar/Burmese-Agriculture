<?php 
require "view/partials/header.php";

require "config/QueryBuilder.php";

if(isset($_SESSION['user'])){
  header("Location: /");
}
$name="";
$status = false;
//login system
if(isset($_POST['login_btn'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $outputs = $db->select("SELECT * FROM user WHERE email='$email' AND password='$password'");
  foreach($outputs as $output){
    $name = $output['name'];
    $profile = $output['profile'];
    $user_id = $output['id'];
  }
  if($outputs == false){
   $status=true;
  }else{
    $_SESSION['user'] = $name;
    $_SESSION['name'] = $name;
    $_SESSION['profile'] = $profile;
    $_SESSION['user_id'] = $user_id;
    header("Location: /");
  }
  
}
?>
<div class="background">
<?php require "view/components/nav.php";?>
<div class="d-flex align-items-center justify-content-center">
<div class="card mt-10 shadow-sm" style="width: 35rem;>
<div class="card-body">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <a href="/">
    <img class="mx-auto h-12 w-auto" src="img/favicon.png" alt="Your Company">
    </a>
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
  </div>
  <?php if($status):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  Email or password invalid!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif;?>
  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" required class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" required class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button name="login_btn" type="submit" class="flex sing w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a href="registration" class="font-semibold leading-6 register hover:text-indigo-500">Register here</a>
    </p>
  </div>
</div>
  </div>
    </div>
    </div>
    </div>
<?php require "view/partials/footer.php"?>