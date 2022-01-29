<?php
include_once("dbconnect.php");
$sqlroom = "SELECT * FROM product ORDER BY productdate DESC";
$stmt = $conn->prepare($sqlroom);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$results_per_page = 5;
if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlroom);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlroom = $sqlroom . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlroom);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


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
    <div class="w3-header w3-container w3-blue-grey w3-padding-30 w3-center ">
     <span class= "w3-text-white w3-jumbo" style= "font-size:calc(2px + 1vw)">ZNS Planet Toys</span>
    </div>

<!-- Header image -->
<div style="height:500px;background-image:url('res/images/toys.jpg');background-size:cover" class="w3-display-container">
<div class="w3-display-bottomleft">
</div>
<div class="w3-display-middle w3-center">
<span class="w3-text-white" style="font-size:50px"><br>The Best Children Toys.</span>
</div>
</div>

    <div class="w3-bar w3-light-grey">
        <a href="newtoys.php" class="w3-bar-item w3-button w3-left">New Toys</a>
    </div>

     <div class="w3-grid-template">

<?php
foreach($rows as $toys){
    $name = $toys['name'];
    $price = $toys['price'];
    $quantity = $toys['quantity'];
    $description = $toys ['description'];
    echo "<div class='w3-center w3-padding'>";
    echo "<div class='w3-card-4 w3-blue-grey'>";
    echo "<header class='w3-container w3-blue-grey'>";
    echo "<h5>$name</h5>";
    echo "</header>";
    echo "<img class='w3-image' src=res/images/car.jpg" . " onerror=this.onerror=null;this.src='res/images/photo.png'" . "style='width:100%;height:250px'>" ;
    echo "<div class='w3-container w3-left-align'><hr>";
    echo  "<i class='fa fa-pencil-square-o' style='font-size 16px;'> Name:</i> &nbsp&nbsp$name<br>
    <i class='fa fa-dollar' style='font-size 16px;'> Price:</i> &nbsp&nbsp$price<br>
    <i class='fa fa-plus-square' style='font-size 16px;'> Quantity:</i> &nbsp&nbsp$quantity<br>
    <i class='fas fa-info' style='font-size 15px;'> Description :</i> &nbsp&nbsp$description<br></p><hr>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

}
?>
</div>

<br>
<br>

<?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "mainpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
<br>
<br>

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