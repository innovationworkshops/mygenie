<?php
require_once ("db-customers.php");
require_once ("component.php");

$con = Createdb();
// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fins Cabin</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<main>
    <div class="container text-center">
               <!--Navigation -->
     <div style="margin: 30px; margin-top: 50px;">  <center> 
      <h1 >   Bank Portal </h1> 
      <h3> Genie in Financial Services <h3> 
      <img src="wide-characters.jpg"> 
      </div>  </center>
     <center> <div style="margin: 30px; margin-top: 20px;"> 
    <a class="more" href="index.php">Home </a> &nbsp;&nbsp;&nbsp; <a class="more" href="leads.php">Leads </a> &nbsp;&nbsp;&nbsp;<a class="more" href="customers.php">Customers</a> 
    <hr style="width:70%;">
         <h3> Customer Information <h3> 
     </div></center>
          <!--Navigation -->
        
        
<?php
$sql = "SELECT accountid, name, address FROM customers";
$result = $con->query($sql);
?>
        
 <!-- Results  -->
       <center> <div style="margin-bottom:30px; padding-bottom:30px;">
       <?php
       echo '<table border="1" cellspacing="2" cellpadding="2"> 
      <tr border="0"> 
          <td> <font face="Arial">Account ID</font> </td> 
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">Address</font> </td> 
      </tr>';

if ($result = $con->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["accountid"];
        $field2name = $row["name"];
        $field3name = $row["address"];


        echo '<tr border="1"> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
              </tr>';
    }
    $result->free();
    $con->close();
} 
  ?>
         </div> </center>
 <!-- Results  -->  
 <!--     Delete -->      
<?php
$dbc = Createdb();
if(isset($_POST['submit_button']))
{
    mysqli_query($dbc, 'TRUNCATE TABLE `customers`');
     header("Location: " . $_SERVER['PHP_SELF']);
     exit();   
}

?>
<div style="margin-bottom:10px;">
<form method="post" action="">
    <input style="background-color: red; color:white; text-decoration: none;" name="submit_button" type="submit" value=" Truncate Table " />
</form>
    
       </div>
       
<!--     Delete -->


    </div>
</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="main.js"></script>
</body>
</html>
