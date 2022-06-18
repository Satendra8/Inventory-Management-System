<?php

    include 'connect.php';
    $myArray = json_decode($_GET['delete_record'], true);

    for($i=0; $i<count($myArray); $i++){
                $value = $myArray[$i];

                $statement = $conn->prepare("DELETE FROM tbl_order WHERE invoice_id = :id");
                $statement->execute(
                    array(
                    ':id'    => $value
                    )
                );
                $statement = $conn->prepare(
                    "DELETE FROM tbl_items WHERE order_id = :id");
                $statement->execute(
                    array(
                        ':id'    => $value
                    )
                );
         

    }
    header("location: index.php");
    exit();
?>
