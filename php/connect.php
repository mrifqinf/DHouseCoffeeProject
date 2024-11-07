<style>
    .alert-danger {
        color: #ffffff;
        font-weight: 400;
        text-align: center;
        background-color: rgba(1, 1, 1, 0.8);
        border-radius: 2rem;
        padding: 0.5rem;
        margin: 1rem;
    }
</style>

<?php
// error_reporting(0);
$conn = mysqli_connect("localhost", "Rifqi", "Rifqimuhammad", "dhouse_db"); //  Database connection from Localhost
// $conn = mysqli_connect("", "", "", ""); // Database connection from Remotehost
if (!$conn) {
    echo "<div class='alert-danger'>Database connection failed</div>";
}
?>