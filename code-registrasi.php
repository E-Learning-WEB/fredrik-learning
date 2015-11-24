 <?php 
 mysql_connect('localhost','root','');
 mysql_select_db('dbpkn');
 if (isset($_POST['daftar']))
 {
 $nama = $_POST['nama'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $nama_sekolah = $_POST['alamat'];
 $email = $_POST['kota'];
 

 //cek apakah kata kunci sudah ada di database ?
 if (trim($username)=='' or trim($password)=='')
 {
 echo "<p style='text-align:center'>Username dan Password Kosong. coba ulangi lagi</p>";
 echo "<p style='text-align:center'><a class='button special' href='form-registrasi.php'>Register Kembali</a></p>";
 }
 else
 {
 //Untuk cek apakah username sudah dipakai atau belum
 $sql = "select * from tbanggota where username = '$username'";
 $data = mysql_query($sql);
 
 if (mysql_num_rows($data)>0)
 {
 echo "<p style='text-align:center'>Username sudah digunakan. Coba ulangi lagi</p>";
 echo "<p style='text-align:center'><a class='button special' href='form-registrasi.php'>Register Kembali</a></p>";
 }
 
 else
 {
 $sql = "insert into tbanggota set 	nama = '$nama',
 									username = '$username',
									password = '$password',
 									nama_sekolah = '$nama_sekolah',
 									email = '$email',
									status = 'User'";
 mysql_query($sql);
 echo "<p style='text-align:center'>Data pengguna telah disimpan</p>";
 echo "<p style='text-align:center'><a class='button special' href='index.php'>Login Kembali</a></p>";
 }
 }
 }
 else
 {
 ?>
 
<div class="container small">
<form action="form-registrasi.php" method="post">
    Nama<input name="nama" type="text"><br />
	Username<input name="username"type="text"><br />
	Password<input name="password" type="password" placeholder="Minimal 10 Digit"><br />
	Nama Sekolah<input name="alamat" type="text"><br />
    E-mail<input name="kota" type="text"><br />
    <center><input name="daftar" type="submit" value="Daftar" class="button special"></center>
    </form>
	<?php include('show-registrasi.php');?>
</div>
 
 <?php
 }
 ?>