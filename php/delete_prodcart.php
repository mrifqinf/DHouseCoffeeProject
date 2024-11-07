<!--  -->
<?php
include "connect.php";
// $idOrder = (isset($_POST['idOrder'])) ? htmlentities($_POST['idOrder']) : "";

if (isset($_POST['deletecart_validate'])) {
    $idOrder = $_POST['id_order'];
    $deleteQuery = "DELETE FROM tb_cart WHERE id_order = $idOrder";

    if (mysqli_query($conn, $deleteQuery)) {
        $message = '<script>
                    window.location="../index.php#products"; </script>';
    } else {
        $message = '<script>
                    alert("Delete products failed");
                    window.location="../index.php#products"; </script>';
    }
    echo $message;
}
?>