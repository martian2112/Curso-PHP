<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

//Constantes Gerais
define('DAILY_TIME', 60*60*8);

// Pastas
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/template'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));

//arquivos
require_once(realpath(dirname(__FILE__) . '/database.php'));
require_once(realpath(dirname(__FILE__) . '/loader.php'));
require_once(realpath(dirname(__FILE__) . '/session.php'));
require_once(realpath(dirname(__FILE__) . '/date_utils.php'));
require_once(realpath(dirname(__FILE__) . '/../models/model.php'));
require_once(realpath(dirname(__FILE__) . '/../models/user.php'));
require_once(realpath(dirname(__FILE__) . '/../exceptions/appexception.php'));
require_once(realpath(dirname(__FILE__) . '/../exceptions/validationexception.php'));
