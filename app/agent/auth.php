<?php
 $con = mysqli_connect("localhost","root","","practice");
 if($con){
    $id = $_REQUEST['id'];
    $pass = $_REQUEST['pass'];
    $query1 = "select agent_id from app where agent_id = '$id'";
    $res1 = mysqli_query($con,$query1);
    $num =  mysqli_num_rows($res1);
    if($num == 0)
        {
        http_response_code(401);
        echo json_encode(array("status:"=>'Failure'));
        }
        else{
            $query2 = "select password from app where agent_id = '$id' ";
            $res2 = mysqli_query($con,$query2);
            $res = mysqli_fetch_assoc($res2);

            $decryption_iv = '1234567891011121'; 
            $ciphering = "AES-128-CTR";
            $options = 0;
            $decryption_key = "Amitesh"; 
            $pass_encry = $res['password'];
            
            $pass_decry=openssl_decrypt ($pass_encry, $ciphering,  $decryption_key, $options, $decryption_iv);
            if($pass_decry==$pass)
            {
                http_response_code(200);
                echo json_encode(array("Agent_ID"=>$id));
                echo json_encode(array("status:"=>'Success'));
            }
            else{
                http_response_code(401);
                echo json_encode(array("status:"=>'Failure'));
            }
        }
}
else{
    http_response_code(400); 
    echo json_encode(array("status:"=>'Connection Failed'));
 }
?>