<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand active text-white" href="index.php">GOcantini</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon active">
		<i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
	  </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active bi bi-house" aria-current="page" href="index.php"> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bi bi-cart-check" href="orders.php"> Pending Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bi bi-currency-exchange" href="order-history.php"> Paid Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bi-ui-checks" href="order-completed.php"> Completed Orders</a>
        </li
        <?php 
          if(isset($_SESSION['auth']))
          {
            ?>
            <li class="nav-item">
              <a class="nav-link active bi bi-person-circle" href="profile.php">
                <?= ucwords($_SESSION['auth_user']['name']); ?>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link active bi bi-box-arrow-right" href="../logout.php"> Logout</a>
            </li>
            <?php
          }
          else 
          {
            ?>
               <li class="nav-item">
                  <a class="nav-link active" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="login.php">Login</a>
                </li>
            <?php
          }
        ?>
       
        
      </ul>
    </div>
  </div>
</nav>