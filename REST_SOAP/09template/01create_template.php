<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "about-test";
    $parent_folder_path = "_cascade/template";
    $parent_folder      = $cascade->getAsset(
        a\Folder::TYPE, $parent_folder_path, $site_name );
    $template_name      = "xml";
    $xml = '<system-region name="DEFAULT"/>';
        
    $t = $cascade->getTemplate( "$parent_folder_path/$template_name", $site_name );
    
    if( isset( $t ) )
        $cascade->deleteAsset( $t );
        
    $t = $cascade->createTemplate( $parent_folder, $template_name, $xml );

    u\DebugUtility::dumpRESTCommands( $service );
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