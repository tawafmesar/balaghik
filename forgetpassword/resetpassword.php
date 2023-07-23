<?php




include "../connect.php";


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
            echo "   تم تغيير كلمة المرور بنجاح";
            header("refresh:2;url=../login.php");


        }else{

            echo "يجب كتابة كلمة المرور مرتين بطريقة صحيحة";
        }


    }



?>


    <link rel="stylesheet" href="../css/log.css" />

    <div class="containerlog"  dir="ltr">


      <div class="forms-container">

        <div class="signin-signup">
          <form  class="sign-in-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

            <h2  class="title">تسجيل الدخول</h2>

            <div class="input-field">
              <i class="fa-solid fa-circle-user"></i>
              <input name="password" type="text" placeholder=" كلمة المرور"/>
            </div>

         <div class="input-field">
              <i class="fa-solid fa-circle-user"></i>
              <input name="repassword" type="text" placeholder="  اعد كتابة كلمة المرور" />
            </div>

            <input type="submit" value=" حفظ" class="btn solid" />


          </form>

        </div>
      </div>



    </div>





    <?php

  }else {

    header('Location: index.php');

  exit();


  }
      ob_end_flush();
      ?>
