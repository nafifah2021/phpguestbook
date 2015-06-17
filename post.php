

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title>My Little Guest Book</title>
</head>
<body>



<?php
include_once("classes/config.php");



if(isset($_POST['kirim']))
{
    $namaa= $_POST['name'];
    $emaill= $_POST['email'];
    $messagee= $_POST['message'];

    if(empty($namaa) || empty($emaill) || empty($messagee))
    {
       // $isOkay = FALSE;
        echo "Maaf, data harus diisi semua!";
    }
    else  if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email'])){
       // $isOkay = FALSE;
        echo "Format email Anda salah. Silakan masukkan format email yang benar.";
    }
    else
    {
        extract($_POST);
        $now = time();
        if (mysql_query("insert into tbl_guest (`name`,email,message,`timestamp` ) values ('{$name}','$email','$message','{$now}')")) {
            header("Location: index.php");
        } else {
            echo "Koneksi error ke database!";
        }
    }

}

?>

</body>
</html>