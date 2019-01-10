<?php
/*
This program creates a metadata set for pages.
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
    $site_name = "wing ming.chan";
    // name of the metadata set
    $ms_name = "XHTML Page";
    
    // try to retrieve the metadata set
    $ms = $admin->getMetadataSet( $ms_name, $site_name );
    
    // create the metadata set only if it does not exist
    if( is_null( $ms ) )
    {
        // get parent container
        $ms_container =
            $admin->getAsset(
                a\MetadataSetContainer::TYPE, "/", $site_name );
        
        // create the metadata set and add some fields
        $ms =
            $admin->createMetadataSet(
                $ms_container,
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
    }
    $ms->dump();
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