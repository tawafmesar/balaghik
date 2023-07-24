<?php
ob_start();
session_start();


include "connect.php";


include "./includes/loginheader.php";
if( isset($_SESSION['email']) ){

  $email =  $_SESSION['email'];


?>

<div class="containerVerify container" id="container">
  <div class="form-container sign-up-container ">
    

         <form id="verifyForm" action="checkcodesignup.php" method="post" style="flex-direction:inherit;">
            <input type="text" autofocus name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 1)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 2)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 3)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 4)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 0)">
        </form>
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                            <img src="./img/logo.png" width="60%" alt="">
                    <h2>ادخل رمز التحقق الذي تم ارسالة الى بريدك الألكتروني</h2>
                    <h1><?php echo   $email ; ?></h1>
                </div>

            </div>
        </div>
    </div>

    <script>container.classList.add("right-panel-active");
</script>

    <!-- partial -->
    <script src="./js/login.js"></script>


<script>
        const verificationFields = document.querySelectorAll('input');

        // Function to move focus to the next input field
        function moveToNext(currentField, nextFieldIndex) {
            const maxLength = parseInt(currentField.getAttribute('maxlength'));

            if (currentField.value.length >= maxLength) {
                const nextField = verificationFields[nextFieldIndex];
                if (nextField) {
                    nextField.focus();
                }
            }
        }

        // Function to check if all fields are filled
        function allFieldsFilled() {
            return Array.from(verificationFields).every(field => field.value !== '');
        }

        // Function to handle form submission
        function handleFormSubmission() {
            if (allFieldsFilled()) {
            const codeValues = Array.from(verificationFields).map(field => parseInt(field.value, 10));
             verifyForm.elements["code[]"].value = codeValues; 
             verifyForm.submit();            }
        }

        // Attach event listeners to each input field to handle the input
        verificationFields.forEach(field => {
            field.addEventListener('input', handleFormSubmission);
        });
    </script>
</body>

</html>


<?php

}else{

    header('Location:login.php');



}


ob_end_flush();
?>