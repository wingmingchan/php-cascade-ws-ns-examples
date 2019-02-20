<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // the block to be copy
    $block_id = $service->createId(
        a\DataBlock::TYPE, "_cascade/blocks/code/test-velocity", "formats" );

    // the parent folder where the new block should be placed
    $parent_id = $service->createId(
        a\Folder::TYPE, "_cascade/blocks/code", "formats" );
    
    // new name for the copy
    $new_name = "another-velocity-block";
    
    // no workflow
    $do_workflow = false;
         
    $service->copy( $block_id, $parent_id, $new_name, $do_workflow );

    if( $service->isSuccessful() )
        echo "Copied successfully";
    else
        echo "Failed to copy. ", $service->getMessage();
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