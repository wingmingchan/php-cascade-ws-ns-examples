<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name      = 'web-service-test';
    $container_name = 'Test Metadata Set Container';

    $new_container = $cascade->createMetadataSetContainer(
        $cascade->getAsset( a\MetadataSetContainer::TYPE, '/', $site_name ),
        $container_name );
    
    // create metadata set for folders
    $ms_name = 'Folder';
    $new_ms  = $cascade->
        createMetadataSet(
            $new_container, // parent
            $ms_name )->
        setDisplayNameFieldVisibility( a\MetadataSet::INLINE )->
        addField( 
            'exclude-from-menu',      // field name
            c\T::CHECKBOX,            // type
            'Exclude from Menu Bar',  // label
            false,                    // required
            c\T::INLINE,              // visibility
            "Yes"                     // possible value
        )->
        addField( 
            'exclude-from-left',      // field name
            c\T::CHECKBOX,            // type
            'Exclude from Left Menu', // label
            false,                    // required
            c\T::INLINE,              // visibility
            "Yes"                     // possible value
        )->
        addField( 
            'show-intra-icon',        // field name
            c\T::CHECKBOX,            // type
            'Show Intra Icon',        // label
            false,                    // required
            c\T::INLINE,              // visibility
            "Yes"                     // possible value
        );

    // create metadata set for pages
    $new_ms->copy( $new_container, 'Page' )->
        addField( 
            'displayed-as-submenu',   // field name
            c\T::CHECKBOX,            // type
            'Displayed As Submenu',   // label
            false,                    // required
            c\T::INLINE,              // visibility
            "Yes"                     // possible value
        )->
        // move displayed-as-submenu up
        swapFields( 'displayed-as-submenu', 'show-intra-icon' )->
        swapFields( 'displayed-as-submenu', 'exclude-from-left' )->
        addField( 
            'category',               // field name
            c\T::RADIO,               // type
            'Category',               // label
            false,                    // required
            c\T::INLINE,              // visibility
            "Feature;News;Normal"     // possible value
        )->
        setSelectedByDefault( 'category', 'Normal' )->
        edit(); // commit setSelectedByDefault
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