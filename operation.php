<?php

require_once ("db.php");
require_once ("component.php");

$con = Createdb();

// create button click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}

function createData(){
    $email = textboxValue("email");
    $last_name = textboxValue("last_name");
    $first_name = textboxValue("first_name");
    
     $deviceId = textboxValue("deviceId");
     $eventId = textboxValue("eventId");
     $dateTimefield = textboxValue("dateTimefield");
     $eventType = textboxValue("eventType");
     $category = textboxValue("category"); 
    $sessionId = textboxValue("sessionId");
    
    
    

    if($email && $last_name && $first_name){

        $sql = "INSERT INTO leads (email, last_name, first_name, deviceId, eventId, dateTimefield, 
        eventType,  category, sessionId) 
         VALUES ('$email','$last_name','$first_name', '$deviceId', '$eventId', '$dateTimefield', 
         '$eventType', '$category', '$sessionId' )";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
            TextNode("error", "Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


// messages
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


// get data from mysql database
function getData(){
    $sql = "SELECT * FROM leads";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

// update dat
function UpdateData(){
    $leadid = textboxValue("lead_id");
    $email = textboxValue("email");
    $last_name = textboxValue("last_name");
    $first_name = textboxValue("first_name");

    if($email && $last_name && $first_name){
        $sql = "
                    UPDATE leads SET email='$email', last_name = '$last_name', first_name = '$first_name' WHERE id='$leadid';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }


}


function deleteRecord(){
    $leadid = (int)textboxValue("lead_id");

    $sql = "DELETE FROM leads WHERE id=$leadid";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Enable to Delete Record...!");
    }

}


function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


function deleteAll(){
    $sql = "DROP TABLE leads";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
        Createdb();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}


// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}








