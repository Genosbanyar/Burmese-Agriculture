<?php 
require "view/partials/header.php";
require "config/QueryBuilder.php";
if(isset($_SESSION['user'])){
  header("Location: /");
}
//Create Acc
$nameErr = "";
$emailErr = "";
$addressErr = "";
$passErr = "";
$confirmErr = "";
$pattern = '/^[a-zA-Z0-9._%+-]+@gmail+\.com$/';
if(isset($_POST['regist_btn'])){

  if(empty($_POST['name'])){
    $nameErr = "The name field is required!";
  }
  if(empty($_POST['email'])){
    $emailErr = "The email field is required!";
  }
  if(empty($_POST['address'])){
    $addressErr = "The address field is required!";
  }
  if(empty($_POST['password'])){
    $passErr = "The password field is required!";
  }
  if(empty($_POST['confirm-password'])){
    $confirmErr = "The confirm-password field is required!";
  }
  if($_POST['password'] !== $_POST['confirm-password']){
    $confirmErr = "The password does not match!";
  }
  if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['password']) && $_POST['password'] == $_POST['confirm-password']){
    $emailCount = $db->count("SELECT * FROM user WHERE email='$_POST[email]'");
    if($emailCount > 0){
      $emailErr = "Email is already taken!";
    }
    else if(preg_match($pattern,$_POST['email']) == 0){
      $emailErr = "Please text the corret email!";
    }
    else{
    $db->insert([
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'address' => $_POST['address'],
      'password' => $_POST['password'],
      'profile' => $_POST['profile']
    ]);
    $outputs = $db->select("SELECT * FROM user WHERE email='$_POST[email]' AND password='$_POST[password]'");
    $user_id="";
    foreach($outputs as $output){
      $user_id = $output['id'];
    }
    $_SESSION['user'] = $_POST['name'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['profile'] = $_POST['profile'];
    $_SESSION['user_id'] = $user_id;
    header("Location: /");
  }  
  }
}
?>

<div class="background-re bg-green">
<?php require "view/components/nav.php"?>;
<div class="d-flex align-items-center justify-content-center">
<div class="card shadow-sm mt-10" style="width: 40rem;>
<div class="card-body">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <a href="/">
    <img class="mx-auto h-12 w-auto" src="img/favicon.png" alt="Your Company">
    </a>
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Registration Form</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="" method="POST">
      <div>
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
        <div class="mt-2">
          <input id="name" name="name" type="text" autocomplete="text" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['name'];}?>" class="block is-valid input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
        <span class="text-danger"><?= $nameErr;?></span>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['email'];}?>" class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
        <span class="text-danger"><?= $emailErr;?></span>
      </div>

      <div>
        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
        <div class="mt-2">
          <textarea class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" id="address" name="address"><?php if(isset($_POST['regist_btn'])){echo $_POST['address'];}?></textarea>
        </div>
        <span class="text-danger"><?= $addressErr;?></span>
      </div>

      <div>
        <label for="profile" class="block text-sm font-medium leading-6 text-gray-900">Add Profile</label>
        <div class="mt-2">
        <input id="profile" name="profile" type="file" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['profile'];}?>" class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['password'];}?>" class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
        <span class="text-danger"><?= $passErr;?></span>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="confirm-password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
        </div>
        <div class="mt-2">
          <input id="confirm-password" name="confirm-password" type="password" autocomplete="current-password" value="<?php if(isset($_POST['regist_btn'])){echo $_POST['confirm-password'];}?>" class="block input w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
        </div>
        <span class="text-danger"><?= $confirmErr;?></span>
      </div>

      <div>
        <button name="regist_btn" type="submit" class="flex sing w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      <a href="login" class="font-semibold leading-6 register hover:text-indigo-500">I have already account.</a>
    </p>
  </div>
</div>
  </div>
    </div>
    </div>
    </div>
<?php require "view/partials/footer.php"?>