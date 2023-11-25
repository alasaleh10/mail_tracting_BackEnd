<?php
include 'connecting.php';
$email=GetEncryption('email');
$password=GetEncryption('password');

// getdate('users');
getData('users','user_email=? and user_password=?',array($email,$password));