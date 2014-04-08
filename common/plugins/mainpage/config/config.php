<?php
/*---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Project URI: http://altocms.com
 * @Description: Advanced Community Engine
 * @Version: 0.9a
 * @Copyright: Alto CMS Team
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */

$config=array();
Config::Set('router.page.mainpage', 'PluginMainpage_ActionMainpage');


$config['topic_per_category_popular']='3';
$config['topic_per_category_new']='6';
 
 
// Прямой эфир
$config['widgets'][] = array(
    'name' => 'stream',     // исполняемый виджет Stream
    'group' => 'right',     // группа, куда нужно добавить виджет
    'priority' => 100,      // приоритет
    'action' => array(
        'index',
        'filter',
        'blogs',
        'blog' => array('{topics}', '{topic}', '{blog}'),
        'tag',
		'mainpage',
		'category',
		'tournament',
    ),
    'title' => 'Прямой эфир',
);

// Теги
/*
$config['widgets'][] = array(
    'name' => 'tags',
    'group' => 'right',
    'priority' => 50,
    'action' => array(
        'index',
        'filter',
        'blog' => array('{topics}', '{topic}', '{blog}'),
        'tag',
		'mainpage',
    ),
);
*/

// Блоги
$config['widgets'][] = array(
    'name' => 'blogs',
    'group' => 'right',
    'priority' => 1,
    'action' => array(
        'mainpage','index', 'filter', 'blog' => array('{topics}', '{topic}', '{blog}')
    ),
);

$config['widgets'][] = array(
    'name' => 'mainpage',
    'group' => 'main',
    'priority' => 140,
	'params'=>array('plugin'=>'mainpage'),
    'action' => array(
		'mainpage',
    ),
);
$config['widgets'][] = array(
    'name' => 'slider',
    'group' => 'main',
    'priority' => 150,
	'params'=>array('plugin'=>'mainpage'),
    'action' => array(
		'mainpage',
    ),
);
$config['widgets'][] = array(
    'name' => 'rightslider',
    'group' => 'right',
    'priority' => 150,
	'params'=>array('plugin'=>'mainpage'),
    'action' => array(
		'mainpage',
    ),
);

$config['widgets'][] = array(
    'name' => 'tournamentmenu',
    'group' => 'main',
    'priority' => 150,
	'params'=>array('plugin'=>'vs'),
    'action' => array(
		'turnir',
    ),
);
return $config;


// EOF