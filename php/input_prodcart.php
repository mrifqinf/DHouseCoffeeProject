<!--  -->
<?php
include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["addtocart_validate"];
    $queryCheck = mysqli_query($conn, "SELECT * FROM tb_cart WHERE product = '$product_id'");

    if (mysqli_num_rows($queryCheck) > 0) {
        $updateQuery = "UPDATE tb_cart SET jumlah = jumlah + 1 WHERE product = '$product_id'";
        if (mysqli_query($conn, $updateQuery)) {
            echo $message = '<script>
            window.location="../index.php#products";
            </script>';
        } else {
            echo $message = '<script>
            alert("Failed to update product")
            window.location="../index.php#products";
            </script>';
        }
    } else {
        $insertQuery = "INSERT INTO tb_cart (product, jumlah) VALUES ('$product_id', 1)";
        if (mysqli_query($conn, $insertQuery)) {
            echo $message = '<script>
            window.location="../index.php#products";
            </script>';
        } else {
            echo $message = '<script>
            alert("Failed to insert product")
            window.location="../index.php#products";
            </script>';
        }
    }
} else {
    $checkCart = mysqli_query($conn, "SELECT * FROM tb_cart");
    if (mysqli_num_rows($checkCart) == 0) {
        echo "Cart is Empty";
    }
}

?>