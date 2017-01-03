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
    $site_name         = 'web-service-tutorial';
    $global_role_name  = 'Manager';
    $site_role_name    = 'Site Test Role';
    $group_name        = 'web-service-tutorial-group';
    $username          = 'web-service-tutorial-user';
    $password          = '1234';
    
    if( is_null( $cascade->getUser( $username ) ) )
    {
        $site        = $cascade->getAsset( a\Site::TYPE, $site_name );
        $group       = $cascade->getAsset( a\Group::TYPE, $group_name );
        $global_role = $cascade->getRoleAssetByName( $global_role_name );
        
        $cascade->
            createUser(
                $username,
                $password,
                $group,
                $global_role
            )->
            enable()->
            setDefaultGroup( $group )->
            setDefaultSite( $site );                
        echo "The user $username has been created.";
    }
    else
    {
        echo "The user $username already exists.";
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