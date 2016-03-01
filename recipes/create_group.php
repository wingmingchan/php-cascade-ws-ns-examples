<?php 
require_once('cascade_ws_ns/auth_wing.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$group_name     = "web-service-tutorial-group";
	$site_role_name = "Site Test Role";
	
    if( is_null( $cascade->getGroup( $group_name ) ) && $cascade->hasRoleName( $site_role_name ) )
    {
        $cascade->createGroup( $group_name, $site_role_name );
        echo "The group $group_name has been created.";
    }
    else
    {
        echo "The group $group_name already exists.";
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>