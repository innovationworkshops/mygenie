
<?php

function Createdb(){
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);
$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$dbname = ltrim($dbparts['path'],'/');
    
    

    // create connection
    $con = mysqli_connect($hostname, $username, $password, $dbname);

    // Check Connection
    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

    // create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con, $sql)){
    $con = mysqli_connect($hostname, $username, $password, $dbname);

        $sql = "             
  CREATE TABLE IF NOT EXISTS customers (
  id int,
  accountid varchar(255),
  name varchar(255),
  address varchar(80),
  deviceId varchar(80),
  eventId varchar(80),
  dateTimefield DATETIME,
  eventType varchar(80),
  category varchar(80),
  sessionId varchar(80)
  );                                 
        ";

        if(mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Cannot Create table...!";
        }

    }else{
        echo "Error while creating database ". mysqli_error($con);
    }

}
