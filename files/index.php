<?php include('db_config.php'); ?>
	<head>
		<meta charset="UTF-8" />
		<meta name='author' content='SPQR_Brutus' />
		<meta name='description' content='' />
		<meta name='keywords' content='' />
		<title>IposGame Stats</title>
<style>
@import url(bootstrap.css);
a {
	color: #04688d;
	text-decoration: none;
}

a:hover {
	color: #04688d;
	text-decoration: underline;
}
#topbar{
	position: relative;
	width: 910px;
	height: 70px;
	top: 283px;
	margin: auto;
	}
	
#topbar ul li{
	display: inline-block;
	margin: 0;
	text-align: center;
	line-height: 70px;
	width: 205px;
	height: 70px;
	}
</style>
	</head>
	<body>
<?php
    $rank = 1;
	$per_page = 15;
	$ppp = $_GET['p'];
	$sort = $_GET['sort'];
if(trim($sort) == "")
	$sort = 'online';
if(trim($sort) == "online")
	$sort = 'online desc';
if(trim($sort) == "joins")
	$sort = 'joins desc';
if(trim($sort) == "playerkill")
	$sort = 'totalPlayersKilled desc';
if(trim($sort) == "mobkill")
	$sort = 'totalMobsKilled desc';
if(trim($sort) == "money")
	$sort = 'money desc';
if(trim($sort) == "deaths")
	$sort = 'deaths desc';
	$db = new mysqli($dbHost, $dbUser, $dbPw, $dbDatabase);
	if (empty($db->connect_error)):
	$r = $db->query('SELECT * FROM players ORDER BY '.$sort.' LIMIT '.$ppp*$per_page.', '.$per_page.'');
?>
 <div id="header">
			<div id="topbar">
				<ul>
					<li>
<div align="center">
			<form action="player.php?player=" method="get">							
						<input class="form-control" maxlength="255" name="player" type="text" value="Search" />
			</form>
					</li>
            </div>
			   </ul>
		</div>
		<center>
		<table class="table table-striped">
			<thead>
				<tr>
				    <th>#</th>
					<th><a href="index.php?sort=name">Name</a></th>
					<th><a href="index.php?sort=online">Online</a></th>
					<th><a href="index.php?sort=joins">Joins</a></th>
					<th><a href="index.php?sort=playerkill">Player Kills</a></th>
					<th><a href="index.php?sort=mobkill">Mob Kills</a></th>
					<th><a href="index.php?sort=money">Money</a></th>
					<th><a href="index.php?sort=deaths">Deaths</a></th>
					<th>Details</th>	
				</tr>
			</thead>
			<tbody>
<?php while ($p = $r->fetch_assoc()): ?>
				<tr>
				    <td class='mid'><?php echo $rank++; ?></td>
					<td><img src='https://minotar.net/avatar/<?php echo $p['name'] ?>/30.png' alt='&mdash;' width='30' height='30' /><strong><?php echo $p['name'] ?></strong></td>
					<td class='mid'><?php if($p['online'] == 1): ?>
							<img alt="" src="http://www.gamesector.eu/infusions/css_server_panel/images/green.png"></img>
							<?php else: ?>
							<img alt="" src="http://www.gamesector.eu/infusions/css_server_panel/images/red.png"></img>
							<?php endif; ?></td> 
					<td class='mid'><?php echo $p['joins'] ?></td>
					<td class='mid'><?php echo $p['totalPlayersKilled'] ?></td>
					<td class='mid'><?php echo $p['totalMobsKilled'] ?></td>
					<td class='mid'><?php echo $p['money'] ?></td>
					<td class='mid'><?php echo $p['deaths'] ?></td>
					<td class='mid'><?php echo '<a class="btn btn-success" href="player.php?player=',$p['name'],'">Player Details</a>';?></td>
				</tr>
<?php endwhile; else: echo "<strong style='color: red;'>Cannot connect to database: [Error $db->connect_errno] $db->connect_error</strong>"; endif;?>
			</tbody>
		</table>
		</center> 
<?php 	
    echo '</table>';
    echo '<center><table align="center"></center>';
    if($ppp != 0 )
    echo '<td><a class="btn btn-danger" href="index.php?p=',$ppp-1,'">Previous</a></td>&nbsp&nbsp&nbsp&nbsp';
	echo '<td><a class="btn btn-danger" href="index.php?p=',$ppp+1,'">Next</a></td></td></table>';
?>
		<br />
		<br />
		<center>
		<div id="footer">
		<?php
		    //Please Do not delete this copirate
			echo 'Created by <a href="http://www.brutus.iposgp.eu">Brutus</a> copyright © 2013 - 2014 by Brutus.';
		?>		
		</div>
		</center>
	</body>
</html>	