<?php 
if (isset($_SESSION['status']) && $_SESSION['status']=="Admin")
{?>
<header id="header" class="skel-layers-fixed">
				<h1>Pendidikan Kewarganegaraan</h1>
				<nav id="nav">
					<ul>
						<li><a href="#">Admin</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">Admin</a></li>
						<li><a href="#">Admin</a></li>
					</ul>
				</nav>
			</header>
<?php
}
elseif (isset($_SESSION['status']) && $_SESSION['status']=="User")
{?>
<header id="header" class="skel-layers-fixed">
				<h1>Pendidikan Kewarganegaraan</h1>
				<nav id="nav">
					<ul>
						<li><a href="#">User</a></li>
						<li><a href="#">User</a></li>
						<li><a href="#">User</a></li>
						<li><a href="#">User</a></li>					
<?php
}
else
{?>						
	<header id="header" class="skel-layers-fixed">
				<h1>Pendidikan Kewarganegaraan</h1>
				<nav id="nav">
					<ul>
						<?php
						}?>
					</ul>
				</nav>
			</header>
			