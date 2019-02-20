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
    $site_name   = "cascade-admin";
    $block_id    = $service->createId( 
                     a\DataBlock::TYPE, "_cascade/blocks/test/multiple-linkables-test", $site_name );
    $parent_id   = $service->createId( 
                     a\Folder::TYPE, "_cascade/blocks", $site_name );
    $new_name    = 'my-new-dd-block';
    $do_workflow = false;
    
    $service->move( $block_id, $parent_id, $new_name, $do_workflow );

    if( $service->isSuccessful() )
        echo "Moved successfully";
    else
        echo "Failed to move. " . $service->getMessage();
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