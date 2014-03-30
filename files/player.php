<?php include('db_config.php'); ?>
	<head>
		<meta charset="UTF-8" />
		<meta name='author' content='SPQR_Brutus' />
		<meta name='description' content='' />
		<meta name='keywords' content='' />
		<title>IposGame Stats</title>
    </head>
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
<?php
    $player = $_GET['player'];
	$db = new mysqli($dbHost, $dbUser, $dbPw, $dbDatabase);
	if (empty($db->connect_error)):
	$r = $db->query('SELECT * FROM players WHERE name LIKE "'.$player.'"');
	$s = $db->query('SELECT * FROM permissions_inheritance WHERE child LIKE "'.$player.'"');
	$m = $db->query('SELECT id FROM mcmmo_users WHERE user LIKE "'.$player.'"');
	while ($data = $m->fetch_assoc()):
    {
    $player_id = $data['id'];
    }
    endwhile;
	$mt = $db->query('SELECT * FROM mcmmo_skills WHERE user_id= '.$player_id.'');
?>
<div id="header">
			<div id="topbar">
				<ul>
					<li>
<?php 
echo '<table id="prev_next" align="center"><tr>';
echo '<td><a class="btn btn-danger" href="http://iposgp.eu/stats/index.php">Back</a></td></table>';
?>			
					</li>
            </div>
		</div>
<?php while ($data = $r->fetch_assoc()):
{
echo '<table style="font-size: 25px; " align="center"><td><img src="skin_gen.php?player='.$player.'"></td><td>';
echo '<table style="font-size: 25px; " align="center"><tr><td><span style="text-decoration:underline; font-size: 30px;">'."$player</td><td></tr><table style='font-size: 25px; ' align='center'><tr><td>";
echo '<tr><td>Joins:</td><td>'. $data['joins'].'</td></tr>';
echo '<tr><td>Player kills:</td><td>'. $data['totalPlayersKilled'].'</td></tr>';
echo '<tr><td>Mob kills:</td><td>'. $data['totalMobsKilled'].'</td></tr>';
echo '<tr><td>Health:</td><td>'. $data['health'].'</td></tr>';
echo '<tr><td>Food:</td><td>'. $data['foodLevel'].'</td></tr>';
echo '<tr><td>Level:</td><td>'. $data['level'].'</td></tr>';
echo '<tr><td>EXP:</td><td>'. $data['exp'].'</td></tr>';
echo '<tr><td>Money:</td><td>'. $data['money'].'</td></tr>';
echo '<tr><td>Deaths:</td><td>'. $data['deaths'].'</td></tr>';
echo '<tr><td>PickUP items:</td><td>'. $data['totalItemsPickedUp'].'</td></tr>';
echo '<tr><td>Blocks placed:</td><td>'. $data['totalBlocksPlaced'].'</td></tr>';
echo '<tr><td>Blocks broken:</td><td>'. $data['totalBlocksBroken'].'</td></tr>';
echo '<tr><td>Enchanted Items:</td><td>'. $data['itemsEnchanted'].'</td></tr>';
echo '<tr><td>Arrows Shot:</td><td>'. $data['arrowsShot'].'</td></tr>';
echo '<tr><td>Last Mob Killed:</td><td>'. $data['lastMobKilled'].'</td></tr>';
echo '<tr><td>Kicks:</td><td>'. $data['kicks'].'</td></tr>';
echo '<tr><td>Time Elapsed:</td><td>'. $data['totalTime'] / 60 .' min</td></tr>';
echo '<tr><td>Gamemode:</td><td>'. $data['gameMode'].'</td></tr>';
echo '<tr><td>World:</td><td>'. $data['world'].'</td></tr>';
if ($data['groups'] == '["Hrac"]'): 
echo '<tr><td>Group:</td><td><span style="color:#00D5FF;">Player</span></span></td></tr>';
endif;
}
endwhile; else: echo "<strong style='color: red;'>Cannot connect to database: [Error $db->connect_errno] $db->connect_error</strong>"; endif; 

while ($pex = $s->fetch_assoc()):
{
echo '<tr><td>Group:</td><td><span style="color:#00D5FF;">'. $pex['parent'].'</span></td></tr>';
}
endwhile;
echo "</table><br><br><br>";
if ($mcmmoon == 'true'):
echo "</td></tr></table></td></tr></table>";
echo '<tr><td><center><img alt="" src="images/mcmmo.png" style="width: 318px; height: 159px;" /></center></td><td>'; 
echo '<center><table class="table table-bordered"><tr class="info" align="center"><td>Taming</td><td>Mining</td><td>Woodcutting</td><td>Repair</td><td>Unarmed</td><td>Herbalism</td><td>Excavation</td><td>Archery</td><td>Swords</td><td>Axes</td><td>Acrobatics</td><td>Fishing</td></tr>';

while ($mcmmo = $mt->fetch_assoc()):		
{
echo '<tr class="danger"',($index%2) + 1,'"><td>',$mcmmo['taming'],'</td>';
echo '<td>',$mcmmo['mining'],'</td>';
echo '<td>',$mcmmo['woodcutting'],'</td>';
echo '<td>',$mcmmo['repair'],'</td>';
echo '<td>',$mcmmo['unarmed'],'</td>';
echo '<td>',$mcmmo['herbalism'],'</td>';
echo '<td>',$mcmmo['excavation'],'</td>';
echo '<td>',$mcmmo['archery'],'</td>';
echo '<td>',$mcmmo['swords'],'</td>';
echo '<td>',$mcmmo['axes'],'</td>';
echo '<td>',$mcmmo['acrobatics'],'</td>';
echo '<td>',$mcmmo['fishing'],'</td>';
}
endwhile; 
endif;
?>
		</tbody>
		</table>
		<center>
		<div id="footer">
			<?php
		    //Please Do not delete this copirate
			echo 'Created by <a href="http://www.brutus.iposgp.eu">Brutus</a> copyright © 2013 - 2014 by Brutus.'; ?>
			<br />
			<endora>
		</div>
		</center>
    </table>



