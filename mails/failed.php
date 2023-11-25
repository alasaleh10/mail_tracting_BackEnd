<?php
include '../connecting.php';

$userid=GetEncryption('id');

getAllData('mails',"user_id=$userid AND mails_status=2");


