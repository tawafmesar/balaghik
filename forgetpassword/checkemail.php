<?php

include "../connect.php";


ob_start();
session_start();




if (!isset($_SESSION['user'])) {


  // check if user coming from http post request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    

        $email = $_POST['email'];

        $verfiycode = rand(10000, 99999);

        $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND user_approve = 2  ");
        $stmt->execute(array($email));
        $count = $stmt->rowCount();

        if ($count > 0) {
            $data = array("user_verifycode" => $verfiycode);
            
            updateData("users", $data, "user_email = '$email'");
            sendEmail($email, "Verfiy Code Ecommerce", "Verfiy Code $verfiycode");
            $_SESSION['emailresetpassword'] = $email;


            header("url=verifycode.php");

        }else{

            

      echo "  <h1 class='error'>
            البريد الالكتروني الذي ادخلته ليس موجود
            </h1>";
      header("refresh:1.5;url=checkemail.php");


    }


    }


  include "../includes/forgetheader.php";



  ?>


<!-- partial:index.partial.html -->
<div class="container" id="container">



    <div class="form-container sign-in-container">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h1>  ادخل البريد الألكتروني</h1>

        <!-- <span>or use your account</span> -->
        <input class="rtl" type="email" name="email" placeholder="البريد الألكتروني" required />
        <button name="login">  تأكيد</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">

        <div class="overlay-panel overlay-right">
                  <img src="../img/logo.png" width="60%" alt="">

          <h2>هل نسيت كلمة المرور</h2>
          <p>ادخل البريد الألكتروني المرتبط بحسابك</p>
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

