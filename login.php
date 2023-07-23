
<?php
ob_start();
session_start();


include "connect.php";


if (!isset($_SESSION['user'])) {


  // check if user coming from http post request

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {



      $password = sha1($_POST['password']);
      $email = $_POST['email'];



      $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND  user_password = ? AND user_approve = 1  ");
      $stmt->execute(array($email, $password));
      $count = $stmt->rowCount();

      if ($count > 0) {
        echo "لم يتم تفعيل الحساب ";


        $verfiycode = rand(10000, 99999);

        $data = array("user_verifycode" => $verfiycode);
        updateData("users", $data, "user_email = '$email'");

        // sendEmail($email, "Verfiy Code Ecommerce", "Verfiy Code $verfiycode");

        $_SESSION['email'] = $email; // register user id in session

       // header("refresh:3;url=verifysignup.php");


      }else{
        $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ? AND  user_password = ? AND user_approve = 2  ");
        $stmt->execute(array($email, $password));
        $count2 = $stmt->rowCount();
        $get = $stmt->fetch();


        if ($count2 > 0) {

          echo "   تم تسجيل الدخول بنجاح ";


          $_SESSION['userid'] = $get['user_id']; // register user id in session
          $_SESSION['user'] = $get['user_name']; // register user id in session
          $_SESSION['useremail'] = $get['user_email']; // register user id in session
          
          //        header("refresh:3;url=index.php");


        }else{
          echo "   البريد الاكتروني او كلمة المرور غير صحيحه ";



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

        printFailure("البريد الألكنروني الذي ادخلته موجود مسبقاً ");
// hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
// hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
// hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا

      } else {

        $data = array(
          "user_name" => $username,
          "user_password" => $password,
          "user_email" => $email,
          "user_verifycode" => $verfiycode,
        );

       // sendEmail($email, "قم بتفعيل حسابك عن طريق رمز التحقق التالي :  $verfiycode", "رمز التحقق");

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

?>


    <link rel="stylesheet" href="css/log.css" />

    <div class="containerlog"  dir="ltr">


      <div class="forms-container">

        <div class="signin-signup">
          <form  class="sign-in-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

            <h2  class="title">تسجيل الدخول</h2>

            <div class="input-field">
              <i class="fa-solid fa-circle-user"></i>
              <input name="email" type="text" placeholder=" البريد الألكتروني"required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="password" type="password" placeholder="الرقم السري" required/>
            </div>
           <div class="input-field">
              <i class="fas fa-lock"></i>
              <a href="./forgetpassword/checkemail.php"></a>
            </div>
            <input name="login" type="submit" value="تسجيل دخول" class="btn solid" />



          </form>

          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="sign-up-form signup">
            <h2 class="title">تسجيل جديد</h2>

            <div class="input-field">
              <i class="fa-solid fa-circle-user"></i>
              <input name="username" type="text" placeholder="اسم المستخدم" />
            </div>

            <div class="input-field">
            <i class="fa-solid fa-at"></i>
              <input name="email" type="email" required placeholder="الأيميل" />
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="password" type="password" required placeholder="الرمز السري" />
            </div>

            <input type="submit" name="signup" class="btn" value="تسجيل جديد" />

          </form>
        </div>
      </div>


      <div class="panels-container">
        <div class="panel left-panel" >
          <div class="content" style="margin:auto; margin-top:55px;" >
            <h3> هل انت جديد هنا ؟</h3>
            <p>
ان كنتِ مدربة او متدربة يمكن إنشاء حساب جديد من هنا
            </p>
            <button class="btn transparent" id="sign-up-btn">
              تسجيل جديد
            </button>
          </div>
          <img src="img/log.png"  class="image siz"  alt=""   data-aos="zoom-out-up"/>
        </div>
        <div class="panel right-panel">
          <div class="content marg" >
            <h3>
              مسجل مسبقاً معنا ؟
            </h3>
            <p>
            اذا تم إنشاء حساب مسبقاً يمكنكم تسجيل الدخول من هنا...
            </p>
            <button class="btn transparent" id="sign-in-btn">
              تسجيل دخول
            </button>
          </div>
          <img src="img/reg.png"  class="image" alt="" />
        </div>
      </div>

    </div>





    <?php

  }else {

    header('Location: index.php');

  exit();


  }
      include 'include/footer.php';
      ob_end_flush();
      ?>
