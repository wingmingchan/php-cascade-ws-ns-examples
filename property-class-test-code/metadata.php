<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{

    $cascade->getAsset( a\Page::TYPE, "389b03188b7ffe83164c931405d3704f" )->dump();

    u\DebugUtility::out( u\StringUtility::boolToString( 
        $cascade->getAsset( a\DataBlock::TYPE, "ffa200f88b7ffe8330d802d73f3adfc3" )->getMetadata()->
            isDynamicMetadataFieldRequired( "checkbox" ) ) );

    $block_id = "388f033b8b7ffe83164c9314c23a3f8f";
    $block    = $cascade->getAsset( a\FeedBlock::TYPE, $block_id );
    $m        = $block->getMetadata();
    
    u\DebugUtility::out( u\StringUtility::boolToString( $m->isAuthorFieldRequired() ) );    
    u\DebugUtility::out( u\StringUtility::boolToString( $m->isDescriptionFieldRequired() ) );    
    
    // wired fields
    echo "Author: ", $m->getAuthor(), BR,
         "Display name: ", $m->getDisplayName(), BR,
         "End date: ", u\StringUtility::getCoalescedString( $m->getEndDate() ), BR
    .
    HR;
    
    
    // dynamic fields
    $ms = $block->getMetadataSet();
    
    // text
    $field_name = "text";
    echo "Testing $field_name", BR;
    
    if( $m->hasDynamicField( $field_name ) )
    {
        $text = $m->getDynamicField( $field_name );
        u\DebugUtility::dump( $text->getFieldValue()->getValues() );
        
        // passing in a single string as value
        $m->setDynamicFieldValue( $field_name, "New string used in text" );
    }
    
    // radio
/*
<radio>
    <item>Male</item>
    <item>Female</item>
</radio>
*/
    $field_name = "gender";
    echo "Testing $field_name", BR;
    
    if( $m->hasDynamicField( $field_name ) )
    {
        $radio = $m->getDynamicField( $field_name );
        u\DebugUtility::dump( $radio->getFieldValue()->getValues() );
        
        $new_value = "Female";
        
        if( $ms->hasDynamicMetadataFieldDefinition( $field_name ) )
        {
            $dmfd = $ms->getDynamicMetadataFieldDefinition( $field_name );
            
            if( $dmfd->hasPossibleValue( $new_value ) )
            {
                // an array as values, OK
                $m->setDynamicFieldValues( $field_name, array( $new_value ) );
                // a single string as value, OK too
                $m->setDynamicFieldValues( $field_name, $new_value );
            }
        }
    }
    
    // dropdown
/*
<dropdown>
    <item>NY</item>
    <item>NJ</item>
    <item>NM</item>
</dropdown>
*/
    $field_name = "state";
    echo "Testing $field_name", BR;
    
    if( $m->hasDynamicField( $field_name ) )
    {
        $dropdown = $m->getDynamicField( $field_name );
        u\DebugUtility::dump( $dropdown->getFieldValue()->getValues() );
        
        $new_value = "NM";
        
        if( $ms->hasDynamicMetadataFieldDefinition( $field_name ) )
        {
            $dmfd = $ms->getDynamicMetadataFieldDefinition( $field_name );
            
            if( $dmfd->hasPossibleValue( $new_value ) )
            {
                $m->setDynamicFieldValues( $field_name, array( $new_value ) );
            }
        }
    }
    
    // checkbox
/*
<checkbox>
    <item>Swimming</item>
    <item>Reading</item>
    <item>Jogging</item>
    <item>Sleeping</item>
</checkbox>
*/
    $field_name = "hobbies";
    echo "Testing $field_name", BR;
    
    if( $m->hasDynamicField( $field_name ) )
    {
        $checkboxes = $m->getDynamicField( $field_name );
        u\DebugUtility::dump( $checkboxes->toStdClass() );
        
        $new_values = array( "Swimming", "Jogging" );
        
        if( $ms->hasDynamicMetadataFieldDefinition( $field_name ) )
        {
            $dmfd = $ms->getDynamicMetadataFieldDefinition( $field_name );
            
            $valid = true;
            
            foreach( $new_values as $new_value )
            {
                if( !$dmfd->hasPossibleValue( $new_value ) )
                {
                    $valid = false;
                    break;
                }
            }
            
            if( $valid )
                $m->setDynamicFieldValues( $field_name, $new_values );
        }
    }
    
    // multiselect
/*
<multiselect>
    <item>English</item>
    <item>Japanese</item>
    <item>Spanish</item>
</multiselect>
*/
    $field_name = "languages";
    echo "Testing $field_name", BR;
    
    if( $m->hasDynamicField( $field_name ) )
    {
        $multiselect = $m->getDynamicField( $field_name );
        u\DebugUtility::dump( $multiselect->toStdClass() );
        
        $new_values = array( "Japanese", "English" );
        
        if( $ms->hasDynamicMetadataFieldDefinition( $field_name ) )
        {
            $dmfd = $ms->getDynamicMetadataFieldDefinition( $field_name );
            
            $valid = true;
            
            foreach( $new_values as $new_value )
            {
                if( !$dmfd->hasPossibleValue( $new_value ) )
                {
                    $valid = false;
                    break;
                }
            }
            
            if( $valid )
                $m->setDynamicFieldValues( $field_name, $new_values );
        }
    }

    
    u\DebugUtility::dump( $m->toStdClass() );
    
    // commit all changes
    $block->edit();
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_property\Metadata" );
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