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
    require_once( "get_rwd4_sites.php" );
    
    u\DebugUtility::setTimeSpaceLimits();
    
    // Default in _brisk
    $brisk_default_ms = $cascade->getAsset( a\MetadataSet::TYPE, $brisk_default_ms_id );
    
    // all rwd4 sites should have this ms as the default
    foreach( $rwd4_site_ids as $rwd4_site_id )
    {
        $site = $rwd4_site_id->getAsset( $service );
        
        if( $site->getDefaultMetadataSetId() != $brisk_default_ms_id )
        {
            $site->setDefaultMetadataSet( $brisk_default_ms )->edit();
            echo $site->getName(), BR;
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