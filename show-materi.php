<form action="form-materi.php" method="post">
Kriteria <select name="kriteria">
			<option value="id_materi">judul</option>
			<option value="id_anggota">materi</option>
			</select> <br />
Kondisi <input type="text" name="cari" size="20" maxlength="50"> <br />
<input type="submit" name="filter" value="FILTER" class="button special">
</form>
<?php
mysql_connect("localhost","root","");
mysql_select_db("dbpkn");
if (isset($_POST['filter']))
{
$kriteria = $_POST['kriteria'];
$cari =$_POST['cari'];
$sql = "select * from tbmateri where $kriteria like '%$cari%'";
$data = mysql_query($sql) or die("$sql");
}
else
{
$sql = "select * from tbmateri";
$data = mysql_query($sql) or die("$sql");
}
?>
<table width="100%">
<tr>
<th>Judul</th>
<th>Materi</th>
<th>delete</th>
<th>edit</th>
</tr>
<?php 
while ($row = mysql_fetch_assoc($data))
{
?> 
<tr>
<td><?php echo $row['judul'];?></td>
<td><?php echo $row['materi'];?></td>
<td><a href="hapus-materi.php?judul=<?php echo $row['judul'];?>" class="button special" title="Delete Data">DELETE</a></td>
<td><a href="edit-materi.php?judul=<?php echo $row['judul'];?>" class="button special" title="Edit Data">EDIT</a></td>
</tr>
<?php
}?>
</table>