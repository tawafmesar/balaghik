
<?php
ob_start();
session_start();


include "connect.php";


if (!isset($_SESSION['user'])) {



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {



      $password = sha1($_POST['password']);
      $email = $_POST['email'];



      $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND  user_password = ? AND user_approve = 1  ");
      $stmt->execute(array($email, $password));
      $count = $stmt->rowCount();

      if ($count > 0) {
        echo "  <h1 class='error'>
    لم يتم تفعيل الحساب
            </h1>";


        $verfiycode = rand(10000, 99999);

        $data = array("user_verifycode" => $verfiycode);
        updateData("users", $data, "user_email = '$email'");

        sendEmail($email, "قم بتفعيل حسابك عن طريق رمز التحقق التالي :  $verfiycode", "رمز التحقق");

        $_SESSION['email'] = $email; // register user id in session

       header("refresh:1.8;url=verifysignup.php");


      }else{
        $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND  user_password = ? AND user_approve = 2  ");
        $stmt->execute(array($email, $password));
        $count2 = $stmt->rowCount();
        $get = $stmt->fetch();


        if ($count2 > 0) {

          echo "  <h1 class='succes'>
            تم تسجيل الدخول بنجاح 
            </h1>";


          $_SESSION['userid'] = $get['user_id']; // register user id in session
          $_SESSION['user'] = $get['user_name']; // register user id in session
          $_SESSION['useremail'] = $get['user_email']; // register user id in session
          header("refresh:1.5;url=index.php");



        }else{


          echo "  <h1 class='error'>
            البريد الاكتروني او كلمة المرور غير صحيحه 
            </h1>";
                  header("refresh:1.5;url=login.php");


        }


      }




      }

      if (isset($_POST['signup'])) {




        // check the signup if valid or not befor sending info to database

    $formErrors = array();


      // signup signup signup signup 



      $username = $_POST['username'];
      $password = sha1($_POST['password']);
      $email = $_POST['email'];

      $verfiycode = rand(10000, 99999);

      $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? ");
      $stmt->execute(array($email));
      $count = $stmt->rowCount();


      if ($count > 0) {

        echo "  <h1 class='error'>
        البريد الألكنروني الذي ادخلته موجود مسبقاً 
            </h1>";
        header("refresh:1.5;url=login.php");



      } else {

        $data = array(
          "user_name" => $username,
          "user_password" => $password,
          "user_email" => $email,
          "user_verifycode" => $verfiycode,
        );

        sendEmail($email, "قم بتفعيل حسابك عن طريق رمز التحقق التالي :  $verfiycode", "رمز التحقق");

        $countt = insertData("users", $data);

        if ($countt > 0 ){

          $_SESSION['email'] = $email; // register session name
          $_SESSION['approve'] = 1; // register user id in session

          header('Location:verifysignup.php');

        }
      }
      // signup signup signup signup 

  }

}


  include "./includes/loginheader.php";


  ?>

<!-- partial:index.partial.html -->
<div class="container" id="container">
  <div class="form-container sign-up-container">
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
			<h1>إنشاء حساب</h1>

			<!-- <span>or use your email for registration</span> -->
			<input class="rtl" type="text" name="username" placeholder="الأسم" required autocomplete="off"/>
			<input class="rtl" type="email" name="email" autocomplete="off" placeholder="البريد الألكتروني" required/>
			<input  class="rtl" type="password" name="password" placeholder="كلمة المرور" required/>
			<button name="signup">إنشاء</button>
		</form>
	</div>


	<div class="form-container sign-in-container">
		<form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
			<h1> تسجيل الدخول</h1>

			<!-- <span>or use your account</span> -->
			<input class="rtl" type="email" name="email" autocomplete="off" placeholder="البريد الألكتروني" required/>
			<input class="rtl" type="password" name="password" placeholder="كلمة المرور" required/>
			<a href="./forgetpassword/checkemail.php">هل نسيت كلمة المرور ؟</a>
			<button name="login" > تسجيل دخول</button>
		</form>
	</div>

	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
        <img src="./img/logo.png" width="60%" alt="">
        				<h3>لديك حساب يمكنك تسجيل الدخول</h3>

				<button class="ghost" id="signIn">تسجيل دخول</button>
			</div>
			
			<div class="overlay-panel overlay-right">

        <img src="./img/logo.png" width="60%" alt="">
        				<h3>ليس لديك حساب يمكنك إنشاء حساب جديد</h3>

				<button  class="ghost" id="signUp">إنشاء حساب</button>
			</div>
		</div>
	</div>
</div>


<!-- partial -->
  <script  src="./js/login.js"></script>

</body>


    <?php

  }else {

    header('Location: index.php');

  exit();


  }

      ob_end_flush();
      ?>
