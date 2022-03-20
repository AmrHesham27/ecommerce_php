<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php
        if ($_SESSION['user']){
          echo"
          <li class='nav-item'>
            <a class='nav-link' href='todo_form.php'>todo form</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='todo_show.php'>todo show</a>
          </li>
          <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='blog.php'>Blog</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='form.php'>Add new article</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='logout.php'>Logout</a>
          </li>
          ";
        }
        else {
          echo"
          <li class='nav-item'>
            <a class='nav-link' href='login.php'>Login</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='register.php'>Register</a>
          </li>";
        } 
        ?>
      </ul>
    </div>
  </div>
</nav>