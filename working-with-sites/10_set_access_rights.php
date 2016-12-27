<?php
require_once( 'admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-database";

    // call global admin function to set access rights
    setAccessRightsForAsset(
        // the Cascade object
        $cascade,
        // the folder we are granting access to
        a\Folder::TYPE, "/", $site_name,
        // the user with write access
        a\User::TYPE, "thomaspe", c\T::WRITE,
        // applied to children and all level
        true, c\T::NONE );
        
    setAccessRightsForAsset(
        // the Cascade object
        $cascade,
        // the block we are granting access to
        a\IndexBlock::TYPE, "_cascade/blocks/index/top-site-menu", $site_name,
        // the group with read access
        a\Group::TYPE, "CWT-Designers", c\T::READ );
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