<?php 
session_start();


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

$stmt = $conn->query("SELECT * FROM booklists");
$categories = $stmt->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("../inc/head.php");
?>
<?php
include_once("../inc/header.php");
?>
<div class="container-fluid">
<div class="row flex-nowrap">
<?php include_once("../inc/sidebar.php");?>
<div class="col py-3">
    <h2 class="mt-2">Category List || </h2>
    <?php
    if(isset($_SESSION["ins_success"])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> <?php echo $_SESSION["ins_success"]; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <?php
    session_unset();
      }
    ?>

    <a href="addproduct.php" class="btn btn-success mt-2">Add Product</a>
    <div class="card my-4">
        <div class="card-body">
        
            <table class="table">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>Discription</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                    foreach($categories as $category){
                        ?>
                    <tr>
                        <td>
                            <?php $i++; ?>
                    
                    </td>
                        <td><?=$category['bookname'];?></td>
                        <td><?=$category['authorname'];?></td>
                        <td><?=$category['discription'];?></td>
                        <td><?=$category['price'];?></td>
                        <td>
                           <a href="categorydetails.php?id=<?php echo $category['id'];?>" class="text-decoration-none">Show</a> ||
                           <a href="update.php" class="text-decoration-none">Update</a> ||
                           <a href="delete.php" class="text-decoration-none">Delete</a>
                        </td>  
                    </tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<?php
include_once("../inc/footer.php");
?>
    
</body>
</html>