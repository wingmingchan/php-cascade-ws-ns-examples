<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$paths      = array( 
                 "/_cascade/blocks/code/text-block", 
                 "_cascade/blocks/code/ajax-read-profile-php" );

$operations = array();

foreach( $paths as $path )
{
    $id        = $service->createId( a\TextBlock::TYPE, $path, "cascade-admin" );
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
    echo $e;
}
?>