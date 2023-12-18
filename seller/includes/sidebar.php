<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/material-dashboard.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <button class="w3-bar-item w3-button w3-large text-white"
        onclick="w3_close()">&#9776;</button>
        <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <div class="navbar-brand m-0">
                <span class="ms-1 font-weight-bold text-white">GOcantini Admin</span>
            </div>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white bg-gradient-warning" href="../pages/dashboard.html">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">First page</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white " href="add-category.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Add Category</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
          <div class="mx-3">
            <a class="btn bg-gradient-warning mt-4 w-100" href="../logout.php" type="button">Logout</a>
          </div>
        </div>
      </aside>
    <!-- open sidebar-->
    <div>
        <button class="w3-button w3-white w3-xlarge" onclick="w3_open()">&#9776;</button>
    </div>
    <script>
        function w3_open() {
            document.getElementById("sidenav-main").style.display = "block";
        }
        function w3_close() {
            document.getElementById("sidenav-main").style.display = "none";
        }
        </script>

</body>
</html>