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
    $block = $cascade->getAsset( a\TextBlock::TYPE, "06e401898b7ffe83765c5582e367462b" );
    // get the Metadata object
    $m     = $block->getMetadata();
    // get the MetadataSet object
    $ms    = $m->getMetadataSet();
    // get the dynamic field names
    $field_names = $m->getDynamicFieldNames();
    
    // all DynamicField objects
    u\DebugUtility::dump( $m->getDynamicFields() );
    
    // text
    $text_name = "text";
    
    if( $m->hasDynamicField( $text_name ) )
    {
        // get the DynamicField object
        $text_df = $m->getDynamicField( $text_name );
        echo $text_df->getName(), BR;
        u\DebugUtility::dump( $text_df->toStdClass() );

        // get the FieldValue
        $text_fv = $text_df->getFieldValue();
        // set the text
        $m->setDynamicFieldValue( $text_name, "This is some text" );
        // witness the text being changed
        u\DebugUtility::dump( $text_fv->toStdClass() ); // an stdClass object
        
        // remove the text
        if( !$m->isDynamicMetadataFieldRequired( $text_name ) )
        	$text_df->setValue( NULL );
    }
    
    // radio
    $radio_name = "gender";
    
    if( in_array( $radio_name, $field_names ) )
    {
        // get the DynamicField object
        $radio_df = $m->getDynamicField( $radio_name );
        // get the FieldValue
        $radio_fv = $radio_df->getFieldValue();
        // set the value
        $value = "Female";
        
        // test the value
        if( in_array(
            $value, $ms->getDynamicMetadataFieldPossibleValueStrings( $radio_name ) ) )
        {
            // set the value
            $m->setDynamicFieldValue( $radio_name, $value );
            // witness the radio being changed
            u\DebugUtility::dump( $radio_fv->getValues() ); // an array
        }
    }
    
    // dropdown
    $dropdown_name = "state";
    
    if( $m->hasDynamicField( $dropdown_name ) )
    {
        // get the DynamicField object
        $dropdown_df = $m->getDynamicField( $dropdown_name );
        // get the FieldValue
        $dropdown_fv = $dropdown_df->getFieldValue();
        // set the value
        $value = "NM";
        
        u\DebugUtility::dump( $m->getDynamicFieldPossibleValues( $dropdown_name ) );
        
        // test the value
        if( in_array(
            $value, $ms->getDynamicMetadataFieldPossibleValueStrings( $dropdown_name ) ) )
        {
            // set the value
            $m->setDynamicFieldValue( $dropdown_name, $value );
            // witness the radio being changed
            u\DebugUtility::dump( $dropdown_fv->getValues() ); // an array
        }
    }
    
    // checkbox
    $checkbox_name = "hobbies";
    
    if( $m->hasDynamicField( $checkbox_name ) )
    {
        // set the value
        $values = array( "Swimming", "Reading" );
        
        // test the values
        $valid = true;
        
        foreach( $values as $value )
        {
            if( !in_array( 
                $value, 
                $ms->getDynamicMetadataFieldPossibleValueStrings( $checkbox_name ) ) )
            {
                $valid = false;
                break; // test already failed, get out
            }
        }
        
        // all values are possbile values
        if( $valid )
        {
            $m->setDynamicFieldValue( $checkbox_name, $values );
        }
        
        // show the DynamicField object
        u\DebugUtility::dump( $m->getDynamicField( $checkbox_name )->toStdClass() );
    }
    
    // multiselect
    $multiselect_name = "languages";
    
    if( $m->hasDynamicField( $multiselect_name ) )
    {
        // set the value
        $values = array( "English", "Japanese" );
        
        // test the values
        $valid = true;
        
        foreach( $values as $value )
        {
            if( !in_array( 
                $value, 
                $m->getMetadataSet()->getDynamicMetadataFieldPossibleValueStrings( $multiselect_name ) ) )
            {
                $valid = false;
                break; // test already failed, get out
            }
        }
        
        // all values are possbile values
        if( $valid )
        {
            $m->setDynamicFieldValue( $multiselect_name, $values );
        }
        
        // array of strings
        u\DebugUtility::dump( $m->getDynamicFieldValues( $multiselect_name ) );
    }
    
    // commit
    $m->getHostAsset()->edit()->dump();
    u\DebugUtility::dump( $m->toStdClass() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
/*
Useful code templates:
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility" );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_asset\Page", "edit" );
        
    u\ReflectionUtility::showMethodDescription( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );

    u\DebugUtility::dump( $page );

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>