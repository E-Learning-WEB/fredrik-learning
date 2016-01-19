<?php
if (isset($_POST['konfirmasi_username']))
{
	include('code-koneksi.php');
	$sql = "select * from tbanggota where username ='$_POST[username]'";
	$data = mysql_query($sql);

	if (mysql_num_rows($data)>0)
	{
		$row = mysql_fetch_assoc($data);
		$email = $row['email'];

		//periksa jika belum ada lupapassword kosong make buat baru, jika tidak maka dismpan kevariable
		if($row['kode_lupapassword'] == NULL)
		{
			include 'funcation.php';
			$kodeuntuksql = sprintf('"%s:%s"',$fungsi->hashacak(16),time());
			$sql = sprintf("UPDATE tbanggota SET kode_lupapassword = $kodeuntuksql WHERE username = '$_POST[username]'");
			$data = mysql_query($sql);
			$kodelupapassword_sekarang = $kodeuntuksql;
		}
		else
		{
			$kodelupapassword_sekarang = $row['kode_lupapassword'];
		}
		
		$kodelupapassword_sekarang_array = explode(":",$kodelupapassword_sekarang);
		//hitung jumlah waktu yang tersisa

		$kodelupapassword_sekarang_waktutempo = 120 - (time()-$kodelupapassword_sekarang_array['1'])/60;

		//jika tempo telah habis maka buat kode dan waktu baru
		if($kodelupapassword_sekarang_waktutempo == 0)

		{
			$kodedanwaktu = $engine->hashacak(16) .':'. time();
			$kodedanwaktu_array = explode(":",$kodedanwaktu);
			$kode = $kodedanwaktu_array['0'];
			$waktu = $kodedanwaktu_array['1'];

			$sql = sprintf('UPDATE tbanggota SET kode_lupapassword = "%s" WHERE username = "%s"',$kodedanwaktu, $_POST['username']);

			$data = mysql_query($sql);
			mysql_num_rows($data);

		} //akhir kondisi jika tempo telah habis


		$sql = sprintf('SELECT * FROM tbanggota WHERE username = "%s"', $_POST['username']);
		$data = mysql_query($sql);
		
		$record = mysql_fetch_assoc($data);
		$kodelupapassword_baru = $record['kode_lupapassword'];
		$kodelupapassword_baru_array = explode(":",$kodelupapassword_sekarang);		
		$kode = $kodelupapassword_baru_array['0'];
		$waktu = $kodelupapassword_baru_array['1'];
		
		$to      = $record['email'];
		$subject = 'Pengembalian Password';
		$message = 'hi untuk mengembalikan akun password massukkan kode berikut '. $kode ;
		$headers = "From: LAMHOT <no-reply@learning.chanx.cf>";

		mail($to, $subject, $message, $headers);


		echo '<br>';
		echo 'Pengembalian password dikirim ';
		echo '<br>';
		echo sprintf('Harap segera periksa email anda segera, karena kode yang diperlukan untuk mengganti password hanya dapat berlaku kurang dari %d Menit',$kodelupapassword_sekarang_waktutempo);			

		echo sprintf('<blockquote style="text-align:left;"><h1 align="center">Simulasi email</h1> <br>
						HEADER EMAIL : %s <br>
						KE : %s <br>
						SUBJECT : %s <br>
						PESAN : %s
						</blockquote>',$headers,$to,$subject,$message);
		$field_username = $record['username'];
		$konfirmasi_kode = TRUE;
	}
	else
	{
		echo ('username tidak terdaftar');
	}

}


if(isset($_POST['konfirmasi_kode']))
{
	include('code-koneksi.php');
	$sql = "select * from tbanggota where username ='$_POST[username]'";
	$data = mysql_query($sql);

	if (mysql_num_rows($data)>0)
	{
		$row = mysql_fetch_assoc($data);
		$kode_mentah = explode(":",$row['kode_lupapassword']);		
		$kode = $kode_mentah[0];
	
		if($kode === $_POST['kode'])
		{
			include 'funcation.php';
			$password_baru = $fungsi->hashacak('12');
			echo 'password direset';
			$sql = "UPDATE `tbanggota` SET `kode_lupapassword` = '' WHERE `username` = '$row[username]'";
			mysql_query($sql);

			$sql = "UPDATE `tbanggota` SET `password` = '$password_baru' WHERE `username` = '$row[username]'";
			mysql_query($sql);
			

			$to      = $row['email'];
			$subject = 'Pengembalian Password';
			$message = sprintf('Hi, Akun anda telah diubah,<br> Username : %s <br>Password : %s  ',$row['username'],$password_baru);
			$headers = "From: LAMHOT <no-reply@learning.chanx.cf>";

			mail($to, $subject, $message, $headers);
			echo sprintf('<blockquote style="text-align:left;"><h1 align="center">Simulasi email</h1> <br>
							HEADER EMAIL : %s <br>
							KE : %s <br>
							SUBJECT : %s <br>
							PESAN : %s
							</blockquote>',$headers,$to,$subject,$message);			
		}
		else
		{
			echo 'KESALAHAN !!! ';
		}


	}
}


if (isset($_SESSION['login']))
{
echo "Selamat Datang: ".$_SESSION['nama'];
echo "<a href='code-logout.php'>Logout</a>";
}
else
{
	if(!isset($konfirmasi_kode))
	{
		?>
<blockquote>isikan username anda dibawah, maka kami akan mengirimkan konfirmasi ke alamat e-mail yang tertera pada akun username anda</blockquote>
<form action="" method="post">
Username <input name="username" type="text"/><br />
<input name="konfirmasi_username" type="submit" value="Oke" class="button special"/>
</form>
<?php
}
else
{
?>
<blockquote>isikan username dan kode yang anda dapat dari e-mail</blockquote>
<form action="" method="post">
username  <input name="username" type="text" value="<?php
													if(isset($field_username))
													{
														echo $field_username;
													}
 													?>" /><br />
Kode  <input name="kode" type="text"/><br />
<input name="konfirmasi_kode" type="submit" value="Oke" class="button special"/>
</form>
<?php
}

}?>
