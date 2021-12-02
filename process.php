<?php 

session_start();


$mysqli = new mysqli('localhost', 'root', 'pass', 'crud') or die(mysqli_error($mysqli));

//update the data 
$name = '';
$country= '';
$update = false;
$id= 0;


if (isset($_POST['save'])){

    $name = $_POST['name'];
    $country = $_POST['country'];




    $mysqli->query("insert into data(name, country) values ('$name', '$country') ") or
     die($mysqli->error);

    $_SESSION['message'] = "Record has been saved! ";
    $_SESSION['msg_type'] = "success";

    //back to index page
    header("location: index.php");

}

//delete record
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("delete from data where id=$id ") or die($mysqli_error()) ;

    $_SESSION['message'] = "Record has been deleted! ";
    $_SESSION['msg_type'] = "danger";

    //back to index page
    header("location: index.php");

}

if(isset($_GET['edit'])){

    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("select * from data where id=$id ") or die($mysqli_error());

    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $country = $row['country'];
    
    
    }

}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $country = $_POST['country'];


    $mysqli->query("update data set name='$name' , country ='$country' where id='$id'") or
    die($mysqli_error());

    $_SESSION['message'] = "Record has been updated! ";
    $_SESSION['msg_type'] = "warning";

    //back to index page
    header("location: index.php");



}