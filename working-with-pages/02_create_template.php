<?php
/*
This program creates a template.
*/

require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // site name
    $site_name            = "wing ming.chan";
    // name of the template
    $template_name        = "xml";
    // name of the parent folder
    $template_folder_name = "templates";
    
    // try to retrieve the template
    $t = $admin->getTemplate( "$template_folder_name/$template_name", $site_name );
    
    // create the template only if it does not exist
    if( is_null( $t ) )
    {
        // get parent folder
        $t_container =
            $admin->getAsset(
                a\Folder::TYPE, $template_folder_name, $site_name );
        $t = $admin->createTemplate(
            $t_container,      // parent Folder
            $template_name,
            "<system-region name=\"DEFAULT\"/>"
        );
    }
    $t->dump();  
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