<?php
session_start();

if (isset($_SESSION['email'])) {
  echo "You are logged in";
} else {

  if (!isset($_POST['submit'])) {
?>
    <script>
      window.location.replace("login.php");
    </script>
  <?php

  }
  include 'connect.php';


  $username = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM user where email='$username' ";

  $info = $conn->query($query);
  $rows = $info->rowCount();
  $data = $info->fetch();
  $id = $data['id'];
  $user_type = $data['user_type'];
  
  if ($rows == 1 && password_verify($password, $data['password'])) {
    $_SESSION['email'] = $username;
    $_SESSION['id'] = $id;
    $_SESSION['user_type'] = $user_type;
  ?>
    <script>
      alert("Login Sucsessfully");
    </script>
  <?php


  } else {
  ?>

    <script>
      alert("Invalid Userid/password");
    </script>
<?php
    echo "Invalid Username/Password";
    return;
  }
}


?>
<head>
    <?php include("head.php"); ?>

    <!-- datatables -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

    <!-- datatable and delete script -->
    <script>
        $(document).ready(function() {
            $('#Mytable').DataTable({
                responsive: true
            });

            var table = $('#Mytable').DataTable();
            var ids = [];
            $('#Mytable tbody').on('click', 'tr', function() {
                ids.push($(this).attr("data-id"));
                $(this).toggleClass('selected');
            });

            $('#delete').click(function() {
                var conf = confirm("Are You sure to delete");
                if (conf) {
                    alert(ids);
                    table.rows('.selected').remove().draw();

                    var jsonString = JSON.stringify(ids);
                    location.href = "delete.php?delete_record=" + jsonString;

                }
            });
        });
    </script>
    <title>Dashboard</title>

</head>


<?php
include("header.php");

include("sidebar.php");
?>

<!-- main content start -->

<div class="main-container">
    <center>
        <h2>Recent Orders List</h2>
    </center>

    <table id="Mytable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#Id</th>
                <th>Invoice_type</th>
                <th>Order_date</th>
                <th>Customer_name</th>
                <th>Particulars</th>
                <th>Total</th>
                <th>Gst</th>
                <th>Grand_total</th>
                <th>PDF</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "connect.php";

            $query = "SELECT * FROM tbl_order ";

            $info = $conn->query($query);

            $rows = $info->rowCount();

            while ($data = $info->fetch()) {
            ?>
                <tr data-id="<?php echo $data['invoice_id']; ?>">
                    <td><?php echo $data['invoice_id'] . "<br>"; ?></td>
                    <td><?php echo $data['invoice_type'] . "<br>"; ?></td>
                    <td><?php echo $data['order_date'] . "<br>"; ?></td>
                    <td><?php echo $data['customer_name'] . "<br>"; ?></td>
                    <td><?php echo $data['particulars'] . "<br>"; ?></td>
                    <td><?php echo $data['total'] . "<br>"; ?></td>
                    <td><?php echo $data['gst'] . "<br>"; ?></td>
                    <td><?php echo $data['grand_total'] . "<br>"; ?></td>
                    <td><a target = "_blank" href="print_invoice.php?pdf=1&id=<?php echo $data['invoice_id'] ?>">PDF</a></td>
                    <td>
                        <a href="update_invoice.php?id=<?php echo $data['invoice_id']; ?>"><button name="edit" type="submit" class="btn btn-info">Edit</button></a>

                </tr>

            <?php } ?>
        </tbody>
    </table>

    <a href="delete.php?id=<?php echo $data['invoice_id']; ?>"><button id="delete" name="delete" type="submit" class="btn btn-danger">Delete</button></a></td>
</div>
<!-- main content end -->



<?php include("footer.php"); ?>