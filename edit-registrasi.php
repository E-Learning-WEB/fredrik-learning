<?php 
mysql_connect("localhost","root","");
mysql_select_db("dbpkn");
if (isset($_POST['submit']))
{
echo 'xxx';
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama_sekolah = $_POST['nama_sekolah'];
$email = $_POST['email'];
$sql = "update tbanggota set nama = '$nama',
							 username = '$username',
							 password = '$password',
 							 nama_sekolah = '$nama_sekolah',
 							 email = '$email',
							 status = 'User'
		where username = '$username'";
		mysql_query($sql);
	 
		header('location:form-registrasi.php');	
}
if (isset($_GET['username']))
{
		mysql_connect("localhost","root","");
		mysql_select_db("dbpkn");
		$username = $_GET['username'];
		$sql = "select * from tbanggota where username='$username'";
		$data = mysql_query($sql);
		if (mysql_num_rows($data)>0) 
		{
			$row = mysql_fetch_assoc($data);
			
			?>
<form action="edit-registrasi.php" method="post">
    Nama<input name="nama" type="text" value="<?php echo $row['nama']; ?>"><br />
	Username<input name="username"type="text" value="<?php echo $row['username']; ?>"><br />
	Password<input name="password" type="text" value="<?php echo $row['password']; ?>"><br />
	Nama Sekolah<input name="nama_sekolah" type="text" value="<?php echo $row['nama_sekolah']; ?>"><br />
    Email<input name="email" type="text" value="<?php echo $row['email']; ?>"><br />
    <center><input name="submit" type="submit" value="Simpan" class="button special"></center>
    </form>
	<?php include('show-registrasi.php');?>
<?php
}
}
?>
