<form action="form-registrasi.php" method="post">
Kriteria <select name="kriteria">
			<option value="nama">nama</option>
			<option value="username">username</option>
			<option value="password">password</option>
			<option value="nama_sekolah">nama_sekolah</option>
			<option value="status">status</option>
			<option value="email">email</option>
			</select> <br />
Kondisi <input type="text" name="cari" size="20" maxlength="50"> <br />
<input type="submit" name="filter" value="FILTER" class="button special" title="Filter Data">
</form>
<?php
mysql_connect("localhost","root","");
mysql_select_db("dbpkn");
if (isset($_POST['filter']))
{
$kriteria = $_POST['kriteria'];
$cari =$_POST['cari'];
$sql = "select * from tbanggota where $kriteria like '%$cari%'";
$data = mysql_query($sql) or die("$sql");
}
else
{
$sql = "select * from tbanggota";
$data = mysql_query($sql) or die("$sql");
}
?>
<table width="100%" border="1">
<tr>
<th>Nama</th>
<th>Username</th>
<th>Password</th>
<th>Nama Sekolah</th>
<th>Status</th>
<th>Email</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php 
while ($row = mysql_fetch_assoc($data))
{
?> 
<tr>
<td><?php echo $row['nama'];?></td>
<td><?php echo $row['username'];?></td>
<td><?php echo $row['password'];?></td>
<td><?php echo $row['nama_sekolah'];?></td>
<td><?php echo $row['status'];?></td>
<td><?php echo $row['email'];?></td>
<td><a href="hapus-registrasi.php?id_anggota=<?php echo $row['id_anggota'];?>"><img src="images/delete.jpg" /></a></td>
<td><a href="form-editregistrasi.php?username=<?php echo $row['username'];?>" ><img src="images/edit.jpg" /></a></td>
</tr>
<?php
}?>
</table>