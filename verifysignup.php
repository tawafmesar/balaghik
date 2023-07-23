<?php
ob_start();
session_start();


include "connect.php";



?>

<!DOCTYPE html>
<html>

<head>
    <title>Verification Code</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 2px solid #ccc;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

input {
    width: 40px;
    height: 40px;
    font-size: 24px;
    text-align: center;
    margin: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Style for active/focused input */
input:focus {
    outline: none;
    border-color: #007bff;
}

/* Style for invalid input */
input:invalid {
    border-color: #dc3545;
}

/* Style for valid input */
input:valid {
    border-color: #28a745;
}
    </style>
</head>

<body>
    <div class="container">
        <form id="verifyForm" action="checkcodesignup.php" method="post">
            <input type="text" autofocus name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 1)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 2)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 3)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 4)">
            <input type="text" name="code[]" maxlength="1" pattern="[0-9]" required oninput="moveToNext(this, 0)">
        </form>
    </div>

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




ob_end_flush();
?>