<?php
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));
CakePlugin::loadAll(array(
    'Admin' => array('routes' => true),
));
$folderName = 'KMVN';
define('Folder',$folderName);
$serverDirectoryPath = $_SERVER['DOCUMENT_ROOT'].'/'.$folderName.'/app/webroot/';
$adminUrl =  "http://".$_SERVER['SERVER_NAME'].'/'.$folderName.'/admin/'; 
$siteUrlfront =  "http://".$_SERVER['SERVER_NAME'].'/'.$folderName.'/'; 
Configure::write('siteUrl',$adminUrl);
Configure::write('siteUrlfront',$siteUrlfront);
Configure::write('RelativeUrl',$serverDirectoryPath.'uploads/');
Configure::write('AbsoluteUrl',$siteUrlfront.'uploads/');
Configure::write('GroupRelativeUrl',$serverDirectoryPath.'uploads/groups/');
Configure::write('GroupAbsoluteUrl',$siteUrlfront.'uploads/groups/');
Configure::write('CollegeRelativeUrl',$serverDirectoryPath.'uploads/colleges/');
Configure::write('CollegeAbsoluteUrl',$siteUrlfront.'/uploads/colleges/');
$semesterArr = ['1'=>'1st Sem','2'=>'2nd Sem','3'=>'3rd Sem','4'=>'4th Sem','5'=>'5th Sem','6'=>'6th Sem'];
Configure::write('Semester',$semesterArr);
$yearArr = ['1'=>'1st Year','2'=>'2nd Year','3'=>'3rd Year','4'=>'4th Year','5'=>'5th Year','6'=>'6th Year'];
Configure::write('Years',$yearArr);
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
CakePlugin::load('MinifyHtml');
 CakePlugin::load('Admin', array('bootstrap' => true, 'routes' => true));
