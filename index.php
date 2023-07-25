<?php 
ob_start();
session_start();


include "connect.php";


if (isset($_SESSION['user'])) {


  include "./includes/mainheader.php";

  ?>


      <div class="content w-full">
       
        <!-- Start Head -->
        <div class="head bg-white p-15 between-flex">
          <div class="search p-relative">
            <input class="p-10" type="search" placeholder="للبحث اكتب هنا ..." />
          </div>

        </div>

        <!-- End Head -->
        <h1 class="p-relative">الرئيسية</h1>
        <div class="wrapper d-grid gap-20">
          <!-- Start Welcome Widget -->
          <div class="welcome bg-white rad-10 txt-c-mobile block-mobile">
            <div class="intro p-20 d-flex space-between bg-eee">
              <div>
                <h2 class="m-0">نبذه</h2>
                <p class="c-grey mt-5">هنا نكتب نبذه</p>
              </div>
            </div>
            
              <h1></h1>
              <h1></h1>
              <br>
              <br>
                         <br>
              <br>
              <br>

              <br>
              <br>
              <br>

              <h1></h1>
              <h1></h1>

          </div>

          <!-- End Welcome Widget -->
          <!-- Start Quick Draft Widget -->
          <div class="quick-draft p-20 bg-white rad-10">
            <h2 class="mt-0 mb-10">خلفية</h2>
            <p class="mt-0 mb-20 c-grey fs-15">هنا صورة خلفية</p>

              <h1></h1>
              <h1></h1>
              <h1></h1>
              <h1></h1>


            </div>

          <!-- End Quick Draft Widget -->

      </div>
    </div>
  </body>
</html>

<?php
} else {
  include "./includes/loginheader.php";

  echo "  <h1 class='error'>
    للدخول يجب عليك تتسجيل الدخول
            </h1>";

  header("refresh:1.8;url=login.php");

  

  exit();


}

ob_end_flush();

?>


