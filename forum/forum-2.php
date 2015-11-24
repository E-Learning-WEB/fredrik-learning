<?php
include('code-koneksi.php');
include('funcation.php');
include('plugin/Parsedown.php');
$Parsedown = new Parsedown();
$id = $_GET['id'];
$sql = "select * from tbkomunikasi where id_kom=$id and tipe=1";
$data = mysql_query($sql);
$row = mysql_fetch_assoc($data);
//check status hapus
if(mysql_num_rows($data)==0)
{
	echo"forum telah dihapus";
}
else
{
?>

<table width="100%" border="1">
  <tr>
    <td><?php echo $fungsi->idanggota_to_username($row['username']) ['nama']; ?> <?php echo date('d-M-Y H:i:s A',$row['waktu']) ?></td>
  </tr>
  <tr>
  <td><?php echo $Parsedown->text($row['isi']) ?></td>
  </tr>
    <tr>
<td> LINK : <a href="proses.php?aksi=hapus-topikforum&id=<?php echo $_GET['id']?>">HAPUS</a> <a href="">BALAS</a></td>
</tr>
  </table>
  
  <?php
  //fungsi untuk menampilkan balasan yang ada diforum
  $sql = "select * from tbkomunikasi where id_materi=$id and tipe=0";
  $data = mysql_query($sql); 
  while($row = mysql_fetch_assoc($data))
  {
  ?>
  <table width="100%" border="1">
  <tr>
    <td><?php echo $fungsi->idanggota_to_username($row['username']) ['nama']; ?> <?php echo date('d-M-Y H:i:s A',$row['waktu']) ?></td>
  </tr>
  <tr>
  <td><?php echo $Parsedown->text($row['isi']) ?></td>
  </tr>
    <tr>
<td> LINK : <a href="proses.php?aksi=hapus-balasanforum&id=<?php echo $_GET['id']?>&id_kom=<?php echo $row['id_kom'] ?>">HAPUS</a> 
<a href="?id=<?php echo $_GET['id']; ?>&aksi=balaskomentar&id_kom=<?php echo $row['id_kom'] ?>">BALAS</a></td>
</tr>
  </table>
  
  <?php
  }
  ?>
  
<?php include('baruforum.php')?>
<?php } //cek status hapus ?>