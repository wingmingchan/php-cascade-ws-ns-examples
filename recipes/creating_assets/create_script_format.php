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
    $site_name     = "web-service-tutorial";
    $parent_folder = $cascade->getAsset( a\Folder::TYPE, 'formats', $site_name );
    
    $script_format_name = 'global-information';
    $script_format      = $cascade->getScriptFormat( 'formats/' . $script_format_name, $site_name );

    if( is_null( $script_format ) )
    {
        $cascade->createScriptFormat(
            $parent_folder,
            $script_format_name,
            "##"
        );
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>