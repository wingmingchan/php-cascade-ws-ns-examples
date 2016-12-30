<?php 
/*
This program shows how to set the all level to all sites.
*/
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $sites = $cascade->getSites();
    
    foreach( $sites as $site )
    {
        // setAllLevel( string $type, string $id_path, string $site_name = NULL, 
        // string $level = "none", bool $applied_to_children = false )
        $cascade->setAllLevel(
            a\Folder::TYPE,
            '/', 
            $site->getPathSiteName(),
            c\T::READ, 
            true );
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