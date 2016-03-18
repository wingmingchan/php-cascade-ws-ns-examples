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
    $parent_folder = $cascade->getAsset( a\Folder::TYPE, 'templates', $site_name );
    $template_name = 'three-columns';
    $template      = $cascade->getTemplate( 'templates/' . $template_name, $site_name );
    
    if( is_null( $template ) )
    {
        // create desktop template
        $cascade->createTemplate(
            $parent_folder,
            $template_name,
            "<html/>"
        );
    }    
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>