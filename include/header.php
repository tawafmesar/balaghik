
<!DOCTYPE html>
<html lang="ar" dir="rtl" >
<head>
  <meta charset="UTF-8">
  <title>صـحـتـك تـهـمنـا</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo">

  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/framework.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/aos.css" />
  <link rel="stylesheet" href="css/all.css" />

  <link rel="stylesheet" href="css/style.css">


</head>
<body>
  <!-- partial:index.partial.html -->
  <header class="fixed-top">
  		  <button class="toggle-nav">
  			    <span>></span>
  		  </button>

        <ul class="nav">
            <li class="loud"><a href="index.php"> صحتك تهمنا </a></li>
  			    <li class="loud"><a href="index.php#team">خدماتنا</a></li>
  			    <li class="loud"><a href="index.php#team2">من نحن</a></li>
  			    <li class="loud"><a href="mailto:manala4@tvtc.gov.sa">تواصل معنا</a></li>
            <?php
            if (!isset($_SESSION['user'])) { ?>
              <li class="loud"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true" style="margin-left:4px;"></i>دخول</a></li>

            <?php }else {
              ?>
              <li class="loud"><a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-left:4px;"></i>خروج</a></li>
              <li class="loud " id="notf" ><a href="trained.php"><i class="fa-solid fa-circle-user"></i></a></li>
              <li class="loud " id="notf" ><a href="excuse.php"><i class="fa-solid fa-bell"></i></a></li>
              <?php
            }
            ?>


  		  </ul>

  	</header>
