<?php
session_start();
// database connection

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=books", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



// insert data

if(isset($_SERVER['REQUEST_METHOD']) == "POST"){
$bookname = $_POST['bookname'];
$authorname = $_POST['authorname'];
$discription = $_POST['discription'];
$price = $_POST['price'];


    $data = [
        'bookname' =>$bookname,
        'authorname' => $authorname,
        'discription' => $discription,
        'price' => $price,
    ];
    $sql = "INSERT INTO booklists (bookname, authorname, discription, price) VALUES (:bookname, :authorname, :discription, :price)";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);
    
    $_SESSION["ins_success"] = "Insert Successfully";

    header('Location: categorylist.php');
    
    



    
}




?>