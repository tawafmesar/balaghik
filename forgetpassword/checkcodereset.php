<?php
ob_start();
session_start();


include "../connect.php";

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

            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا

            // If not all fields are filled, redirect back to the verification page.


            echo "     تم التحقق بنجاح   ";

            header("refresh:3;url=resetpassword.php");







        } else {
         //   printFailure("verifycode not Correct");
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا

            // If not all fields are filled, redirect back to the verification page.

            echo "   الرمز الذي ادخلته غير صحيح   ";



                    header("refresh:3;url=verifycode.php");


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