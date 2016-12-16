<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // static methods
    echo a\Format::getFormatType( $service, "9fea17498b7ffe83164c931447df1bfb" );
    $f = a\Format::getFormat( $service, "9fea0fa68b7ffe83164c9314f20b318a" );
    
    echo "getCreatedBy: ", $f->getCreatedBy(), BR,
    	"getCreatedDate: ", $f->getCreatedDate(), BR,
    	"getLastModifiedBy: ", $f->getLastModifiedBy(), BR,
    	"getLastModifiedDate: ", $f->getLastModifiedDate(), BR;

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Format" );
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