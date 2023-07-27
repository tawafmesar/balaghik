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
                <h1 class="">نبذه عن الموقع</h1>
                            <h2 class="m-0">بلاغك هو موقع يمكنك من رفع بلاغاتك</h2>
                            <h2 class="m-0">   ويقوم بأستعراض البلاغات المرفوعة وامكانية الحذف والتعديل </h2>

              </div>
            </div>
            


          </div>

          <!-- End Welcome Widget -->
          <!-- Start Quick Draft Widget -->
          <div class="quick-draft p-20 bg-white rad-10">
    
           <img class="shaking" src="./img/logo2.png" width="60%" alt="">

  
            </div>

          <!-- End Quick Draft Widget -->

      </div>
    </div>
  </body>
</html>


            <script>


            const activee = document.getElementById('index');
                  activee.classList.add("active");


</script>
<?php
} else {
  include "./includes/loginheader.php";

  echo "  <h1 class='error'>
    للدخول الى هذه الصفحة يجب عليك تسجيل الدخول
            </h1>";

  header("refresh:1.8;url=login.php");

  

  exit();


}

ob_end_flush();

?>


