<?php 
mysql_connect("localhost","root","");
mysql_select_db("dbpkn");
$id_kom = $_GET['judul'];
$sql = "delete from tbmateri where judul='$judul'";
mysql_query($sql);
header ('location:form-materi.php');
?>