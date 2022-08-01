<?php
/**
 * Based off the examples in samples-generator.php, this script has successfully
 * replaced to the generated classes that we initially got from
 * www.wsdltophp.com (which doesn't seem to work anymore).
 *
 * @date 01/08/2022
 */

ini_set('display_errors',true);
error_reporting(-1);
ini_set('memory_limit',-1);

/**
 * In case function lcfirst doesn't exist
 */
if(!function_exists('lcfirst'))
{
    function lcfirst($_s)
    {
        return strtolower(substr($_s,0,1)) . substr($_s,1);
    }
}

/**
 * Librairies
 */
$localDir = dirname(__FILE__) . '/';
require_once $localDir . 'WsdlToPhpModel.php';
require_once $localDir . 'WsdlToPhpStruct.php';
require_once $localDir . 'WsdlToPhpService.php';
require_once $localDir . 'WsdlToPhpFunction.php';
require_once $localDir . 'WsdlToPhpGenerator.php';
require_once $localDir . 'WsdlToPhpStructValue.php';
require_once $localDir . 'WsdlToPhpStructAttribute.php';

$name = 'OnBase';
$wsdl = 'http://processing.smartchoiceconnection.com/SmartChoiceConnectionServiceV3/SmartChoiceService.svc?wsdl';
exec('rm -rf ' . __DIR__ . '/samples/' . $name . '/*;');
echo "\r\nStart at " . date('H:i:s');
$w = new WsdlToPhpGenerator($wsdl);

WsdlToPhpGenerator::setOptionGenerateAutoloadFile(true); // TRUE
WsdlToPhpGenerator::setOptionGenerateTutorialFile(true); // TRUE
WsdlToPhpGenerator::setOptionGenerateWsdlClassFile(true); // TRUE

WsdlToPhpGenerator::setOptionAddComments(array(
    'date'=>date('Y-m-d'),
    'author'=>'WsdlToPhp',
    'version'=>'2.1.0')
);
echo "\r\nStart generation at " . date('H:i:s');
$w->generateClasses($name,dirname(__FILE__) . '/samples/' . $name . '/');
echo "\r\nEnd generation at " . date('H:i:s');
echo "\r\nGenerate doc start " . date('H:i:s');
$ouputs = array();
exec('rm -rf ' . __DIR__ . '/docs/' . $name . '/* && clear && phpdoc --sourcecode on -d ' . __DIR__ . '/samples/' . $name . ' -t ' . __DIR__ . '/docs/' . $name . ' -pp -ti "' . ucfirst($name) . ' package documentation" -o HTML:frames:DOM/earthli;',$ouputs);
print_r($ouputs);
echo "\r\nGenerate doc end " . date('H:i:s');
