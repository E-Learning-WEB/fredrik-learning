<?php
session_start();
if(isset($_POST['kirimkomentar_materi']))
{
//PROSES
$username = $_SESSION['username'];
include 'code-koneksi.php';
$id_materi = $_POST['id'];
$isi = mysql_real_escape_string($_POST['isikomentar']);
$waktu = time();
$sql = "insert into tbkomunikasi set waktu = '$waktu',
									id_materi = '$id_materi',
									isi = '$isi',
									username = '$username',
									tipe = 2";
mysql_query($sql);
$_SESSION['kutipan'] = NULL;
$pesan = "Sukses";
$redirect = header("refresh:2;url=http://localhost/education-zone/tampil.php?id=$_POST[id]");
}//akhir kirim komentar materi

if(isset($_GET['aksi']))
{
	if($_GET['aksi'] == 'hapus-balasanforum')
	{
	include 'code-koneksi.php';
	$id_komunikasi = $_GET['id_kom'];
	$sql = "delete from tbkomunikasi where id_kom = $id_komunikasi";
	mysql_query($sql);
	
	$pesan = "Sukses";
	$redirect = header("refresh:2;url=http://localhost/education-zone/form-forum.php?id=$_GET[id]");
	}
	
	if($_GET['aksi'] == 'hapus-topikforum')
	{
		include 'code-koneksi.php';
		$sql = "UPDATE tbkomunikasi SET status=2 WHERE id_kom = $_GET[id]";

		mysql_query($sql);
		header("refresh:2;url=http://localhost/education-zone/form-forumdaftar.php");
		$pesan = "Topik Sudah dihapus";
	}
	
	
		if($_GET['aksi'] == 'hapusmateri')
		{
			
		include 'code-koneksi.php';		
			
		$sql = "SELECT * from tbmateri WHERE id = $_GET[id]";
		//mengambil data record yang telah ada didatabase
		//periksa jika data ada
		$data = mysql_query($sql);
		
		echo $sql;
		if (mysql_num_rows($data)>0)
		{    
			$recordmateri = mysql_fetch_assoc($data);
			//mulai hapus file
			$file = sprintf('upload/%s_%s',$recordmateri['waktu'],$recordmateri['file']);
			echo $file;
			if (!unlink($file))
			  {
				  $pesan .= "FIle Gagal dihapus";
				  $error = 1;
			  }
			else
			  {
				  $pesan .=  "File Dihapus";
			  }
			
			
			//mulai hapus dari database
			if(!isset($error))
			{
				$sql = "DELETE FROM tbmateri WHERE id = $_GET[id]";
				echo $sql;
				$hapus = mysql_query($sql);
				
			}//hapus dari databse
		}//periksa data
		else
		{
			$pesan .= 'ERROR, terjadi kesalahan, kemungkinan data telah terhapus dari database';
		}
		
	} //akhir hapus materi

}

echo $pesan;
