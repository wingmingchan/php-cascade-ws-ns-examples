<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;


/*
array(2) {
  [0]=>
  object(cascade_ws_property\Parameter)#29 (2) {
    ["name":"cascade_ws_property\Parameter":private]=>
    string(54) "assetfactory.plugin.filelimit.param.name.filenameregex"
    ["value":"cascade_ws_property\Parameter":private]=>
    string(38) "[a-zA-Z0-9-_]+((\.jpg)|(\.gif)|(.png))"
  }
  [1]=>
  object(cascade_ws_property\Parameter)#30 (2) {
    ["name":"cascade_ws_property\Parameter":private]=>
    string(45) "assetfactory.plugin.filelimit.param.name.size"
    ["value":"cascade_ws_property\Parameter":private]=>
    string(3) "130"
  }
}
*/
try
{
    $af = $cascade->getAsset(
        a\AssetFactory::TYPE, "1f2179f08b7ffe834c5fe91e7eb59cc8" );
    $plugin = $af->getPlugin( "com.cms.assetfactory.FileLimitPlugin" );
    echo $plugin->getName(), BR;
    u\DebugUtility::dump( $plugin->getParameters() );    
    
    $param_name = "assetfactory.plugin.filelimit" .
        ".param.name.filenameregex";
        
    if( $plugin->hasParameter( $param_name ) )
    {
        $param = $plugin->getParameter( $param_name );
        u\DebugUtility::dump( $param );
    }
    
    $plugin->removeParameter( $param_name );
    u\DebugUtility::dump( $plugin->getParameters() );
    
    $plugin->addParameter( $param->getName(),
        $param->getValue() );
    
    $param_name = "assetfactory.plugin." .
        "filelimit.param.name.size";
    $plugin->setParameterValue( $param_name, "150" );
    u\DebugUtility::dump( $plugin->getParameters() );
    
    $af->edit(); 
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

/*
Useful code templates:
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility" );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_asset\Page", "edit" );
        
    u\ReflectionUtility::showMethodDescription( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\DebugUtility::dump( $page );
    u\DebugUtility::out( "Hello" );
    
    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>