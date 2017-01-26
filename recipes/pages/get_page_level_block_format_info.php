<?php
/*
This program shows how to retrieve information regarding blocks and formats
attached to regions at the page level.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-admin-old";
    $page_name = "test/new-page";
    $page      = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    
    $page_config = $cascade->getAsset( 
        a\PageConfigurationSet::TYPE, '78df95d48b7f0856004564245d94c971' )->
        getConfiguration( 'RWD' );
        
    $block_format_info = $page->getBlockFormatMap( $page_config );
    
    u\DebugUtility::dump( $block_format_info );
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