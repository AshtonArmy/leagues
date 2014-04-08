<?php
 
/**
 * Конфиг
 */

// Переопределить имеющуюся переменную в конфиге:
// Config::Set('router.page.somepage', 'PluginAbcplugin_ActionSomepage'); // Переопределение роутера на наш новый Action - добавляем свой урл  http://domain.com/somepage

// Добавить новую переменную:
// $config['per_page'] = 15;
// Эта переменная будет доступна в плагине как Config::Get('plugin.abcplugin.per_page')
 
Config::Set('router.page.turnir', 'PluginVs_ActionVs');
Config::Set('router.page.tournament', 'PluginVs_ActionTournament');
//Config::Set('router.page.miniturnir', 'PluginVs_ActionMiniTurnir');
Config::Set('router.page.teams', 'PluginVs_ActionTeams');
Config::Set('router.page.team', 'PluginVs_ActionTeam');
Config::Set('router.page.rating', 'PluginVs_ActionRating');
Config::Set('router.page.liga', 'PluginVs_ActionLiga');
Config::Set('router.page.league', 'PluginVs_ActionLeague');

Config::Set('router.page.game', 'PluginVs_ActionGame');
Config::Set('router.page.players', 'PluginVs_ActionPlayers');

Config::Set('router.page.rules', 'PluginVs_ActionRules');
//Config::Set('router.page.mainpage', 'PluginVs_ActionMainpage');

Config::Set('path.images.tournament', 'images/tournament');
Config::Set('path.images.league', 'images/league');
Config::Set('path.images.blog', 'images/blog');
Config::Set('path.images.teams', 'images/teams');

$config['dbconfig']['host'] = 'localhost';
$config['dbconfig']['port'] = '3306';
$config['dbconfig']['user'] = 'root';
$config['dbconfig']['pass'] = '2840102zZz13';
$config['dbconfig']['type']   = 'mysql';
$config['dbconfig']['dbname'] = 'wp';

$config['check_url'] = false;
Config::Set('block.rule_vs', array(
	'action'  => array('turnir',  'game', 'tournament','league'),
	'blocks'  => array(
			'right' => array('streammy' => array('priority'=>100,'params'=>array('plugin'=>'vs', 'stream_count'=>15)),/*'topten'=>array('priority'=>51),'toptenpcfifa'=>array('priority'=>49),'toptenps3fifa'=>array('priority'=>48),'tags'=>array('priority'=>40),'blogs'=>array('params'=>array(),'priority'=>1)*/)
		),
	'clear' => false,
	));
/*
Config::Set('block.rule_vs_mainpage', array(
    'action'  => array('mainpage'),
    'blocks'  => array(
        'matches' => array(
            'indexmatches' => array('priority'=>202,'params'=>array('plugin'=>'vs'))
        ),
        'videolist' => array(
            'indexvideo' => array('priority'=>202,'params'=>array('plugin'=>'vs'))
        ),
        'newslist' => array(
            'indexnews' => array('priority'=>202,'params'=>array('plugin'=>'vs'))
        ),
        'advertlist' => array(
            'indexadvert' => array('priority'=>202,'params'=>array('plugin'=>'vs'))
        ),
        'stream' => array(
			 'streammy' => array('priority'=>202,'params'=>array('plugin'=>'vs', 'stream_count'=>9))
           // 'stream' => array('priority'=>202)
        ),
    ),
    'clear' => false,
));

$config['teamplay_team_blogs']= array( 'sinisterotters','traktor', 'nbf', 
										'fireplay', 'skafromneva','hcbidon',
										'predatorypanthers','frostbolt','russia',
										'redrabbits','mightyrangers','pms',
										'longway','hcsokol',
										
										'rwb','russianrocketsdtm','hcmeteor','rrl','blg','kgb','edelweiss');

$config['ligi']= array( 'vs-crazy-cup' );	
*/	

if(Config::Get('sys.site')=='vs')$file = '/www/virtualsports.ru/plugins/vs/config/teams.ttp';
if(Config::Get('sys.site')=='ch')$file = '/www/consolehockey.com/plugins/vs/config/teams.ttp';
				
//$file = '/www/consolehockey.com/plugins/vs/config/teams.ttp';
if (file_exists($file)) { 
    $fp = fopen($file,'r');
	$text = fread($fp,filesize($file));
	fclose($fp);
	$config['teamplay_team_blogs'] = explode(",", $text);
	
}
if(Config::Get('sys.site')=='vs')$file = '/www/virtualsports.ru/plugins/vs/config/leagues.ttp';
if(Config::Get('sys.site')=='ch')$file = '/www/consolehockey.com/plugins/vs/config/leagues.ttp';
//$file = '/www/consolehockey.com/plugins/vs/config/leagues.ttp';
if (file_exists($file)) { 

    $fp = fopen($file,'r');
	$text = fread($fp,filesize($file));
	fclose($fp);
	$config['league_blogs'] = explode(",", $text);
}
	
$config['teamplay_hockey_field']= array(  
	array(
		'name' => 'Anaheim Ducks',
		'img' => 'ana.png',
	),
	array(
		'name' => 'Boston Bruins',
		'img' => 'bos.png',
	),
	array(
		'name' => 'Buffalo Sabres',
		'img' => 'buf.png',
	),
	array(
		'name' => 'Calgary Flames',
		'img' => 'cal.png',
	),
	array(
		'name' => 'Carolina Hurricanes',
		'img' => 'car.png',
	),
	array(
		'name' => 'Chicago Blackhawks',
		'img' => 'chi.png',
	),
	array(
		'name' => 'Colorado Avalanche',
		'img' => 'col.png',
	),
	array(
		'name' => 'Columbus Blue Jacket',
		'img' => 'clm.png',
	),
	array(
		'name' => 'Dallas Stars',
		'img' => 'dal.png',
	),
	array(
		'name' => 'Detroit Red Wings',
		'img' => 'det.png',
	),
	array(
		'name' => 'Edmonton Oilers',
		'img' => 'edm.png',
	),
	array(
		'name' => 'Florida Panthers',
		'img' => 'flo.png',
	),
	array(
		'name' => 'Los Angeles Kings',
		'img' => 'los.png',
	),
	array(
		'name' => 'Minnesota Wild',
		'img' => 'min.png',
	),
	array(
		'name' => 'Montreal Canadiens',
		'img' => 'mtl.png',
	),
	array(
		'name' => 'Nashville Predators',
		'img' => 'nsh.png',
	),
	array(
		'name' => 'New Jersey Devils',
		'img' => 'njd.png',
	),
	array(
		'name' => 'New York Islanders',
		'img' => 'nyi.png',
	),
	array(
		'name' => 'New York Rangers',
		'img' => 'nyr.png',
	),
	array(
		'name' => 'Ottawa Senators',
		'img' => 'otw.png',
	),
	array(
		'name' => 'Philadelphia Flyers',
		'img' => 'phi.png',
	),
	array(
		'name' => 'Phoenix Coyotes',
		'img' => 'phx.png',
	),
	array(
		'name' => 'Pittsburgh Penguins',
		'img' => 'pit.png',
	),
	array(
		'name' => 'San Jose Sharks',
		'img' => 'sjs.png',
	),
	array(
		'name' => 'St. Louis Blues',
		'img' => 'stl.png',
	),
	array(
		'name' => 'Tampa Bay Lightning',
		'img' => 'tmp.png',
	),
	array(
		'name' => 'Toronto Maple Leafs',
		'img' => 'tor.png',
	),
	array(
		'name' => 'Vancouver Canucks',
		'img' => 'van.png',
	),
	array(
		'name' => 'Washington Capitals',
		'img' => 'wsh.png',
	),
	array(
		'name' => 'Winnipeg Jets',
		'img' => 'win.png',
	),
);
$config['teamplay_nhl']= array(  
						array(
							'name' => 'Левый нап',
							'brief' => 'LW',
							'num' => '1',
							'params' => array(
											'shots' => 'shots',
											'penalty' => 'Penalty minutes',
											'hits' => 'hits',
										),
						),
						array(
							'name' => 'Центр',
							'brief' => 'C',
							'num' => '2',
							'params' => array(
											'shots' => 'shots',
											'penalty' => 'Penalty minutes',
											'hits' => 'hits',
										),
						),
						array(
							'name' => 'Правый нап',
							'brief' => 'RW',
							'num' => '3',
							'params' => array(
											'shots' => 'shots',
											'penalty' => 'Penalty minutes',
											'hits' => 'hits',
										),
						),
						array(
							'name' => 'Левый нап',
							'brief' => 'LD',
							'num' => '4',
							'params' => array(
											'shots' => 'shots',
											'penalty' => 'Penalty minutes',
											'hits' => 'hits',
										),
						),
						array(
							'name' => 'Левый нап',
							'brief' => 'RD',
							'num' => '5',
							'params' => array(
											'shots' => 'shots',
											'penalty' => 'Penalty minutes',
											'hits' => 'hits',
										),
						),
						array(
							'name' => 'Компьютер',
							'brief' => 'Bot',
							'num' => '6',
							'params' => array(
											'shots' => 'shots',
											'penalty' => 'Penalty minutes',
											'hits' => 'hits',
										),
						),
						array(
							'name' => 'Вратарь',
							'brief' => 'G',
							'num' => '7',
							'params' => array( 
											'penalty' => 'Penalty minutes', 
										),
						),
					);	
//define('ROUTE_PAGE_VS', 'Vs');


$params = array (
				'#container' => array(
									array( 
										'name' => 'Фон по центру',
										'text' => 'background',
										'type' => 'color',
										'default' => '#FFFFFF'
										),
									),
				'.navbar .navbar-inner.custom' => array(
									array( 
										'name' => 'Цвет верхней панели',
										'text' => 'background',
										'type' => 'color',
										'default' => '#43967d'
										),
									),
				'.ace-nav > li.custom-games' => array(
									array( 
										'name' => 'Кнопка игр',
										'text' => 'background:',
										'type' => 'color',
										'default' => '#9dcf5c'
										),
									),
				'.ace-nav > li.custom-alert' => array(
									array( 
										'name' => 'Кнопка уведомлений',
										'text' => 'background:',
										'type' => 'color',
										'default' => '#c15683'
										),
									),
				'.ace-nav > li.custom-talk' => array(
									array( 
										'name' => 'Кнопка сообщений',
										'text' => 'background:',
										'type' => 'color',
										'default' => '#e39165'
										),
									),
				'.ace-nav > li.custom-profile' => array(
									array( 
										'name' => 'Кнопка профиля',
										'text' => 'background:',
										'type' => 'color',
										'default' => '#3f665a'
										),
									),
				'a' => array(
									array( 
										'name' => 'Цвет ссылок',
										'text' => 'color:',
										'type' => 'color',
										'default' => '#3f665a'
										),
									),
				'a:hover, a:focus' => array(
									array( 
										'name' => 'Цвет ссылок при наведении',
										'text' => 'color:',
										'type' => 'color',
										'default' => '#0d533e'
										),
									),
				'#nav-search-input.custom' => array(
									array( 
										'name' => 'Рамка поиска',
										'text' => 'border-color:',
										'type' => 'color',
										'default' => '#6fb3e0'
										),
									),
				'#breadcrumbs.custom' => array(
									array( 
										'name' => 'Рамка хлебных крошек',
										'text' => 'border-bottom: 1px solid ',
										'type' => 'color',
										'default' => '#e5e5e5'
										),
									array( 
										'name' => 'Фон хлебных крошек',
										'text' => 'background-color:',
										'type' => 'color',
										'default' => '#f5f5f5'
										),
									)
									
					);
return $config;
