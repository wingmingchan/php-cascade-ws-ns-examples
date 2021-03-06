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
    $site_name         = 'web-service-test';
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
    
    $sf_path = "Test Shared Field Container/WYSIWYG";
    $sf      = $cascade->getAsset( a\SharedField::TYPE, $sf_path, $site_name );
    $sf_id   = $sf->getId();
    $dd_name = 'WYSIWYG';
    $dd      = $cascade->getDataDefinition( $dd_container_name . '/' . $dd_name, $site_name );
    $xml     = 
"<system-data-structure>
  <shared-field field-id=\"$sf_id\" identifier=\"wysiwyg-content\" path=\"$sf_path\"/>
</system-data-structure>";

    if( is_null( $dd ) )
    {
        // create a data definition for pages
        $cascade->createDataDefinition(
            $dd_container,
            $dd_name,
            $xml );
    }
    
    // create a data definition for blocks
    $xml = 
"<system-data-structure>
    <text identifier=\"text\"/>
</system-data-structure>";
    $cascade->createDataDefinition(
        $dd_container,
        'Simple Text',
        $xml );
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