<?php
define('host','localhost');
define('username','root');
define('password','');
define('dbname','schooldb');
define('stdregprefix','KMS-00');
$conn = mysqli_connect(host,username,password,dbname);
if(mysqli_connect_errno()){
    echo "failed to connect to Mysql:".mysqli_connect_error();
    exit();
}
?>