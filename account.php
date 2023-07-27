<?php
ob_start();
session_start();


include "connect.php";


if (isset($_SESSION['user'])) {

    include "./includes/mainheader.php";

    $userid = $_SESSION['userid'];

    // $_SESSION['userid'] = $get['user_id']; // register user id in session
    // $_SESSION['user'] = $get['user_name']; // register user id in session
    // $_SESSION['useremail'] = $get['user_email']; // register user id in session

    $do = isset($_GET['do']) ? $_GET['do'] : 'Edit';

    if ($do == 'Edit') { //start edite page





        $stmt = $con->prepare("SELECT * FROM users WHERE user_id  = ?   LIMIT 1 ");


        $stmt->execute(array($userid));


        $row = $stmt->fetch();


        $count = $stmt->rowCount();


        if ($count > 0) {

            ?>
            <div class="content w-full">

                <!-- Start add -->
                <div class="add">

                    <div class="container" id="container">

                        <div class="form-container sign-up-container">
                            <form action="?do=Update" method="post">
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                
                                <div class="labell">   <label>البريد الألكتروني</label> (لايمكن تعديله)</div>
                                <input disabled class="rtl" type="text" name="user_email" placeholder="البريد الألكتروني"
                                    value="<?php echo $row['user_email']; ?>" required />
                                 
                                    <div class="labell">   <label> اسمك الكامل</label></div>
                                 <input class="rtl" type="text" name="user_name" placeholder="اسمك الكامل"
                                    value="<?php echo $row['user_name']; ?>" required />
                               
                                    <div class="labell" >   <label> رقم الجوال </label></div>
                                 <input class="rtl" type="text" name="user_phone" placeholder="رقم الجوال"
                                    value="<?php echo $row['user_phone']; ?>"  />

                                    <div class="labell" >   <label>  المدينة</label> </div>
                                 <input class="rtl" type="text" name="user_city" placeholder="المدينة"
                                    value="<?php echo $row['user_city']; ?>"
                                         />

                                    <button name="add">حفظ</button>
                            </form>
                        </div>

                        <div class="overlay-container">
                            <div class="overlay">
                                <div class="overlay-panel overlay-left">
                                    <img src="./img/logo.png" width="60%" alt="">
                                    <h1> بيانات حسابي</h1>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                container.classList.add("right-panel-active");


            </script>


            <?php

        } else {


            echo "<div class='container'>";

            $theMsg = '<div class="alert alert-danger">لايمكنك الدخول الى هذه الصفحة</div>';

            //redirectHome($theMsg, 4);
            echo $theMsg ;

            echo "</div>";

        }
    }
    // end edit page
    elseif ($do == 'Update') { // start update page
        echo "<div class='add container' style='width: 100%;'>";

        // check if user come from forms or any page

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {



            $formErrors = array();

            $userid = $_POST['userid'];

            $name = $_POST['user_name'];
            $phone = $_POST['user_phone'];
            $city = $_POST['user_city'];



            $stmt = $con->prepare("UPDATE users SET user_name = ? , user_phone = ? , user_city = ?  WHERE user_id = ?  ");
            $stmt->execute(array($name, $phone, $city, $userid));
            $count2 = $stmt->rowCount();



            if ($count2 > 0) {


            echo "  <h1 class='succes' id='hide'>
            تم التعديل بنجاح
            </h1>";


                header("refresh:1.5;url=account.php");

            }



        } else {

            echo '<div class="alert alert-danger">لايمكن فتح هذه الصفحة</div>';


        }

        echo "</div>";

    } // end update page
    elseif ($do == 'Delete') { //  start delelt member page

        echo "<div class='add container' style='width: 100%;'>";


        $reportid = (isset($_GET['report_id']) && is_numeric($_GET['report_id'])) ? intval($_GET['report_id']) : 0;


        $stmt = $con->prepare("select * from reports   WHERE report_id = ?  ");
        $stmt->execute(array($reportid));
        $check = $stmt->rowCount();


        if ($check > 0) {


            $stmt = $con->prepare("DELETE FROM reports WHERE report_id = :zreport_id");

            $stmt->bindParam(":zreport_id", $reportid);

            $stmt->execute();


            echo "  <h1 class='succes'>
            تم الحذف بنجاح
            </h1>";

            header("refresh:2;url=reports.php");


        } else {


            echo "  <h1 class='succes'>
            البلاغ المحدد غير موجود
            </h1>";

            header("refresh:1.5;url=reports.php");




        }


        echo '</div>';

    }
    ?>


        </body>

        </html>

        <script>

            const activee = document.getElementById('account');
            activee.classList.add("active");

            document.addEventListener("DOMContentLoaded", function () {
                const h4Element = document.getElementById("hide");
                setTimeout(function () {
                    h4Element.style.display = "none";
                }, 2500); // 2000 milliseconds (2 seconds)
            });

        </script>

    <?php

} else {
    include "./includes/loginheader.php";

    echo "  <h1 class='error'>
    للدخول الى هذه الصفحة يجب عليك تسجيل الدخول
            </h1>";

    header("refresh:1.8;url=login.php");



    exit();


}

ob_end_flush();

?>