<?php
require "database.php";

$sql = "INSERT INTO products ( name, description, price, photo, created, modified)
        VALUES ( '$name', '$description','$price', '$photo', SYSDATE() , SYSDATE())";

if ($conn->query($sql) === TRUE) {
    echo "<br>";
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('location: tabel.php');