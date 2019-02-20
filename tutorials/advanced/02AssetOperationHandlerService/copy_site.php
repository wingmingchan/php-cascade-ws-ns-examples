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
    $seed_site_id   = "a0d0fb818b7f08ee0990fe6e89648961";
    $seed_site_name = "_rwd_seed";
    $new_site_name  = "access-test";
    
    $service->siteCopy( $seed_site_id, $seed_site_name, $new_site_name );
    
    if( $service->isSuccessful() )
        echo "Site copied successfully";
    else
        echo "Failed to copy site. " . $service->getMessage();
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