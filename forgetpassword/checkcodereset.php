<?php
ob_start();
session_start();


include "../connect.php";
include "../includes/forgetheader.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_SESSION['emailresetpassword']) ) {

        $email = $_SESSION['emailresetpassword']; // register session name

        $code = $_POST['code'];


        $concatenatedValue = implode("", $code);



        $stmt = $con->prepare("SELECT * FROM users WHERE user_email = '$email' AND user_verifycode = '$concatenatedValue' ");

        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0) {

            $data = array("user_approve" => "2");

            updateData("users", $data, "user_email = '$email' ");

            $_SESSION['approve'] = 2; // register user id in session


            header('Location: resetpassword.php');
            exit();



        } else {

            echo "  <h1 class='error'>
                        رمز التأكيد الذي ادخلته غير صحيح

                        </h1>";

            header("refresh:1.8;url=verifycode.php");


            exit;

        }





    } else {

        header('Location: login.php');

        exit();


    }






} else {

    header('Location: index.php');

    exit();


}
ob_end_flush();

?>