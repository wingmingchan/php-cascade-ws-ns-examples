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
    $ms = $cascade->getAsset( a\MetadataSet::TYPE, 'a15e54ae8b7ffe837b9f2648f7d70d16' );
    
    /* wired fields */
    $ms->setStartDateFieldRequired( true )->
        setTitleFieldVisibility( c\T::INLINE )->
        edit();
    u\DebugUtility::out(
        "Start date is required: " . 
        u\StringUtility::boolToString( $ms->getStartDateFieldRequired() )
    );
    u\DebugUtility::out(
        "Visibility of title: " . $ms->getTitleFieldVisibility()
    );
    
    /* dynamic fields */
    // dump the string array of dynamic field names
    u\DebugUtility::dump( $ms->getDynamicMetadataFieldDefinitionNames() );
    
    // find out if a field exists
    $field_name = 'new-field';
    u\DebugUtility::out( "The field $field_name " .
        ( $ms->hasDynamicMetadataFieldDefinition( $field_name ) ? 
            "exists" : "does not exist"  ) );
    
    // if the field does not exist, add it
    if( !$ms->hasDynamicMetadataFieldDefinition( $field_name ) )
    {
        u\DebugUtility::out( "Adding a field $field_name" );
        $ms->addDynamicFieldDefinition( 
            $field_name,
            "radio",      // type
            "Display",    // label
            true,         // required
            c\T::VISIBLE, // visibility
            "yes;no"      // possible values
        );
    }
    u\DebugUtility::dump( $ms->getDynamicMetadataFieldDefinitionNames() );
        
    // move the field up
    u\DebugUtility::out( "Moving $field_name up" );
    
    if( $ms->hasDynamicMetadataFieldDefinition( "tree-picker" ) )
    {
        $ms->swapFields( "tree-picker", $field_name );
    }
    u\DebugUtility::dump( $ms->getDynamicMetadataFieldDefinitionNames() );
        
    // change my mind, remove the new field
    u\DebugUtility::out( "Removing $field_name" );
    $ms->removeDynamicMetadataFieldDefinition( $field_name );
    u\DebugUtility::dump( $ms->getDynamicMetadataFieldDefinitionNames() );
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