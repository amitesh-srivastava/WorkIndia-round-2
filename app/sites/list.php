<?php
 $con = mysqli_connect("localhost","root","","practice");
 if($con){
    $agent = $_REQUEST['agent'];
    $query = mysqli_query($con,"select * from todo where agent_id = '$agent' order by due_date asc");
    $row = mysqli_num_rows($query); 
    if($row>0){
        $products_arr=array();
        $products_arr["TODO: "]=array();
        while($res = mysqli_fetch_assoc($query)){
            extract($res);
            $pi = array(
                'agent_id'=>$agent_id,
                'title'=>$title,
                'description'=>$description,
                'category'=>$category,
                'due_date'=>$due_date
            );
            array_push($products_arr["TODO: "],$pi);
        }
        http_response_code(200);
        echo json_encode($products_arr);
    }
    else{
        http_response_code(200);
        echo json_encode(array("NOTASK"=>"EMPTY"));
    }
 }
 else{
    http_response_code(400); 
    echo json_encode(array("status:"=>'Connection Failed'));
 }
 ?>