<?php 
mysql_connect("localhost","root","");
mysql_select_db("dbpkn");
if (isset($_POST['submit']))
{
$judul = $_POST['judul'];
$materi = $_POST['materi'];
$sql = "update tbmateri set judul = '$judul',
							 materi = '$materi',
		where judul = '$judul'";
		mysql_query($sql);
		header('location:form-materi.php');	
}
if (isset($_GET['judul']))
{
		mysql_connect("localhost","root","");
		mysql_select_db("dbpkn");
		$judul = $_GET['judul'];
		$sql = "select * from tbmateri where judul='$judul'";
		$data = mysql_query($sql);
		if (mysql_num_rows($data)>0) 
		{
			$row = mysql_fetch_assoc($data);
			
			?>
<form action="form-materi.php" method="post">
    Judul<input name="nama" type="text" value="<?php echo $row['judul']; ?>"><br />
    Materi<input name="kota" type="text" value="<?php echo $row['materi']; ?>"><br />
    <center><input name="daftar" type="submit" value="Daftar" class="button special" title="Add Data"></center>
    </form>
	<?php include('show-materi.php');?>
<?php
}
}
?>
