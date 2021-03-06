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
    $sf_container_name = 'Test Shared Field Container';
    $sf_container      = $cascade->getSharedFieldContainer( $sf_container_name, $site_name );

    if( is_null( $sf_container ) )
    {
        // create data definition  container
        $sf_container = $cascade->createSharedFieldContainer(
            $cascade->getAsset( 
                a\SharedFieldContainer::TYPE, '/', $site_name ),
            $sf_container_name
        );
    }
    
    $sf_name = 'WYSIWYG';
    $sf      = $cascade->getSharedField( $sf_container_name . '/' . $sf_name, $site_name );

    $xml = 
"<system-data-structure>
<text wysiwyg=\"true\" identifier=\"wysiwyg-content\" 
label=\"Content\"/>
</system-data-structure>";

    if( is_null( $sf ) )
    {
        // create a data definition for pages
        $cascade->createSharedField(
            $sf_container,
            $sf_name,
            $xml );
    }

    $sf_name = 'Simple Text';
    $sf      = $cascade->getSharedField( $sf_container_name . '/' . $sf_name, $site_name );

    $xml = 
"<system-data-structure>
<text identifier=\"text\"/>
</system-data-structure>";

    if( is_null( $sf ) )
    {
        // create a data definition for blocks
        $cascade->createSharedField(
            $sf_container,
            $sf_name,
            $xml );
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