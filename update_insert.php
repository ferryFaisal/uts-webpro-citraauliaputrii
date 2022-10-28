<?php
require "database.php";

$id = $_GET['id'];
$sql1 = "UPDATE products SET name='$name', description='$description', price='$price', photo='$photo', modified = sysdate() WHERE id='$id'";

if (mysqli_query($conn, $sql1)) {
    echo "<br>";
    // echo "New record created successfully";
    header('location: tabel.php');
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

$conn->close();
