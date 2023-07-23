<?php
ob_start();
session_start();


include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_SESSION['email']) && $_SESSION['approve'] == 1 ) {
        //if (isset($_SESSION['email']) && isset($_SESSION['verfiycode']) && $_SESSION['approve'] ==1 ) {



        $email = $_SESSION['email']; // register session name
        // $verfiy =  $_SESSION['verfiycode'] ; // register user id in session


        // Get the verification code from the form
        $code = $_POST['code'];

        // Convert code values to numbers



        $concatenatedValue = implode("", $code);



        // Function to check if all fields are filled
        function allFieldsFilled($verfiy)
        {
            return count($verfiy) === 5 && !in_array(0, $verfiy);
        }

        // Check if all fields are filled



            $stmt = $con->prepare("SELECT * FROM users WHERE user_email = '$email' AND user_verifycode = '$concatenatedValue' ");

            $stmt->execute();

            $count = $stmt->rowCount();

            if ($count > 0) {

                $data = array("user_approve" => "2");

                updateData("users", $data, "user_email = '$email' ");
                
                    $_SESSION['approve'] = 2 ; // register user id in session

            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
            // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا

            // If not all fields are filled, redirect back to the verification page.


                printFailure("is Correct");




            } else {
                printFailure("verifycode not Correct");
                // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
                // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
                // hqihv wk],r jkfddddd اضهار صندوق تنبية ضروري هنااااااااااااااااااااا
              
                // If not all fields are filled, redirect back to the verification page.

                header("Location: verifysignup.php");
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