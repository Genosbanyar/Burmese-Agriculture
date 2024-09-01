<?php 
$categories = $db->select("SELECT * FROM categories");

//Name category
$name_category = "";
if(isset($_GET['id_catego'])){
     $catego_id = $_GET['id_catego'];
     $cate_names = $db->select("SELECT * FROM categories WHERE id = $catego_id");
     foreach($cate_names as $cate_name){
     $name_category = $cate_name['name'];
  }
}
?>

 <div class="dropdown text-center">
  <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <?php 
        if(isset($_GET['id_catego'])){
          echo $name_category;
        }else{
          echo "Category";
        }
      ?>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <?php foreach($categories as $category):?>
    <li>
      <a class="dropdown-item" href="/?id_catego=<?= $category['id']?>"><?= $category['name']?></a>
    </li>
  <?php endforeach;?>
  </ul>
</div>