<?php require "view/partials/header.php"?>
<?php 
require "config/QueryBuilder.php";
$shows = $db->select("SELECT * FROM shows");

//search bar
$searchErr = "";
if(isset($_POST['btn_search'])){
  $search_value = $_POST['search_value'];
  $shows = $db->select("SELECT * FROM shows WHERE title LIKE '%".$search_value."%'");
  if($shows == false){
    $searchErr = "No Blogs Found.";
  }
}

?>
<div class="bg-green">
  <header class="absolute inset-x-0 top-0 z-50">
    
    <?php require "view/components/nav.php"?>
    <?php if(isset($_SESSION['name'])):?>
    <div class="alert text-center alert-info alert-dismissible fade show" role="alert">
    Welcome <?php echo $_SESSION['name']; unset($_SESSION['name']);?>
    </div>
    <?php endif;?>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
          </a>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
            </div>
            <div class="py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <?php require "view/components/hero_session.php";?>
</div>

<!-- blogs section -->
<h1 class="display-6 mt-4 fw-bold text-center mb-4">Blogs & News</h1>

<!-- category section -->
<?php 
require "view/components/drop-down.php";

if(isset($_GET['id_catego'])){
  $catego_id = $_GET['id_catego'];
  $shows = $db->select("SELECT * FROM shows WHERE category_id = $catego_id");
}
?>

<section class="container text-center" id="blogs">
  <div class="row">
    <div class="col-md-10 mx-auto">
    <form action="" class="my-3" method="POST">
        <div class="input-group mb-3">
          <input
            type="text"
            autocomplete="false"
            name="search_value"
            value="<?php if(isset($_POST['search_value'])){
              echo $_POST['search_value'];
            }?>"
            class="form-control"
            placeholder="Search Blogs..."
          />
          <button
            class="input-group-text text-white bg-success"
            id="basic-addon2"
            name="btn_search"
            type="submit"
          >
            Search
          </button>
        </div>
      </form>
      <h3 class="text-danger title badge text-center"><?= $searchErr;?></h3>
      <div class="row">

        <?php require "view/components/blog-card.php";?>
        
      </div>
    </div>
  </div> 
    </section>
    <!-- about section -->
<h1 class="display-6 mt-4 fw-bold text-center mb-4">About US</h1>
    <div class="container mt-10 mb-10">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex juctify-content-between">
            <div class="letter para-title">
            <p><strong>BURMESE AGRICULTURE စိုက်ပျိုးရေးဖုန်းဆော့ဝဲလ်က တောင်သူများ၊ စိုက်ပျိုးရေးလုပ်ငန်းများအတွက် မရှိမဖြစ်လိုအပ်တဲ့ ဖုန်းဆော့ဝဲဖြစ်ပါတယ်။ BURMESE AGRICULTUREမှာ ကဏ္ဍ (၂) ခု ကို ဦးစားပေးထည့်သွင်းထားပါတယ်။</strong></p>

<p class="para-title mt-10">
<span class="header">၁။ လေ့လာစရာများ</span><br>
စိုက်ပျိုးရေး လုပ်ငန်းနှင့် သက်ဆိုင်သော နည်းပညာဗဟုသုတများကို အလွယ်တကူ လေ့လာနိုင်အောင် ဖော်ပြပေးထားပါတယ်။ ထို့အပြင် စိုက်ပျိုးမွေးမြူရေး သတင်းများ၊ အထွေထွေဗဟုသုတများ မိမိဒေသအတွက် ရနိုင်မှာဖြစ်ပါတယ်။​
</p>


<p class="para-title mt-10">
<span class="header">၂။ စီးပွားရေးကဏ္ဍ</span><br>
<p>
စိုက်ပျိုးရေးကို စီးပွားရေးတစ်ခုလို မြင်ပြီး လုပ်ဆောင်မှာသာ ရေရှည်ဖွံ့ဖြိုးတိုးတက်လာမှာဖြစ်ပါတယ်။ ဒါကြောင့် တောင်သူများကို စီးပွားရေးကဏ္ဍများနှင့် ချိတ်ဆက်နိုင်ဖို့ ကျွန် ေတာ်တို့ အဖွဲ့သားတွေက အမြဲမပြတ် ကြိုးစားနေပါတယ်။​ ပထမဆုံးအနေဖြင့် ကျွန် ေတာ်တို့ လူမှုကွန်ရက်စာမျက်နှာ ပေါ်မှာရှိတဲ့ အစိမ်းရောင်မှတ်တမ်းက စိုက်ပျိုးစရိတ်တွေကို မှတ်သားပြီး အရှုံးအမြတ်ကို တွက်ချက်ပေးမှာဖြစ်ပါတယ်။ 
</p>
        </div>
        </div>
            </div>
            <div class="col-md-4">
            <img src="img/agri_cv.png" alt="">
            </div>
        </div>
    </div>
     <!-- footer section -->
     
<?php require "view/partials/footer.php"?>