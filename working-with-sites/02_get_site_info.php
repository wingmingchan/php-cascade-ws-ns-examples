<?php
$start_time = time();

require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // set parameters for timing: about 25 seconds
    u\DebugUtility::setTimeSpaceLimits();
    
    $site_ids = $cascade->getSites();
    
    foreach( $site_ids as $site_id )
    {
        $site = $cascade->getSite( $site_id->getPathPath() );
        
        echo "Base Folder ID: ", $site->getBaseFolderId(), BR;
        echo "Root Asset Factory Container ID: ",
            $site->getRootAssetFactoryContainerId(), BR;
        
        $afc = $site->getRootAssetFactoryContainer();
        echo "Root Asset Factory Container has ", count( $afc->getChildren() ),
            " child(ren).", BR;
        echo "Root Content Type Container ID: ",
            $site->getRootContentTypeContainerId(), BR;
        echo "Root Destination Container ID: ",
            $site->getRootSiteDestinationContainerId(), BR;
            
        echo HR;
    }
    
    // output the duration taken
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
?>