<?php
if (isset($_POST['login']))
{
include('code-koneksi.php');
$sql = "select * from tbanggota where username ='$_POST[username]' and password = '$_POST[password]'";
$data = mysql_query($sql);
if (mysql_num_rows($data)>0)
{
$row = mysql_fetch_assoc($data);
$_SESSION['login']=True;
$_SESSION['nama']=$row['nama'];
$_SESSION['username']=$row['username'];
$_SESSION['status']=$row['status'];
}
}
if (isset($_SESSION['login']))
{
echo "Selamat Datang: ".$_SESSION['nama'];
echo "<a href='code-logout.php'>Logout</a>";
}
else
{?>
<form action="index.php" method="post">
Username <input name="username" type="text"/><br />
Password <input name="password" type="password"/><br />
<input name="login" type="submit" value="Login" class="button special"/>
</form>
<?php
}?>
