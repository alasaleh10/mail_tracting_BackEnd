<?php
include '../connecting.php';
$mail=GetEncryption('mail');



getData('mails',"mails_no=?",array($mail));