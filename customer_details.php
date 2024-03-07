<?php
$insert = false;
if(isset($_POST['Name'])){
    
    $server = "localhost";
    $username = "root";
    $password = "";

    
    $con = mysqli_connect($server, $username, $password);

    
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
   
    

   
    $Name = $_POST['Name'];
    $Car_No = $_POST['Car_No'];
    
    $Email = $_POST['Email'];
    $Phone_No = $_POST['Phone_No'];
    
    $sql = "INSERT INTO `parking system`.`customer_details` (`Name`,`Car_No`, `Email`, `Phone_No`) VALUES ('$Name','$Car_No', '$Email', '$Phone_No');";
    
    
    if($con->query($sql) == true){
        
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="customer_details.css">
    
</head>
<body>
    
    <div class="contain">
    <div class="container">
        <p>CUSTOMER DETAILS</p>
        <form action="customer_details.php" method="POST">
            <input type="text" name="Name" id="Name" placeholder="Enter your name">
            <input type="text" name="Car_No" id="Car_No" placeholder="Enter your car number">
            <input type="text" name="Email" id="Email" placeholder="Enter your email">
            <input type="text" name="Phone_No" id="Phone_No" placeholder="Enter your phone number">
            <button type="submit" class="btn" name="submit">Submit</button>
    
        </form>
    </div>
    </div>
    
    
</body>
</html>


