<?php 
mysql_connect("localhost","root","");
mysql_select_db("dbpkn");
$id_anggota = $_GET['id_anggota'];
$sql = "delete from tbanggota where id_anggota='$id_anggota'";
mysql_query($sql);
header ('location:form-registrasi.php');
?>