<?php 


if(isset($_POST['kirimforum']))
{
	include 'code-koneksi.php';
	$username = $_SESSION['username'];
	$isi = mysql_real_escape_string($_POST['isi']);
	$waktu = time();
	$tipe = 1;
	$id_materi = 0;
	//jika balas komentar
	if(isset($_GET['id']))
	{
	$tipe = 0;
	$id_materi = $_GET['id'];
	}
	$sql = "insert into tbkomunikasi set judul = '$_POST[judul]', 
										waktu = '$waktu',
										isi = '$isi',
										id_materi ='$id_materi',
										username = '$username',
										tipe = $tipe";
	echo $sql;									
	mysql_query($sql);
	header("location:form-forumdaftar.php");
	//echo sql;
}

//jika ada aksi
if(isset($_GET['aksi']))
{
	if($_GET['aksi']=='hapuskomentar')
{
		$sql_kom = "delete from tbkomunikasi where id_kom='$_GET[id_kom]'";
		mysql_query($sql_kom);
}
elseif($_GET['aksi']=='balaskomentar')
{
	$sql_kom = "select isi,username from tbkomunikasi where id_kom='$_GET[id_kom]'";
	$data_kom = mysql_query($sql_kom);
	$datakutipan = mysql_fetch_assoc($data_kom);
	$_SESSION['kutipan'] = $datakutipan['isi'];
}
}//akhir aksi
else
{
	$_SESSION['kutipan'] = NULL;
}
?>

<link href="plugin/bootstrap.min.css" type="text/css" rel="stylesheet">    
<link href="plugin/bootstrap-themes.css" type="text/css" rel="stylesheet">    
<?php
$judul_input = 'Input Forum baru';
if(isset($_GET['id']))
{
$judul_input = 'Balas Forum';
}
?>
<h3 align="center"><?php echo $judul_input?></h3>
<form method="post" action=""> 
<!--<input type="text" name="judul" placeholder="Judul"> <br />-->
<?php
	if(!empty($_SESSION['kutipan']))
	{
	$balasan_anggota = $fungsi->idanggota_to_username($datakutipan['username'])['nama'];
	$isi =
	"<blockquote>
	Membalas komentar ". $balasan_anggota.
	"<p>".$_SESSION['kutipan']."</p>".
	"</blockquote>"
	;
	}
	else
	{
	$isi = null;
	}
?>
<textarea data-provide="markdown" name="isi" cols="40"><?php echo $isi ?></textarea> <br />
<input type="submit" name="kirimforum" value="Kirim" class="special button">
</form>

<!--  Scripts-->
<script src="plugin/bootstrap.min.js"></script>
<script src="plugin/jquery-2.1.4.min.js"></script>
<script src="plugin/markdown.js"></script>