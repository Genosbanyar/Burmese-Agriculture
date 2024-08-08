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
        <a href="#blod" id="#blod" class="text-sm font-semibold leading-6 text-gray-900">Blogs & News</a>
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