<?php




include "../connect.php";
include "../includes/forgetheader.php";



ob_start();
session_start();




if (!isset($_SESSION['user'])) {


  // check if user coming from http post request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    

        $password = $_POST['password'];
        $repassword = $_POST['repassword'];


        $email = $_SESSION['emailresetpassword'] ;


        if ($password  == $repassword) {


            $password = sha1($_POST['password']);
            $data = array("user_password" => $password);
            updateData("users", $data, "user_email = '$email'");


      echo "  <h1 class='succes'>
                       تم تغيير كلمة المرور بنجاح

            </h1>";
            header("refresh:1.8;url=../login.php");


        }else{

      echo "  <h1 class='error'>
            يجب كتابة كلمة المرور مرتين بطريقة صحيحة
            </h1>";
      header("refresh:1.5;url=resetpassword.php");

    }


    }

  include "../includes/forgetheader.php";


  ?>


<!-- partial:index.partial.html -->
<div class="container" id="container">

    
    
        <div class="form-container sign-in-container">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    
            <!-- <span>or use your account</span> -->
            <input class="rtl" type="password" name="password" placeholder="كلمة المرور" required />
            <input class="rtl" type="password" name="repassword" placeholder="كلمة المرور" required />

            <button name="login"> تسجيل دخول</button>
          </form>
        </div>
    
        <div class="overlay-container">
          <div class="overlay">
            <div class="overlay-panel overlay-left">
              <h1>Welcome Back!</h1>
              <p>To keep connected with us please login with your personal info</p>
              <button class="ghost" id="signIn">تسجيل دخول</button>
            </div>
    
            <div class="overlay-panel overlay-right">
                      <img src="../img/logo.png" width="60%" alt="">
              <h1>لأعادة تعيين كلمة المرور</h1>
              <p > يجب ان كون كلمة المرور عدد حروف اكثر من 6</p>
            </div>
          </div>
        </div>
      </div>
    
    
      <!-- partial -->
      <script src="./js/login.js"></script>
    
      </body>




    <?php

  }else {

    header('Location: index.php');

  exit();


  }
      ob_end_flush();
      ?>
