<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand" href="index.php">GoCantini</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon active">
		<i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
	  </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" >
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">
            <i class="bi bi-house"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="categories.php">
            <i class="bi bi-grid"></i> Categories </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cart.php">
            <i class="bi bi-cart3"></i> Cart </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="my-orders.php">
            <i class="bi bi-card-list"></i> Order Details </a>
        </li>
        <?php 
          if(isset($_SESSION['auth']))
          {
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="profile.php"> <i class="bi bi-person-circle"></i> <?= ucwords($_SESSION['auth_user']['name']); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="logout.php">
                <i class="bi bi-box-arrow-right"></i> Logout
              </a>
            </li>


            <?php
          }
          else 
          {
            ?>
               <li class="nav-item">
                  <a class="nav-link active" href="register.php">
                    <i class="bi bi-person-plus"></i>Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="login.php">
                    <i class="bi bi-box-arrow-in-right"></i>Login</a>
                </li>
            <?php
          }
        ?>
       
        
      </ul>
    </div>
  </div>
</nav>