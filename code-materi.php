<?php
if (isset($_POST['tbmateri']))
	{
		$judul = $_POST['judul'];
		$materi = $_POST['materi'];
		include('koneksi.php');
		//untuk cek apakah judul sudah terpakai atau belum
		$sql = "select * from tbmateri where judul = '$judul'";	
		$data = mysql_query($sql);
			
			if (mysql_num_rows($data)>0)
				{
				echo "<p style='text-align:center'>Judul telah ada, masukkan judul lain</p>";
				echo "<p style='text-align:center'><a class='button special' href='form-materi.php'>Kembali</a></p>";
				}
				
				else
				{
				$sql = "insert into tbmateri set judul = '$judul',
											     materi = '$materi'";
											   

											
											   
				mysql_query($sql);
				echo "<p style='text-align:center'>Data tersimpan, Silahkan kembali</p>";
				echo "<p style='text-align:center'><a class='button special' href='form-materi.php'>Kembali</a></p>";
				}
				}
					else
					{?>

<div class="container small">
<form method="post" action="form-materi.php">
    Judul <input name="judul" type="text"> <br/>
    Materi <input name="materi" type="text"> <br/>

    <center><input name="tbmateri" type="submit" value="&nbsp;Simpan&nbsp;" class="button special"></center>
<?php include('show-materi.php');?>
</form>
</div>
						<?php
                        }
                        ?>