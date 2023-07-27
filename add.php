<?php 
ob_start();
session_start();


include "connect.php";


if (isset($_SESSION['user'])) {

 $countt = 0;
  include "./includes/mainheader.php";



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['add'])) {

      





      $formErrors = array();

      $userid =  $_SESSION['userid'];
      $number = $_POST['number'];
      $main = $_POST['main'];
      $details = $_POST['details'];



        $data = array(
          "report_number" => $number,
          "report_main" => $main,
          "report_details" => $details,
          "report_user" => $userid,

      );


       $countt = insertData("reports", $data);


      

    }

  }

  ?>


      <div class="content w-full">
       
        <!-- Start add -->
        <div class="add">
  <?php
    if ($countt > 0) {


      echo "  <h1 class='succes'>
            تم إضافة البلاغ بنجاح
            </h1>";

      header("refresh:1;url=add.php");

    }
    ?>
        
<!-- partial:index.partial.html -->
<div class="container" id="container">

  <div class="form-container sign-up-container">
            <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <!-- <h1>إنشاء حساب</h1> -->
        
                <!-- <span>or use your email for registration</span> -->
                <input class="rtl" type="text" name="number" placeholder="رقم الطلب" required />
                <input class="rtl" type="text" name="main" placeholder="المشكلة" required />
                <textarea name="details" id="details" cols="30" rows="10"  placeholder="ملاحظة" ></textarea>
                <button name="add">إضافة</button>
              </form>
            </div>



        

        
            <div class="overlay-container">
              <div class="overlay">
                <div class="overlay-panel overlay-left">
                  <img src="./img/logo.png" width="60%" alt="">
                  <h1>    إضافة بلاغ</h1>
        
                </div>
        

              </div>
            </div>
          </div>
        
            <script>
            container.classList.add("right-panel-active");

            const activee = document.getElementById('add');
                  activee.classList.add("active");


</script>

          <!-- partial -->
          <script src="./js/login.js"></script>

        
        </div>
         <!-- end add -->

      </div>
    </body>
  </html>

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


