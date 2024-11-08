<?php
include "php/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_product");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$query_2 = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS totalharga FROM tb_cart
LEFT JOIN tb_product ON tb_product.id = tb_cart.product
GROUP BY id_order");
while ($record_2 = mysqli_fetch_array($query_2)) {
    $result_2[] = $record_2;
}
$select_product = mysqli_query($conn, "SELECT id, nama_product FROM tb_product");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-House Coffee Shop</title>

    <link rel="icon" href="assets/images/icon-dhousecoffe.png" type="png" sizes="16x16">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- NAVBAR START -->
    <div class="navbar">
        <a href="." class="navbar-logo">D-House<span>Coffee</span>.</a>
        <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#menu">Menu</a>
            <a href="#products">Products</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="navbar-extra">
            <a href="javascript:void(0);" id="search-button"><i data-feather="search"></i></a>
            <a href="javascript:void(0);" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
            <a href="javascript:void(0);" id="hmenu"><i data-feather="menu"></i></a>
        </div>

        <!-- SEARCH FORM -->
        <div class="search-form">
            <input type="search" id="search-box" placeholder="Search Here">
            <label for="search-box"><i data-feather="search"></i></label>
        </div>
        <!-- SEARCH FORM -->

        <!-- SHOPPING CART -->
        <div class="shopping-cart">
            <form action="php/delete_prodcart.php" method="POST">
                <?php
                if (empty($result_2)) {
                    echo "Cart is Empty"; // Just give it a style
                } else {
                    foreach ($result_2 as $row_2) {
                        $totalharga = "Rp " . number_format($row_2['totalharga'], 2, ",", ".");
                        $id_order = $row_2['id_order'];
                ?>
                        <div class="cart-items">
                            <input type="hidden" name="id_order" id="id_order" value="<?php echo $id_order; ?>">
                            <img src="assets/images/<?php echo $row_2['photo']; ?>" alt="Product">
                            <div class="item-detail">
                                <h3><?php echo $row_2['nama_product']; ?></h3>
                                <div class="item-price"> <?php echo $totalharga; ?> </div>
                                <div class="item-price"> Qty : <?php echo $row_2['jumlah']; ?>x </div>
                            </div>
                            <button name="deletecart_validate"><i data-feather="trash-2" class="remove-items"></i></button>
                        </div>
                <?php
                    }
                    // Create a Checkout button here
                }
                ?>
            </form>
        </div>
        <!-- SHOPPING CART -->
    </div>
    <!-- NAVBAR END -->

    <!-- HOME SECTION START -->
    <section class="home" id="home">
        <main class="content">
            <h1>Secangkir <span>Coffee</span> Untuk Dinikmati</h1>
            <p>Place Your Daily Coffee Retreat Here, Where Flavor Meets For Your Comfort</p>
            <!-- <a href="#products" class="cta">Buy Now</a> -->
        </main>
    </section>
    <!-- HOME SECTION END -->

    <!-- ABOUT SECTION -->
    <section id="about" class="about">
        <h2><span>About</span> Us</h2>

        <div class="row">
            <div class="about-img">
                <img src="assets/images/about-project-dhouse.jpg" alt="About Me">
            </div>

            <div class="content">
                <h3>Why should you choose our Coffee?</h3>
                <p>Our coffee is handled with dedication, from bean selection to brewing, to provide a unique quality
                    that's hard to find
                    elsewhere.</p>
                <p>We are coffee art enthusiasts, and it shows in every cup we serve. Experience quality without
                    breaking the bank. Our coffee provides the best value for your money.</p>
            </div>
        </div>
    </section>
    <!-- ABOUT SECTION -->

    <!-- MENU SECTION -->
    <section id="menu" class="menu">
        <h2><span>Signature</span> Menu</h2>
        <p>Started with Our love to Coffee, and these are 4 Signatures from all our menus.</p>

        <div class="row">
            <div class="menu-card">
                <img src="assets/images/cappucino.jpg" alt="espreso-porject" class="menu-card-image">
                <h3 class="menu-card-title">>> Cappucino << </h3>
            </div>
            <div class="menu-card">
                <img src="assets/images/milk.jpg" alt="espreso-porject" class="menu-card-image">
                <h3 class="menu-card-title">>> Caramel << </h3>
            </div>
            <div class="menu-card">
                <img src="assets/images/avocado.jpg" alt="espreso-porject" class="menu-card-image">
                <h3 class="menu-card-title">>> Palm Milk << </h3>
            </div>
            <div class="menu-card">
                <img src="assets/images/latte.jpg" alt="espreso-porject" class="menu-card-image">
                <h3 class="menu-card-title">>> Latte << </h3>
            </div>
        </div>
    </section>
    <!-- MENU SECTION -->

    <!-- PRODUCT SECTION -->
    <section class="products" id="products">
        <h2>Our <Span>Products</Span></h2>
        <form action="php/input_prodcart.php" method="POST">
            <div class="row">
                <?php
                foreach ($result as $row) {
                    $harga = "Rp " . number_format($row['harga'], 2, ",", ".");
                    $id = $row['id']; ?>
                    <div class="product-card">
                        <div class="product-icon">
                            <button name="addtocart_validate" value="<?php echo $id; ?>" class="button-add-to-cart"><i data-feather="shopping-cart"></i></button>
                            <a href="javascript:void(0);" class="detail-modal" data-modal-id="<?php echo $id; ?>"><i data-feather="eye"></i></a>
                        </div>
                        <div class="product-image">
                            <img src="assets/images/<?php echo $row['photo']; ?>" alt="...">
                        </div>
                        <div class="product-content">
                            <h3><?php echo $row['nama_product']; ?></h3>
                            <div class="product-price">
                                <div class="product-price"><?php echo $harga ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </form>
        <a class="addproduct-modal" href="javascript:void(0);">
            <div class="add-product">
                <i data-feather="plus-circle"></i>
                <h3>Add</h3>
            </div>
        </a>
    </section>
    <!-- PRODUCT SECTION -->

    <!-- CONTACT SECTION -->
    <section id="contact" class="contact">
        <h2>Contact <span>Us</span></h2>
        <p>If you'd like to provide feedback or suggestions, or if you're interested in organizing an event, please
            don't hesitate
            to contact us</p>
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4477795940597!2d106.99620457509533!3d-6.204512593783288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698bfbaf79cf65%3A0x5e3a70021f53e39c!2sJl.%20Swadaya%20VI%2C%20Harapan%20Jaya%2C%20Kec.%20Bekasi%20Utara%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017124!5e0!3m2!1sid!2sid!4v1698022163225!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
            <form action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="Name">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="text" placeholder="Email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="Phone Number">
                </div>
                <button type="submit" class="btn" disabled>Send</button>
            </form>
        </div>
    </section>
    <!-- CONTACT SECTION -->

    <!-- FOOTER -->
    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/mrif_qi/"><i data-feather="instagram"></i></a>
            <a href="https://github.com/mrifqinf?tab=repositories"><i data-feather="github"></i></a>
            <a href="https://www.youtube.com/@muhammadrifqinf9191"><i data-feather="youtube"></i></a>
        </div>

        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#menu">Menu</a>
            <a href="#products">Products</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="credit">
            <p>Created by <a href="https://www.instagram.com/mrif_qi/">Muhammad Rifqi Nurfadillah</a> || &copy; 2023</p>
        </div>
    </footer>
    <!-- FOOTER -->

    <!-- MODAL DETAIL -->
    <form action="php/input_prodcart.php" method="POST">
        <?php
        foreach ($result as $row) {
            $harga = "Rp " . number_format($row['harga'], 2, ",", ".");
            $id = $row['id']; ?>
            <div class="modal" id="detail-modal<?php echo $id; ?>">
                <div class="modal-container">
                    <a href="javascript:void(0);" class="close-button" data-modal-id="<?php echo $id; ?>"><i data-feather="x"></i></a>
                    <div class="modal-content">
                        <img src="assets/images/<?php echo $row['photo']; ?>" alt="...">
                        <div class="product-content">
                            <h3><?php echo $row['nama_product']; ?></h3>
                            <p><?php echo $row['deskripsi']; ?></p>
                            <div class="product-price"><?php echo $harga ?></div>
                            <button name="addtocart_validate" value="<?php echo $id; ?>" class=" buttonAddToCart"><i data-feather="shopping-cart"></i><span>Add to Cart</span></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </form>
    <!-- MODAL DETAIL -->

    <!-- MODAL ADD PRODUCT PIN -->
    <div class="modal-2" id="addproduct-modal">
        <div class="modal-container-2">
            <a class="close-button-2" href="javascript:void(0);"><i data-feather="x"></i></a>
            <div class="modal-content-2">
                <h2>PIN</h2>
                <form action="#">
                    <label for="pin">Input your PIN first:</label>
                    <input type="number" id="pin" placeholder="Input your PIN" required>
                    <button id="buttonSubmitAdd">Next</button>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL ADD PRODUCT PIN-->

    <!-- MODAL ADD PRODUCT -->
    <div class="modal-3" id="addproduct-modal-2">
        <div class="modal-container-3">
            <a class="close-button-3" href="javascript:void(0);"><i data-feather="x"></i></a>
            <div class="modal-content-3">
                <!-- <img src="assets/images/product-items.jpg" alt="Espresso Beans"> -->
                <div class="product-content-3">
                    <h3>Add New Products</h3>
                    <form action="php/input_product.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-group">
                                <label for="productName">Name</label>
                                <input type="text" name="productName" id="productName" placeholder="Product Name" required>
                            </div>
                            <div class="input-group">
                                <label for="productPrice">Price</label>
                                <input type="number" name="productPrice" id="productPrice" placeholder="Product Price" required>
                            </div>
                            <div class="input-group">
                                <label for="productDesc">Description</label>
                                <textarea name="productDesc" id="productDesc" cols="30" rows="3" placeholder="Product Description" required></textarea>
                            </div>
                            <div class="input-group">
                                <label for="photo">Product Picture</label>
                                <input type="file" name="photo" id="photo" required>
                            </div>
                        </div>
                        <button type="submit" class="buttonSubmitAdd" name="input_product_validate" value="submit"><i data-feather="plus"></i>Add products</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL ADD PRODUCT -->

    <!-- JAVA SCRIPT -->
    <!-- ICONS COMPONENTS -->
    <script>
        feather.replace();
    </script>

    <!-- SOURCE JS -->
    <script src="js/script.js"></script>
</body>

</html>