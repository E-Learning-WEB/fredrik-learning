<?php
	include('code-koneksi.php');
	
		$sql = "SELECT * FROM tbmateri WHERE id = $_GET[edit]";
		$data = mysql_fetch_assoc(mysql_query($sql));
		//cek jika tidak ada maka error
		if(mysql_num_rows(mysql_query($sql))==0)
		{
			$error .= 'terjadi kesalahan';
		}
		
		
		if(empty($error))
		{

		}
		
	
	
	
	if (isset($_POST['upload']))
	{
		$waktu = time();
		$konten = null;
		$filesebelumnya = 'upload/'.$_POST['filesebelumnya'];
		//jika ada data yang diupload baru
		
		if($_FILES["file"]["error"] == 0) 
		{	
			$file =$_FILES['file'];
			//mengambil extensi file
			$fileextensi = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION); 	
			
			
			if($fileextensi == 'doc' OR $fileextensi == 'docx' OR $fileextensi == 'pdf' OR $fileextensi == 'mp4')
			{
				$targetfile = "upload/".$waktu.'_'.$file['name'];
				move_uploaded_file($file['tmp_name'],$targetfile) or die ('gagal');
				$konten = 'file = "'.$file['name'].'"';
			}
			else
			{
				$error = 'tipe file tidak diperbolehkan';
			}
								
		}
		
		$judul = $_POST['judul'];
		
		
		$sql="UPDATE tbmateri set judul = '$judul',
										waktu = '$waktu',
										$konten
										WHERE id = '$_GET[edit]'
										";	
		echo $sql;										
			if (!unlink($filesebelumnya))
			  {
				  $pesan .= "FIle Gagal dihapus";
				  $error = 1;
			  }
			else
			  {
				  $pesan .=  "File Dihapus";
			  }		
																		
									
		mysql_query($sql);
}?>


MENGUBAH MATERI <?php echo $data['judul'] ?>
<form action="uploadedit.php?edit=<?php echo $data['id'] ?>" method="post" enctype="multipart/form-data">
	Judul: <input type="text" name="judul" value="<?php echo $data['judul'] ?>" /> 
    <br />
	FIle<input type="file" name="file" />
    <input type="hidden" name="waktu" value="<?php echo $data['waktu'] ?>">
    <input type="hidden" name="filesebelumnya" value="<?php echo $data['waktu'] .'_'.$data['file'] ?>">    
	<input type="submit" value="upload" name="upload" class="special button"/>
</form>

