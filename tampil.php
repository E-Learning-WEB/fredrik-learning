<?php

include('code-koneksi.php');
$id = $_GET['id'];
$sql = "select * from tbmateri where id=$id";
$data = mysql_query($sql);
$row = mysql_fetch_assoc($data);
$lokasi = 'upload/'.$row['waktu'] .'_'.$row['file'];
$extensi_belakang = pathinfo($lokasi,PATHINFO_EXTENSION); 	
?>

<?php
//jika pdf
if(strtoupper($extensi_belakang) == 'PDF')
	{
?>
<object data="<?php echo $lokasi?>" width="100%" height="380px">
</object>
<?php			
	}
?>

<?php
//jika MP4
if(strtoupper($extensi_belakang) == 'MP4')
	{
?>
<video width="320" height="240" controls>
  <source src="<?php echo $lokasi?>" type="video/mp4">
Your browser does not support the video tag.
</video>
<?php			
	}
?>


	
<?php include('form-komentar.php')?>