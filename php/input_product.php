<!--  -->
<?php
include "connect.php";
$namaProduct = (isset($_POST['productName'])) ? htmlentities($_POST['productName']) : "";
$hargaProduct = (isset($_POST['productPrice'])) ? htmlentities($_POST['productPrice']) : "";
$descProduct = (isset($_POST['productDesc'])) ? htmlentities($_POST['productDesc']) : "";
$randomCode = rand(10, 9999999) . "-";
$targetDir = "../assets/images/" . $randomCode;
$targetFile = $targetDir . basename($_FILES['photo']['name']);
$imagesType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

if (!empty($_POST['input_product_validate'])) {
    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check == false) {
        $message = "Insert image files";
        $statusupload = 0;
    } else {
        $statusupload = 1;
        if (file_exists($targetFile)) {
            $message = "Files are available";
            $statusupload = 0;
        } else {
            if ($_FILES['photo']['size'] > 5000000) {
                $message = "File too big";
                $statusupload = 0;
            } else {
                if ($imagesType != "jpg" && $imagesType != "jpeg" && $imagesType != "png") {
                    $message = "Only format .jpg .jpeg .png are Allowed";
                    $statusupload = 0;
                }
            }
        }
    }
    if ($statusupload == 0) {
        $message = '<script>
                    alert("' . $message . ', Image cannot be uploaded")
                    window.location="../index.php#products";
                    </script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_product WHERE nama_product = '$namaProduct'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>
                        alert("The menu name already exists")
                        window.location="../index.php#products";
                        </script>';
        } else {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                $query = mysqli_query($conn, "INSERT INTO tb_product (photo, nama_product, harga, deskripsi) values ('" . $randomCode . $_FILES['photo']['name'] . "','$namaProduct', '$hargaProduct', '$descProduct')");
                if ($query) {
                    $message = '<script>window.location="../index.php#products";
                                </script>';
                } else {
                    $message = '<script> alert("Data failed to enter")
                                window.location="../index.php#products";
                                </script>';
                }
            } else {
                $message = '<script> alert("An error occurred, File could not be uploaded")
                            window.location="../index.php#products";
                            </script>';
            }
        }
    }
}
echo $message;
?>