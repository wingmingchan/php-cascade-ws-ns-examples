<?php 
require_once('cascade_ws_ns/auth_wing.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name         = 'web-service-tutorial';    
    $ms_container_name = 'Test Metadata Set Container';
    $folder_ms_name    = 'Folder';
    $page_ms_name      = 'Page';

    $ms_container = 
        $cascade->getAsset( a\MetadataSetContainer::TYPE, $ms_container_name, $site_name );
    
    // for folder
    if( is_null( $cascade->getMetadataSet( $ms_container_name . '/' . $folder_ms_name, $site_name ) ) )
    {
        $cascade->createMetadataSet(
                $ms_container,
                $folder_ms_name )->
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
        echo "The metadata set $folder_ms_name has been created." . BR;
    }
    else
    {
        echo "The metadata set $folder_ms_name already exists." . BR;
    }
    
    // for page
    if( is_null( $cascade->getMetadataSet( $ms_container_name . '/' . $page_ms_name, $site_name ) ) )
    {
        $folder_ms = $cascade->getAsset( a\MetadataSet::TYPE, $ms_container_name . '/' . $folder_ms_name, $site_name );
        
        $folder_ms->copy( $ms_container, $page_ms_name )->
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
        echo "The metadata set $page_ms_name has been created.";
    }
    else
    {
        echo "The metadata set $page_ms_name already exists.";
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>