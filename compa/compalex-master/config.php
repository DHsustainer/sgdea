<?php

define('DIR_ROOT', dirname(__FILE__));
define('ENVIRONMENT_FILE', DIR_ROOT . '/.environment');
define('DRIVER_DIR', DIR_ROOT . '/driver/');
define('TEMPLATE_DIR', DIR_ROOT . '/template/');

if (!file_exists(ENVIRONMENT_FILE)) die('File "' . ENVIRONMENT_FILE . '" not exist. Please create file.');
$params = parse_ini_file(ENVIRONMENT_FILE);


$requiredParams = array(
    'DATABASE_DRIVER',
    'DATABASE_ENCODING',
    'SAMPLE_DATA_LENGTH',
    'DATABASE_HOST',
    'DATABASE_PORT',
    'DATABASE_NAME',
    'DATABASE_USER',
    'DATABASE_PASSWORD',
    'DATABASE_DESCRIPTION',
    'DATABASE_HOST_SECONDARY',
    'DATABASE_PORT_SECONDARY',
    'DATABASE_NAME_SECONDARY',
    'DATABASE_USER_SECONDARY',
    'DATABASE_PASSWORD_SECONDARY',
    'DATABASE_DESCRIPTION_SECONDARY',
);

#[ Main settings ]
#; Possible DATABASE_DRIVER: 'mysql', 'pgsql', 'dblib'.
#; Please use 'dblib' for Microsoft SQL Server
define('DATABASE_DRIVER', 'mysql'); 
define('DATABASE_ENCODING', 'utf8'); 
define('SAMPLE_DATA_LENGTH', '100'); 

#[ Primary connection params ]
define('DATABASE_HOST', 'localhost'); 
define('DATABASE_PORT', '3306'); 
define('DATABASE_NAME', 'pdicolom_werxcs'); 
define('DATABASE_USER', 'pdicolom_usercompare'); 
define('DATABASE_PASSWORD', 'f87NWx%GR??W'); 
define('DATABASE_DESCRIPTION', 'Developer database'); 

#[ Secondary connection params ]
define('DATABASE_HOST_SECONDARY', 'localhost'); 
define('DATABASE_PORT_SECONDARY', '3306'); 
define('DATABASE_NAME_SECONDARY', 'pdicolom_demo'); 
define('DATABASE_USER_SECONDARY', 'pdicolom_usercompare'); 
define('DATABASE_PASSWORD_SECONDARY', 'f87NWx%GR??W'); 
define('DATABASE_DESCRIPTION_SECONDARY', 'Production database'); 


define('FIRST_DSN',  DATABASE_DRIVER.'://'.DATABASE_USER.':'.DATABASE_PASSWORD.'@'.DATABASE_HOST.':'.DATABASE_PORT.'/'.DATABASE_NAME);
define('SECOND_DSN',  DATABASE_DRIVER.'://'.DATABASE_USER_SECONDARY.':'.DATABASE_PASSWORD_SECONDARY.'@'.DATABASE_HOST_SECONDARY.':'.DATABASE_PORT_SECONDARY.'/'.DATABASE_NAME_SECONDARY);