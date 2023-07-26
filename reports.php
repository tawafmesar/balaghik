<?php
ob_start();
session_start();


include "connect.php";


if (isset($_SESSION['user'])) {

  include "./includes/mainheader.php";

  $userid = $_SESSION['userid'];


  $do = isset($_GET['do']) ? $_GET['do'] : 'manage';


  if ($do == 'manage') {

    $stmt = $con->prepare("SELECT * FROM reports WHERE report_user = ?   ");
    $stmt->execute(array($userid));
    $count2 = $stmt->rowCount();
    $rows = $stmt->fetchall();


    if (!empty($rows)) {




      ?>



      <div class="content w-full">

        <!-- Start add -->
        <br><br><br><br>
        <div class="add" style="height: auto;">

          <!-- Start Projects Table -->
          <div class="projects p-20 bg-white rad-10 m-20">
            <h2 class="mt-0 mb-20">البلاغات</h2>
            <div class="responsive-table">
              <table class="fs-15 w-full">
                <thead>
                  <tr>
                    <td>رقم الطلب</td>
                    <td>المشكلة</td>
                    <td>ملاحظة</td>
                    <td>التحكم</td>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>10 May 2022</td>
                    <td>Ministry</td>
                    <td>$5300</td>
                    <td>
                      <span class="label btn-shape bg-orange c-white">Pending</span>
                    </td>

                  </tr>

                  <?php

                  foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['report_number'] . "</td>";
                    echo "<td>" . $row['report_main'] . "</td>";
                    echo "<td>" . $row['report_details'] . "</td>";

                    echo "<td>
              <a href='?do=Edit&report_id=" . $row['report_id'] . "' class=' btn btn-success'>تعديل  &nbsp; <i class='fa fa-edit green' ></i></a>   &nbsp; &nbsp; 
             | &nbsp; &nbsp;   <a href='?do=Delete&report_id=" . $row['report_id'] . "' class='btn btn-danger confirm'>  حذف  &nbsp;<i class='fa fa-trash red' ></i></a>";



                    echo "</td>";
                    echo "</tr>";
                  }

                  ?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- End Projects Table -->
        </div>

        <?php

    } else {
      echo "<div class='add container' style='width: 80%;'>";


      echo "  <h1 class='succes'>
      لايوجد بيانات ليتم عرضها
            </h1>";


      echo "</div>";

    }

    ?>


  <?php // end manage members page
    // start members page
  } elseif ($do == 'Edit') { //start edite page



    $reportid = (isset($_GET['report_id']) && is_numeric($_GET['report_id'])) ? intval($_GET['report_id']) : 0;


    $stmt = $con->prepare("SELECT * FROM reports WHERE report_id  = ?  AND report_user = ? LIMIT 1 ");


    $stmt->execute(array($reportid, $userid));


    $row = $stmt->fetch();

    // the row coun

    $count = $stmt->rowCount();


    if ($count > 0) {

      ?>
      <div class="content w-full">

        <!-- Start add -->
        <div class="add">

          <div class="container" id="container">

            <div class="form-container sign-up-container">
              <form action="?do=Update" method="post">
                <input type="hidden" name="reportid" value="<?php echo $reportid; ?>">

                <input class="rtl" type="number" name="number" placeholder="رقم الطلب"
                  value="<?php echo $row['report_number']; ?>" required />
                <input class="rtl" type="text" name="main" placeholder="المشكلة" value="<?php echo $row['report_main']; ?>"
                  required />
                <textarea name="details" id="details" cols="30" rows="10"
                  placeholder="ملاحظة"><?php echo $row['report_details']; ?></textarea>
                <button name="add">حفظ</button>
              </form>
            </div>


            <div class="overlay-container">
              <div class="overlay">
                <div class="overlay-panel overlay-left">
                  <img src="./img/logo.png" width="60%" alt="">
                  <h1> تعديل بلاغ</h1>

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

      $theMsg = '<div class="alert alert-danger">Theres no such ID</div>';

      //redirectHome($theMsg, 4);

      echo "</div>";

    }
  }
  // end edit page
  elseif ($do == 'Update') { // start update page
    echo "<div class='add container' style='width: 80%;'>";

    // check if user come from forms or any page

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {



      $formErrors = array();

      $reportid = $_POST['reportid'];
      $userid = $_SESSION['userid'];
      $number = $_POST['number'];
      $main = $_POST['main'];
      $details = $_POST['details'];






      $stmt = $con->prepare("UPDATE reports SET report_number = ? , report_main = ? , report_details = ?  WHERE report_id = ?  ");
      $stmt->execute(array($number, $main, $details, $reportid));
      $count2 = $stmt->rowCount();



      if ($count2 > 0) {


        echo "  <h1 class='succes'>
            تم التعديل بنجاح
            </h1>";

        header("refresh:1.5;url=reports.php");

      }



    } else {

      echo '<div class="alert alert-danger">لايمكن فتح هذه الصفحة</div>';


    }

    echo "</div>";

  } // end update page
  elseif ($do == 'Delete') { //  start delelt member page

    echo "<div class='add container' style='width: 80%;'>";


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

      header("refresh:1.5;url=reports.php");


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

      const activee = document.getElementById('reports');
      activee.classList.add("active");


    </script>

  <?php

} else {
  include "./includes/loginheader.php";

  echo "  <h1 class='error'>
    للدخول يجب عليك تتسجيل الدخول
            </h1>";

  header("refresh:1.8;url=login.php");



  exit();


}

ob_end_flush();

?>