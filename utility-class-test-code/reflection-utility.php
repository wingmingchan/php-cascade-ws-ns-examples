<?php 
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility", true );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_utility\ReflectionUtility", "showMethodInfo", true );

    u\ReflectionUtility::showMethodReturnType(
        "cascade_ws_utility\ReflectionUtility", "getMethodInfo", true );

    u\ReflectionUtility::showMethodInfo(
        "cascade_ws_utility\ReflectionUtility", "getMethodInfo", true );

    u\ReflectionUtility::showMethodException(
        "cascade_ws_utility\ReflectionUtility", "getMethodInfo", true );

    u\ReflectionUtility::showMethodExample(
        "cascade_ws_utility\ReflectionUtility", "getMethodInfo", true );
   
    u\ReflectionUtility::showMethodDescription(
        "cascade_ws_utility\ReflectionUtility", "getMethodSignature", true );
     
    u\ReflectionUtility::showFunctionSignature( "str_replace", true );

    u\ReflectionUtility::showClassPostscript( "cascade_ws_utility\ReflectionUtility", true );
    
    u\ReflectionUtility::showClassDescription( "cascade_ws_utility\ReflectionUtility", true );
    
    echo u\ReflectionUtility::getNameSpace( "cascade_ws_asset\Page" );

    echo u\ReflectionUtility::getMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility", "getMethodSignature" ), BR;
        
    echo u\ReflectionUtility::getMethodSignatureByName( 
        "cascade_ws_utility\ReflectionUtility", "getMethodSignature" ), BR;
        
    echo u\ReflectionUtility::getMethodSignature( 
        new \ReflectionMethod( "cascade_ws_utility\ReflectionUtility", "getMethodSignature" ) ), BR;

    u\DebugUtility::dump( u\ReflectionUtility::getMethods( $service ) );

    echo u\ReflectionUtility::getMethodInfoByName(
        "cascade_ws_utility\ReflectionUtility", "getMethodInfo" );
        
    echo u\ReflectionUtility::getMethodInfo( 
        new \ReflectionMethod( "cascade_ws_utility\ReflectionUtility", "getMethodInfo" ) );
    
    u\DebugUtility::dump( u\ReflectionUtility::getMethod( $service, "read" ) );

    echo u\ReflectionUtility::getFunctionSignature( new \ReflectionFunction( "str_getcsv" ) );
    
    echo u\ReflectionUtility::getClassPostscript( "cascade_ws_utility\ReflectionUtility", NULL, true );
    
    echo u\ReflectionUtility::getClassName( $service );
    
    echo u\ReflectionUtility::getClassDescription( "cascade_ws_utility\ReflectionUtility", NULL, true );

    echo u\ReflectionUtility::getClassPostScript( "cascade_ws_utility\ReflectionUtility", NULL, true );

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_utility\ReflectionUtility", true );

    //echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Page", true );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
?>