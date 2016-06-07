<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_ids = $cascade->getSites();
    
    foreach( $site_ids as $site_id )
    {
        echo "Site name: ", $site_id->getPathPath(), BR;
        
        $site = $cascade->getSite( $site_id->getPathPath() );
        
        echo "Base Folder ID: ", $site->getBaseFolderId(), BR;
        echo "Root Asset Factory Container ID: ", $site->getRootAssetFactoryContainerId(), BR;
        
        $afc = $site->getRootAssetFactoryContainer();
        echo "Root Asset Factory Container has ", count( $afc->getChildren() ), " child(ren).", BR;
        
        echo "Root Content Type Container ID: ", $site->getRootContentTypeContainerId(), BR;
        echo "Root Destination Container ID: ", $site->getRootSiteDestinationContainerId(), BR;
        echo HR;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>