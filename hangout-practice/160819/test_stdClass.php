<?php
/*
require_once('auth_tutorial.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
*/
echo "hello";
$obj = new stdClass();
$obj->name = "Upstate";
$array = array( 1, 2 );

modifyObject($obj );
modifyArray( $array );

var_dump( $obj );
var_dump( $array );

function modifyObject( $obj )
{
	$obj->name = "medical";
}

function modifyArray( $array )
{
	$array[ 0 ] = 100;
}

?>