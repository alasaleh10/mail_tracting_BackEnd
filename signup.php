<?php

include 'connecting.php';
$user_name=Encryption('name');
$user_email=Encryption('email');
$user_password=Encryption('password');


$count=getData('users','user_email=?',array($user_email),false);

if($count>0){
    echo json_encode(array("status" => "failure"));
   }
else{
       $data=array(
        'user_name'=>$user_name,
        'user_email'=>$user_email,
        'user_password'=>$user_password
    );
    
    insertData('users',$data,false);

    getData('users','user_email=?',array($user_email),true);

 
}

