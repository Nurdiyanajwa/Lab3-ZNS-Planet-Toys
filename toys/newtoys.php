<?php

if (isset($_POST["submit"])){
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $sqlregister = "INSERT INTO product (`name`, `price`, `quantity`, `description`) 
    VALUES( '$name', '$price', '$quantity', '$description')";
  
    try {
    $conn->exec($sqlregister);
    if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file ($_FILES["fileToUpload"]["tmp_name"])) {
    uploadImage($name);
    echo "<script>alert('Registration successful')</script>";
    echo "<script>window.location.replace('mainpage.php')</script>";
    } 
    }catch (PDOException $e) {
    echo "<script>alert('Registration failed')</script>";
    echo "<script>window.location.replace('newtoys.php')</script>";
    }
}
    
  function uploadImage($name)
    {
    $target_dir = "../res/images/";
    $target_file = $target_dir . $name . ".png"; 
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
       
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="script.js"></script>
<title>ZNS Planet Toys</title>
</head>


<body>
 
<div class="w3-header w3-container w3-blue-grey w3-padding-32 w3-center"> 
        <h1 style="font-size:calc(4px + 2vw);">ZNS Planet Toys</h1>
    </div>
    <div class="w3-blue-grey w3-center w3-border-top w3-border-bottom">
        <p style="font-size:calc(8px + 1vw);;">The Best Children Toys Ever.</p>
    </div>

    <div class="w3-bar w3-light-grey">
        <a href="mainpage.php" class="w3-bar-item w3-button w3- left">Home</a>
    </div>

    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
        <div class="w3-container w3-blue-grey">
        <p>New Toys Registration<p>
    </div>

    <form class="w3-container w3-padding" name="registerForm" action="newtoys.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmDialog()">
       <p> 
            <div class="w3-container w3-border w3-center w3-padding">
            <img class="w3-image w3-round w3-margin" src="res/images/photo.png" style="width:100%; max-width:600px"><br>
            <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
        </div></p>
 

        <p>
        <i class = "fa fa-pencil-square-o"></i>
            <label>Name</label>
            <input class="w3-input w3-border w3-round w3-light-grey" name="name" id="idname" type="text" required>
        </p>
        <p>
        <i class = "fa fa-dollar icon"></i>
            <label>Price</label>
            <input class="w3-input w3-border w3-round w3-light-grey" name="price" id="idprice" type="text" required>
        </p>
        <p>
        <i class = "fa fa-plus-square"></i>
            <label>Quantity</label>
            <input class="w3-input w3-border w3-round w3-light-grey" name="quantity" id="idquantity" type="text" required>
        </p>
        <p>
        <i class = "fa fa-info"></i>
            <label>Description</label>
            <textarea class="w3-input w3-border w3-light-grey" name="description" id="iddescription" rows="4" cols="50" width="100" placeholder="Please enter your description" required></textarea>
        </p>
        
        <div class="row">
            <input class="w3-input w3-border w3-block  w3-round w3-blue-grey" type="submit" name="submit" value="Submit">
        </div>    
    </form>
        </div>
    </div>

    <footer class="w3-footer w3-blue-grey w3-center">
    <div class="w3-xlarge w3-section">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>©️ 2021 Copyright all right reserved | Designed by <a class="text-white">Orchid Rental Room</a></p>
</footer>