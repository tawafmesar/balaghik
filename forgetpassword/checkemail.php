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
       //     sendEmail($email, "Verfiy Code Ecommerce", "Verfiy Code $verfiycode");
            $_SESSION['emailresetpassword'] = $email;


            header("refresh:1;url=verifycode.php");

        }else{

            echo "البريد الالكتروني الذي اخلته غير صحيح";
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
              <input name="email" type="text" placeholder=" البريد الألكتروني" />
            </div>
            <input name="login" type="submit" value="تسجيل دخول" class="btn solid" />


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
