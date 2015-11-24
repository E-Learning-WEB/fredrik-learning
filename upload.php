<?php
		include('code-koneksi.php');
	if (isset($_POST['upload']))
	{
		$waktu = time();
		$file =$_FILES['file'];
		$nama =$_FILES;
		
		//mengambil extensi file
		$fileextensi = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION); 	
		
		$judul = $_POST['judul'];
		
		if($fileextensi == 'doc' OR $fileextensi == 'docx' OR $fileextensi == 'pdf' OR $fileextensi == 'mp4')
		{
			$targetfile = "upload/".$waktu.'_'.$file['name'];
			move_uploaded_file($file['tmp_name'],$targetfile) or die ('gagal');
			$konten = 'file = "'.$file['name'].'"';
		}
		else
		{
			echo 'tipe file tidak diperbolehkan';
			die();
		}
		
		$sql="Insert into tbmateri set judul = '$judul',
										waktu = '$waktu',
										$konten";
									
									
		mysql_query($sql);
}?>

<form action="upload.php" method="post" enctype="multipart/form-data">
	Judul : <input type="text" name="judul" /> <br />
	Nama File : <input type="file" name="file" />
	<input type="submit" value="upload" name="upload" class="special button"/>
</form>
<table width="100%" border="1">
  <tr>
    <td>Judul </td>
	<td>Waktu</td>
  </tr>
  <?php
  $sql = 'select * from tbmateri';
  $data = mysql_query($sql);
  while($row = mysql_fetch_assoc($data))
  {
 ?>
 <tr>
     <td><a href="tampil.php?id=<?php echo $row['id'] ?>">
	 <?php echo $row['judul'] ?></a></td>
	   <td><?php echo date('d-M-Y H:i:s A',$row['waktu']) ?></td>
  </tr>
<?php
}
  ?>
</table>

