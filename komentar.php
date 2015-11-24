<?php 
if(!isset($_SESSION['login']))
{
session_start();
}
include 'funcation.php';
//fungsi untuk memperindah tulisan dengan parsedown
include 'plugin/Parsedown.php';
$Parsedown = new Parsedown();

$username = $_SESSION['username'];

if(isset($_POST['kirimkomentar']))
{
include 'code-koneksi.php';
$id_materi = $row['id'];
$isi = mysql_real_escape_string($_POST['isikomentar']);
$waktu = time();
$sql = "insert into tbkomunikasi set waktu = '$waktu',
									id_materi = '$id_materi',
									isi = '$isi',
									username = '$username',
									tipe = 2";
mysql_query($sql);
$_SESSION['kutipan'] = NULL;
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


<html>
<head>
<link href="plugin/bootstrap.min.css" type="text/css" rel="stylesheet">    
<link href="plugin/bootstrap-themes.css" type="text/css" rel="stylesheet">    
</head>
<body>
<table width="80%">
<tr>
	<td>
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
<form method="post" action="proses.php"> 
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<textarea data-provide="markdown" name="isikomentar" cols="40"><?php echo $isi; ?></textarea>
</textarea> <br />
<input type="submit" name="kirimkomentar_materi" value="Kirim" class="special button">
</form>
    </td>
</tr>
</table>

<h3> KOMENTAR </h3>
<?php 
//untuk daftar komentar
$id_materi = $_GET['id'];
$sql = "select * from tbkomunikasi where id_materi = '$id_materi'";
$data =  mysql_query($sql);
while ($row = mysql_fetch_assoc($data))
{
$namauser = $row['username'];
$isi = $Parsedown->text($row['isi']);
?>


<table width="100%" border="1">
  <tr>
    <td><?php echo $fungsi->idanggota_to_username($namauser)["nama"]; ?> <?php echo date('d-M-Y H:i:s A',$row['waktu']) ?></td>
  </tr>
  <tr>
    <td><?php echo $isi ?></td>
  </tr>
  <tr>
<td> LINK : <a href="?id=<?php echo $_GET['id']; ?>&aksi=hapuskomentar&id_kom=<?php echo $row['id_kom'] ?>">HAPUS</a> <a href="?id=<?php echo $_GET['id']; ?>&aksi=balaskomentar&id_kom=<?php echo $row['id_kom'] ?>">BALAS</a></td>
</tr>
</table>
<?php
}//aktif daftar komentar
?>



<!--  Scripts-->
<script src="plugin/bootstrap.min.js"></script>
<script src="plugin/jquery-2.1.4.min.js"></script>
<script src="plugin/markdown.js"></script>
</body>
</html>