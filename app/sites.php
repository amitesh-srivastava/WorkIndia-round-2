<?php
 global $argc, $argv;
 $con = mysqli_connect("localhost","root","","practice");
 if($con){
    // Enable argv and argc to run argv command
    $id = $argv['agentId'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $category = $_REQUEST['category'];
    $due_date = $_REQUEST['due_date'];
    $query = "insert into todo values('$id','$title','$description','$category','$due_date')";
    $res  = mysqli_query($con,$query);
    http_response_code(200);
    echo json_encode(array("Status: "=>"success"));
 }
 else{
    http_response_code(400); 
    echo json_encode(array("status:"=>'Connection Failed'));
 }
 ?>