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
    
    // dump the string array of dynamic field names
    u\DebugUtility::dump( $ms->getDynamicMetadataFieldDefinitionNames() );

    // find out if a field exists
    $field_name = 'exclude-from-left-folder-nav';
    u\DebugUtility::out( "The field $field_name " .
        ( $ms->hasDynamicMetadataFieldDefinition( $field_name ) ? 
            "exists" : "does not exist"  ) );
    
    // if the field exist
    if( $ms->hasDynamicMetadataFieldDefinition( $field_name ) )
    {
        // output the type and possible values
        $dmfd = $ms->getDynamicMetadataFieldDefinition( $field_name );
        
        // Type: checkbox
        u\DebugUtility::out( 
            BR . "Type: " . $dmfd->getFieldType() . BR . "Possible values: " );
        // Possible values: array( yes, no )
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
        
        // add another possible value at the end
        u\DebugUtility::out( "Appending maybe" );
        $dmfd->appendValue( "maybe" );
        $ms->edit(); // commit the change!!!
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
        
        // swap no and maybe
        u\DebugUtility::out( "Swapping no and maybe" );
        $dmfd->swapValues( "no", "maybe" );
        $ms->edit(); // commit the change!!!
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
        
        // maybe not, delete maybe
        u\DebugUtility::out( "Removing maybe" );
        $dmfd->removeValue( "maybe" );
        $ms->edit(); // commit the change!!!
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
    
        // set selected by default for No
        $dmfd->setSelectedByDefault( "no" );
        $ms->edit();  // commit the change!!!
        
        // check if maybe still exists
        u\DebugUtility::out(
            "The possible value 'maybe' " .
            ( $dmfd->hasPossibleValue( "maybe" ) ? "exists" : "does not exist" )
        );
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