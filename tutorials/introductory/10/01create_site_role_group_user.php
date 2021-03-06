<?php
require_once( 'auth_REST_SOAP.php' );
    
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // step 1: create a site
    $site_name = 'web-service-test';
    $url       = 'web.upstate.edu/web-service-test';
    $new_site  = $cascade->createSite( 
        $site_name,
        $url,
        c\T::FIFTEEN // expiration
    );
   
    // step 2: create a site role
    $role_name  = 'Site Test Role';
    $cascade->createRole( $role_name, a\Site::TYPE );

    // step 3: create a group
    $group_name = 'web-service-test-group';
    
    if( $cascade->hasRoleName( $role_name ) )
    {
        $new_group = $cascade->createGroup( $group_name, $role_name );
    }
    // step 4: create a user
    $username    = 'web-service-test-user';
    $password    = 'testing';
    $global_role = 'Default';
    
    $cascade->
        createUser(
            $username,
            $password,
            $new_group,
            $cascade->getRoleAssetByName( $global_role ) // must be a global role
        )->
        enable()->
        setDefaultSite( $new_site );
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