<?php
		include('code-koneksi.php');
	?>
<table width="100%" border="1">
  <tr>
    <td>Judul </td>
	<td>Waktu</td>
  </tr>
  <?php
  $sql = 'select * from tbkomunikasi where tipe = 1 and status = 0';
  $data = mysql_query($sql);
  while($row = mysql_fetch_assoc($data))
  {
 ?>
 <tr>
     <td><a href="form-forum.php?id=<?php echo $row['id_kom'] ?>">
	 <?php echo $row['judul'] ?></a></td>
	   <td><?php echo date('d-M-Y H:i:s A',$row['waktu']) ?></td>
  </tr>
<?php
}
  ?>
</table>

