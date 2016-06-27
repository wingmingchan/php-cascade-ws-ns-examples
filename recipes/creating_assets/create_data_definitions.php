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
    $site_name         = 'web-service-tutorial';
    $dd_container_name = 'Test Data Definition Container';
    $dd_container      = $cascade->getDataDefinitionContainer( $dd_container_name, $site_name );

    if( is_null( $dd_container ) )
    {
        // create data definition  container
        $dd_container = $cascade->createDataDefinitionContainer(
            $cascade->getAsset( 
                a\DataDefinitionContainer::TYPE, '/', $site_name ),
            $dd_container_name
        );
    }
    
    $dd_name = 'Page';
    $dd      = $cascade->getDataDefinition( $dd_container_name . '/' . $dd_name, $site_name );

    $xml = 
"<system-data-structure>
<text wysiwyg=\"true\" identifier=\"wysiwyg-content\" 
label=\"Content\"/>
</system-data-structure>";

    if( is_null( $dd ) )
    {
        // create a data definition for pages
        $cascade->createDataDefinition(
            $dd_container,
            $dd_name,
            $xml );
    }

    $dd_name = 'Simple Text';
    $dd      = $cascade->getDataDefinition( $dd_container_name . '/' . $dd_name, $site_name );

    $xml = 
"<system-data-structure>
<text identifier=\"text\"/>
</system-data-structure>";

    if( is_null( $dd ) )
    {
        // create a data definition for blocks
        $cascade->createDataDefinition(
            $dd_container,
            $dd_name,
            $xml );
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>