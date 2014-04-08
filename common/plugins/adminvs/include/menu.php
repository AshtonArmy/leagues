<?php

function isTournamentAdmin($tournament_id, $auth, $user_id){
	if ($auth) {
		$aAdmin = Engine::GetInstance()->PluginVs_Stat_GetTournamentadminItemsByFilter(array(
			'tournament_id' => $tournament_id,
			'user_id' => $user_id,
			'#page' => 'count',
			'expire >='   => date("Y-m-d")
		));
		if($aAdmin['count']>0)return 1;
	}
	return 0;
}	
function DateAdd($interval, $number, $dates) {

    $date_time_array = getdate($dates);
    $hours = $date_time_array['hours'];
    $minutes = $date_time_array['minutes'];
    $seconds = $date_time_array['seconds'];
    $month = $date_time_array['mon'];
    $day = $date_time_array['mday'];
    $year = $date_time_array['year'];
/*	foreach ($date_time_array as $time=>$v ) {
		echo $time.'-'.$v.'<br>';
	}*/
    switch ($interval) {
    
        case 'yyyy':
            $year+=$number;
            break;
        case 'q':
            $year+=($number*3);
            break;
        case 'm':
            $month+=$number;
            break;
        case 'y':
        case 'd':		
            $day+=$number;
            break;
        case 'w':
            $day+=($number*7);
            break;
        case 'ww':
        case 'h':
            $hours+=$number;
            break;
        case 'n':
            $minutes+=$number;
            break;
        case 's':
            $seconds+=$number; 
            break;            
    }
       $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
	  // echo $year.'-'.$month.'-'.$day.'</br>';
    return $timestamp;
}
function getmenu($platform_id,$platform_name){

if($platform_name=='ps3')$platform_full_name='Playstation';
if($platform_name=='xbox')$platform_full_name='Xbox';
if($platform_name=='pc')$platform_full_name='PC';

$query="SET NAMES UTF8;";
$result=mysql_query($query) or die("ERROR3! Cannot execute query");

$query="SELECT * FROM `tis_stat_game` where platform_id='".$platform_id."' order by game_id desc";
$result=mysql_query($query) or die("ERROR3! Cannot execute query");
$What='';
while($row = mysql_fetch_array($result)){
	//$What.='<li><a href="http://virtualsports.ru/'.$platform_name.'/'.$row["brief"].'/">'.$row["name"].'</a>';
	if($row["oneplay"]==1 || $row["twoplay"]==1 || $row["teamplay"]==1 || $row["hut"]==1){
		$What.='<ul id="'.$platform_full_name.'_'.strtolower($row["brief"]).'">';
		if($row["oneplay"]==1){
			$What.='<li class="open collapsable"><span>Одиночные турниры</span>';
				$query_tournament="SELECT * FROM `tis_stat_tournament` t, `tis_blog` b where t.game_id='".$row['game_id']."' and t.gametype_id=1 and t.blog_id=b.blog_id order by t.tournament_id desc";
				$result_tournament=mysql_query($query_tournament) or die("ERROR3! Cannot execute query");
				$What.='<ul>';
				//$What.='<li><a href="http://virtualsports.ru/'.$platform_name.'/'.$row["brief"].'/1vs1/">В раздел</a></li>';
				if(mysql_num_rows($result_tournament)>0){ 
					
					while($row_t = mysql_fetch_array($result_tournament)){
						$What.='<li><a '.($row_t['zavershen']==0?'':'class="played"').' href="http://'.$row_t["blog_url"].'.virtualsports.ru/turnir/'.$row_t["url"].'/">'.$row_t["name"].'</a></li>';
					}
					
				}
				$What.='</ul>';
			$What.='</li>';
		}
		if($row["hut"]==1){
			$What.='<li><span>Турниры HUT</span>';
				$query_tournament="SELECT * FROM `tis_stat_tournament` t, `tis_blog` b where t.game_id='".$row['game_id']."' and t.gametype_id=4 and t.blog_id=b.blog_id order by t.tournament_id desc";
				$result_tournament=mysql_query($query_tournament) or die("ERROR3! Cannot execute query");
				if(mysql_num_rows($result_tournament)>0){ 
					$What.='<ul>';
					//$What.='<li><a href="http://virtualsports.ru/'.$platform_name.'/'.$row["brief"].'/hut/">В раздел</a></li>';
					while($row_t = mysql_fetch_array($result_tournament)){
						$What.='<li><a '.($row_t['zavershen']==0?'':'class="played"').' href="http://'.$row_t["blog_url"].'.virtualsports.ru/turnir/'.$row_t["url"].'/">'.$row_t["name"].'</a></li>';
					}
					$What.='</ul>';
				}
			$What.='</li>';
		}
		if($row["twoplay"]==1){
			$What.='<li><span>Турниры 2 на 2</span>';
				$query_tournament="SELECT * FROM `tis_stat_tournament` t, `tis_blog` b where t.game_id='".$row['game_id']."' and t.gametype_id=2 and t.blog_id=b.blog_id order by t.tournament_id desc";
				$result_tournament=mysql_query($query_tournament) or die("ERROR3! Cannot execute query");
				if(mysql_num_rows($result_tournament)>0){ 
					$What.='<ul>';
					//$What.='<li><a href="http://virtualsports.ru/'.$platform_name.'/'.$row["brief"].'/2vs2/">В раздел</a></li>';
					while($row_t = mysql_fetch_array($result_tournament)){
						$What.='<li><a '.($row_t['zavershen']==0?'':'class="played"').' href="http://'.$row_t["blog_url"].'.virtualsports.ru/turnir/'.$row_t["url"].'/">'.$row_t["name"].'</a></li>';
					}
					$What.='</ul>';
				}
			$What.='</li>';
		}		
		if($row["teamplay"]==1){
			$What.='<li><span>Командные турниры</span>';
				$query_tournament="SELECT * FROM `tis_stat_tournament` t, `tis_blog` b where t.game_id='".$row['game_id']."' and t.gametype_id=3 and t.blog_id=b.blog_id order by t.tournament_id desc";
				$result_tournament=mysql_query($query_tournament) or die("ERROR3! Cannot execute query");
				if(mysql_num_rows($result_tournament)>0){ 
					$What.='<ul>';
					//$What.='<li><a href="http://virtualsports.ru/'.$platform_name.'/'.$row["brief"].'/teamplay/">В раздел</a></li>';
					while($row_t = mysql_fetch_array($result_tournament)){
						$What.='<li><a '.($row_t['zavershen']==0?'':'class="played"').' href="http://'.$row_t["blog_url"].'.virtualsports.ru/turnir/'.$row_t["url"].'/">'.$row_t["name"].'</a></li>';
					}
					$What.='</ul>';
				}
			$What.='</li>';
		}	
		$What.='</ul>';
	}
	//$What.='</li>';
}
return $What;
}
function setmenu(){
}
function setmenu_(){
	include("./config/config.local.php");
	$db=$config['db']['params']['dbname'];
	$user=$config['db']['params']['user'];
	$pass=$config['db']['params']['pass'];
	$server=$config['db']['params']['host'];
	mysql_connect($server, $user, $pass) or die("Could not connect to MySQL server!");
	@mysql_select_db($db) or die("Could not select company database!");
	
$sPath="./templates/skin/vs-new/menu_vs.tpl";	
file_get_contents($sPath);
$What='';
/*$What='{if $oBlog}{assign var="platform2" value=$oBlog->getPlatform()}{else}{assign var="platform2" value= ""}{/if}
<div class="underlinemenu">
		<ul id="mymenu">
			<li id="s1"{if $platform==\'ps3\' || $platform2==\'ps3\'} class="active"{/if}><a href="http://virtualsports.ru/ps3/">Playstation 3</a></li>
			<li id="s2"{if $platform==\'xbox\' || $platform2==\'xbox\'} class="active"{/if}><a href="http://virtualsports.ru/xbox/">Xbox 360</a></li>
			<li id="s3"{if $platform==\'pc\' || $platform2==\'pc\'} class="active"{/if}><a href="http://virtualsports.ru/pc/">PC</a></li>
		</ul>
	</div>
<div id="sublinks" class="underlinemenu2">
	<ul id="s1_m" {if $platform==\'ps3\' || $platform2==\'ps3\'} style="display: block;"{/if}>
';*/
$What.=getmenu(1,'ps3');
/*$What.='
	</ul>
	<ul id="s2_m" {if $platform==\'xbox\' || $platform2==\'xbox\'} style="display: block;"{/if}>';
*/
$What.=getmenu(2,'xbox');
/*$What.='</ul>
	<ul id="s3_m" {if $platform==\'pc\' || $platform2==\'pc\'} style="display: block;"{/if}>';	*/
$What.=getmenu(3,'pc');	
/*$What.='
	</ul>
	
</div>';*/
file_put_contents($sPath,$What);

}
function gen_rasp($tournament_id, $with_your_group, $with_alien_group, $calendar, $parentgroup_id, $group_id, $obratka){
	//include("./config/config.local.php");
$config['db']['params']['host'] = 'localhost';
$config['db']['params']['port'] = '3306';
$config['db']['params']['user'] = 'root';
$config['db']['params']['pass'] = '2840102zZz13';
$config['db']['params']['type']   = 'mysql';
$config['db']['params']['dbname'] = 'db_vs';
$config['db']['table']['prefix'] = 'tis_';
	$db=$config['db']['params']['dbname'];
	$user=$config['db']['params']['user'];
	$pass=$config['db']['params']['pass'];
	$server=$config['db']['params']['host'];
	mysql_connect($server, $user, $pass) or die("Could not connect to MySQL server!");
	@mysql_select_db($db) or die("Could not select company database!");

	
	$query="SELECT * FROM `tis_stat_teamsintournament` where tournament_id='".$tournament_id."' and group_id='".$group_id."' and parentgroup_id='".$parentgroup_id."' ORDER BY team_id";
	$result=mysql_query($query) or die("ERROR3! Cannot execute query");
		$team = array();
		$key=2;
		$i=1;
		while ($row = mysql_fetch_array( $result )) {
				//$team[$i] = $row['team_id'];
				$team[$i] = $row['id'];
				$i++;
		}

//print_r($team);

$all_team = count($team);
$team[$all_team+1]=0; 
$k = $all_team/2;   
$match_num = 1;
$igrovih_dnei = count($calendar);
$matches = array();
//# 1 тур  
 
for($i=1;$i<=$k;$i++)  
{  
	$matches[$match_num-1]['team1']=$team[$i];
	$matches[$match_num-1]['team2']=$team[($all_team-$i+1)];
	$matches[$match_num-1]['date']=$calendar[0];
	$match_num++;
	
	$date_time_array = getdate($calendar[0]);
	$month = $date_time_array['mon'];
	$day = $date_time_array['mday'];
	$year = $date_time_array['year'];
							
							
   // echo $year.'-'.$month.'-'.$day.' '.$team[$i].' - '.$team[($all_team-$i+1)].'</br>';  
}   

for($i=2;$i< $all_team;$i++)  
{  
	//echo $i.' тур ';   
	  
	$team2 = $team[2];   
	  
	for($y=2;$y<= $all_team;$y++)  
	{  
		$team[$y] = $team[$y+1];  
	}  
	$team[$all_team] = $team2;
	
	$date_time_array = getdate($calendar[$i-1]);
	$month = $date_time_array['mon'];
	$day = $date_time_array['mday'];
	$year = $date_time_array['year'];
	
	for($j=1;$j<=$k;$j++)  
	{  
		$igr=0;
		$left=0;
		$right=0;
		$aleft=0;
		$aright=0;
		
		foreach ($matches as $match ) {
			if( $match['team1']==$team[$j] )$left++;
			if( $match['team2']==$team[$j] )$right++;
			
			if( $match['team1']==$team[($all_team-$j+1)] )$aleft++;
			if( $match['team2']==$team[($all_team-$j+1)] )$aright++;						
			
		}
		if($left < $right){
			$matches[$match_num-1]['team1']=$team[$j];
			$matches[$match_num-1]['team2']=$team[($all_team-$j+1)];
		}elseif($left > $right){
			$matches[$match_num-1]['team1']=$team[($all_team-$j+1)];
			$matches[$match_num-1]['team2']=$team[$j];						
		}else{
			if($aleft > $aright){
				$matches[$match_num-1]['team1']=$team[$j];
				$matches[$match_num-1]['team2']=$team[($all_team-$j+1)];
			}else{
				$matches[$match_num-1]['team1']=$team[($all_team-$j+1)];
				$matches[$match_num-1]['team2']=$team[$j];
			}
		}
						
		$matches[$match_num-1]['date']=$calendar[$i-1];
		$match_num++;
		//echo $year.'-'.$month.'-'.$day.' '.$team[$j].' - '.$team[($all_team-$j+1)].'</br>';  
	}   
	
	$calendar[count($calendar)]=DateAdd('w', 1, $calendar[count($calendar)-$igrovih_dnei]);
} 		

if($obratka==1){
	$week_num=$i;
	$day_number=$i;
 
	$day_match=0;
	$den=0;
	for($i=($match_num-1); $i>0; $i--)
	{ 
		$match=$matches[$i-1];
		
		if($i==($match_num-1))$day_match=$match['date'];
		
		if($day_match!=$match['date']){		
			$day_match=$match['date'];
			$day_number++;
		}
		if(!isset($calendar[$day_number]))$calendar[count($calendar)]=DateAdd('w', 1, $calendar[count($calendar)-$igrovih_dnei]);

		
		$date_time_array = getdate($calendar[$day_number-1]);
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];
	
	
		$matches[$match_num-1]['team1']=$match['team2'];
		$matches[$match_num-1]['team2']=$match['team1'];		
		$matches[$match_num-1]['date']=$calendar[$day_number-1];
		
		//print_r($match);
			//echo $match_num.'-'.$match['date'].'-'.$year.'-'.$month.'-'.$day.' '.$matches[$match_num-1]['team1'].' - '.$matches[$match_num-1]['team2'].'</br>';  
		
		$match_num++;
	} 
  
}
	return $matches;
}

function gen_rasp_by_groups($tournament_id, $with_your_group, $with_alien_group, $calendar, $another_group_id, $group_id, $obratka){
	//include("./config/config.local.php");
$config['db']['params']['host'] = 'localhost';
$config['db']['params']['port'] = '3306';
$config['db']['params']['user'] = 'root';
$config['db']['params']['pass'] = '2840102zZz13';
$config['db']['params']['type']   = 'mysql';
$config['db']['params']['dbname'] = 'db_vs';
$config['db']['table']['prefix'] = 'tis_';
	$db=$config['db']['params']['dbname'];
	$user=$config['db']['params']['user'];
	$pass=$config['db']['params']['pass'];
	$server=$config['db']['params']['host'];
	mysql_connect($server, $user, $pass) or die("Could not connect to MySQL server!");
	@mysql_select_db($db) or die("Could not select company database!");

	
	$query="SELECT * FROM `tis_stat_teamsintournament` where tournament_id='".$tournament_id."' and group_id='".$group_id."' ORDER BY team_id";
	$result=mysql_query($query) or die("ERROR3! Cannot execute query");
		$team = array();
		$key=2;
		$i=1;
		while ($row = mysql_fetch_array( $result )) {
				$team[$i] = $row['team_id'];
				$i++;
		}

	$query="SELECT * FROM `tis_stat_teamsintournament` where tournament_id='".$tournament_id."' and group_id='".$another_group_id."' ORDER BY team_id";
	$result=mysql_query($query) or die("ERROR3! Cannot execute query");
		$team0 = array();
		$key=2;
		$i=1;
		while ($row = mysql_fetch_array( $result )) {
				$team0[$i] = $row['team_id'];
				$i++;
		}
		
//print_r($team0);

$all_team = count($team);
$team[$all_team+1]=0; 
$k = $all_team;   //$k = $all_team/2;  
$match_num = 1;
$igrovih_dnei = count($calendar);
$matches = array();
//# 1 тур  
 
for($i=1;$i<=$k;$i++)  
{  
	$matches[$match_num-1]['team1']=$team[$i];
	$matches[$match_num-1]['team2']=$team0[$i];
	$matches[$match_num-1]['date']=$calendar[0];
	$match_num++;
	
	$date_time_array = getdate($calendar[0]);
	$month = $date_time_array['mon'];
	$day = $date_time_array['mday'];
	$year = $date_time_array['year'];
							
							
   // echo $year.'-'.$month.'-'.$day.' '.$team[$i].' - '.$team[($all_team-$i+1)].'</br>';  
}   

for($i=2;$i<= $all_team;$i++)  
{  
	//echo $i.' тур ';   
	  
	$team2 = $team[1];   
	  
	for($y=1;$y< $all_team;$y++)  
	{  
		$team[$y] = $team[$y+1];  
	}  
	$team[$all_team] = $team2;
	
	$date_time_array = getdate($calendar[$i-1]);
	$month = $date_time_array['mon'];
	$day = $date_time_array['mday'];
	$year = $date_time_array['year'];
	
	for($j=1;$j<=$k;$j++)  
	{  
		$igr=0;
		$left=0;
		$right=0;
		$aleft=0;
		$aright=0;
		
		foreach ($matches as $match ) {
			if( $match['team1']==$team[$j] )$left++;
			if( $match['team2']==$team[$j] )$right++;
			
			if( $match['team1']==$team0[$j] )$aleft++;
			if( $match['team2']==$team0[$j] )$aright++;						
			
		}
		if($left < $right){
			$matches[$match_num-1]['team1']=$team[$j];
			$matches[$match_num-1]['team2']=$team0[$j];
		}elseif($left > $right){
			$matches[$match_num-1]['team1']=$team0[$j];
			$matches[$match_num-1]['team2']=$team[$j];						
		}else{
			if($aleft > $aright){
				$matches[$match_num-1]['team1']=$team[$j];
				$matches[$match_num-1]['team2']=$team0[$j];
			}else{
				$matches[$match_num-1]['team1']=$team0[$j];
				$matches[$match_num-1]['team2']=$team[$j];
			}
		}
						
		$matches[$match_num-1]['date']=$calendar[$i-1];
		$match_num++;
		//echo $year.'-'.$month.'-'.$day.' '.$team[$j].' - '.$team[($all_team-$j+1)].'</br>';  
	}   
	
	$calendar[count($calendar)]=DateAdd('w', 1, $calendar[count($calendar)-$igrovih_dnei]);
} 		

if($obratka==1){
	$week_num=$i;
	$day_number=$i;
 
	$day_match=0;
	$den=0;
	for($i=($match_num-1); $i>0; $i--)
	{ 
		$match=$matches[$i-1];
		
		if($i==($match_num-1))$day_match=$match['date'];
		
		if($day_match!=$match['date']){		
			$day_match=$match['date'];
			$day_number++;
		}
		if(!isset($calendar[$day_number]))$calendar[count($calendar)]=DateAdd('w', 1, $calendar[count($calendar)-$igrovih_dnei]);

		
		$date_time_array = getdate($calendar[$day_number-1]);
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];
	
	
		$matches[$match_num-1]['team1']=$match['team2'];
		$matches[$match_num-1]['team2']=$match['team1'];		
		$matches[$match_num-1]['date']=$calendar[$day_number-1];
		
		//print_r($match);
			//echo $match_num.'-'.$match['date'].'-'.$year.'-'.$month.'-'.$day.' '.$matches[$match_num-1]['team1'].' - '.$matches[$match_num-1]['team2'].'</br>';  
		
		$match_num++;
	} 
  
}
	return $matches;
}
?>