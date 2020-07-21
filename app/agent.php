<?php
 $con = mysqli_connect("localhost","root","","practice");
 if($con){
    $id = $_REQUEST['id'];
    $pass = $_REQUEST['pass'];
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $encryption_iv = '1234567891011121'; 
    $encryption_key = "Amitesh"; 
    $options = 0;
    $pass_encry = openssl_encrypt($pass, $ciphering, $encryption_key, $options, $encryption_iv);

    $query = "insert into app (agent_id,password) values('$id','$pass_encry')";
    $res  = mysqli_query($con,$query);
    http_response_code(200); 
    echo json_encode(array("status:"=>'Account Created'));
    
    /* CODE FOR DECRYPTION
    $decryption_iv = '1234567891011121'; 
    $decryption_key = "Amitesh"; 
    $pass_decry=openssl_decrypt ($pass_encry, $ciphering,  $decryption_key, $options, $decryption_iv);
    echo $pass_decry;
    */
 }
 else{
    http_response_code(400); 
    echo json_encode(array("status:"=>'Connection Failed'));
 }
 ?>