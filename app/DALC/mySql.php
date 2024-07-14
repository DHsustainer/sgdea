<?
include('configuration.inc.php');
$mngr = "mysql_li";
	switch ($mngr) {
		case 'mysql':
			include(ROOT.DS.'DALC'.DS.'/Con_mySql.php');
			break;
		case 'mysql_li':
			include(ROOT.DS.'DALC'.DS.'/Con_mySql_li.php');
			break;
		default:
			include(ROOT.DS.'DALC'.DS.'/Con_mySql.php');
			break;
	}
?>