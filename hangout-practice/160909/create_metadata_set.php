<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name         = 'ws-tutorial-wing';    
    $ms_container_name = '/';
    $ms_name           = 'My Test Metadata Set';
    
    $ms_container = $cascade->getAsset( 
    	a\MetadataSetContainer::TYPE, $ms_container_name, $site_name );
    	
    if( is_null( $cascade->getMetadataSet( $ms_container_name . $ms_name, $site_name ) ) )
    {
        $ms = $cascade->createMetadataSet(
        	$ms_container,  // the parent container
        	$ms_name        // name
        );
        
        $ms->
            addField( 
                'text',             // field name
                c\T::TEXT,          // type
                'Text',             // label
                false,              // required
                c\T::INLINE,        // visibility
                ""                  // possible value
            )->
            
            addField(
                'gender',
                c\T::RADIO,
                'Gender',
                true,
                c\T::INLINE,
                "Male;Female"
            )->
            setSelectedByDefault( 'gender', 'Female' )->
            
            addField( 
                'state',
                c\T::DROPDOWN,
                'State',
                false,
                c\T::INLINE,
                "NY;NJ;NM"
            )->
            
            addField( 
                'hobbies',
                c\T::CHECKBOX,
                'Hobbies',
                false,
                c\T::INLINE,
                "Swimming;Reading;Jogging;Sleeping"
            )->
            
            addField( 
                'languages',
                c\T::MULTISELECT,
                'Languages',
                true,
                c\T::INLINE,
                "English;Japanese;Spanish"
            )->
            setSelectedByDefault( 'languages', 'English' )->
            
            edit();
                              
        echo "The metadata set $ms_name has been created.";
    }
    else
    {
        echo "The metadata set $ms_name already exists.";
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