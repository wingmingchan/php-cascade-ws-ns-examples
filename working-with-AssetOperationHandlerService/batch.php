<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$paths = array( 
             "/_cascade/blocks/code/test-include-page-text", 
             "/_cascade/blocks/code/test-text" );

$operations = array();

foreach( $paths as $path )
{
    $id        = $service->createId( a\TextBlock::TYPE, $path, "formats" );
    $operation = new \stdClass();
    $read_op   = new \stdClass();
    
    $read_op->identifier = $id;
    $operation->read     = $read_op;
    $operations[]        = $operation;
}

try
{
    $service->batch( $operations );
    u\DebugUtility::dump( $service->getReply()->batchReturn );
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}
?>