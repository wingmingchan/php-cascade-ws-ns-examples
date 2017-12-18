<?php
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    require_once( "brisk_info.php" );
    u\DebugUtility::setTimeSpaceLimits();
    
    $rwd4_site_ids = array();
    $site_ids      = $cascade->getSites();
    
    foreach( $site_ids as $site_id )
    {
        $index_page = $cascade->getPage( "index", $site_id->getPathPath() );
        
        // rwd4Tree site
        if( !is_null( $index_page ) && 
            $index_page->getContentTypeId() == $brisk_page_ct_id )
        {
            $rwd4_site_ids[] = $site_id;
        }
    }
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