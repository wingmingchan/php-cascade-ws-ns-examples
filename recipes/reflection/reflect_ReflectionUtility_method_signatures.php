<?php
/*
This program is used to generate the method signatures of a certain class.
To generate the output for PHP 7, the source code must be written in PHP 7,
with param types and return types.
*/

require_once('auth_tutorial.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\ReflectionUtility::showMethodSignatures( "cascade_ws_utility\ReflectionUtility" );
    
/*  outputs (PHP 5):

<ul>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getClassDocumentation( $obj )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getClassInfo( $obj,  $r = NULL )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getClassName( $obj )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getFunctionSignature( $function )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethod( $obj,  $method_name )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethodInfo( $method )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethodInfoByName( $obj,  $method_name )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethods( $obj )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethodSignature( $method )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethodSignatureByName( $obj,  $method_name )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::getMethodSignatures( $obj )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showClassInfo( $obj )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showFunctionSignature( $function_name,  $with_hr = false )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showMethodDescription( $obj,  $method_name,  $with_hr = false )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showMethodExample( $obj,  $method_name,  $with_hr = false )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showMethodReturnType( $obj, $method_name, $with_hr = false )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showMethodInfo( $obj,  $method_name,  $with_hr = false )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showMethodSignatures( $obj,  $with_hr = false )</code></li>
<li>
<code>public static cascade_ws_utility\ReflectionUtility::showMethodSignature( $obj,  $method_name,  $with_hr = false )</code></li>
</ul>

(PHP 7)
<ul>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getClassDocumentation( $obj )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getClassInfo( $obj, ReflectionClass $r = NULL )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getClassName( $obj )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getFunctionSignature( ReflectionFunction $function )</code></li>
<li>
<code>public static ReflectionMethod cascade_ws_utility\ReflectionUtility::getMethod( $obj, string $method_name )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getMethodInfo( ReflectionMethod $method )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getMethodInfoByName( $obj, string $method_name )</code></li>
<li>
<code>public static array cascade_ws_utility\ReflectionUtility::getMethods( $obj )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getMethodSignature( ReflectionMethod $method )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getMethodSignatureByName( $obj, string $method_name )</code></li>
<li>
<code>public static string cascade_ws_utility\ReflectionUtility::getMethodSignatures( $obj )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showClassInfo( $obj )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showFunctionSignature( string $function_name, bool $with_hr = false )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showMethodDescription( $obj, string $method_name, bool $with_hr = false )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showMethodExample( $obj, string $method_name, bool $with_hr = false )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showMethodReturnType( $obj, $method_name, $with_hr = false )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showMethodInfo( $obj, string $method_name, bool $with_hr = false )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showMethodSignatures( $obj, bool $with_hr = false )</code></li>
<li>
<code>public static void cascade_ws_utility\ReflectionUtility::showMethodSignature( $obj, string $method_name, bool $with_hr = false )</code></li>
</ul>
*/
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>