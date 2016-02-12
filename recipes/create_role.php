<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $global_role_name = 'Site-Contributor';
    $site_role_name   = 'Site Test Role';
    
    try
    {
        $cascade->getRoleByName( $global_role_name );
        echo "The role $global_role_name already exists.", BR;
    }
    catch( e\NullAssetException $e )
    {
        $cascade->createRole( $global_role_name, "global" );
        echo "The role $global_role_name has been created.", BR;
    }
    
    try
    {
        $cascade->getRoleByName( $site_role_name );
        echo "The role $site_role_name already exists.", BR;
    }
    catch( e\NullAssetException $e )
    {
        $cascade->createRole( $site_role_name, a\Site::TYPE );
        echo "The role $site_role_name has been created.", BR;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>