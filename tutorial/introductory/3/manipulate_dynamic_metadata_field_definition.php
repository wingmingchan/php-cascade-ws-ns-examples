<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $ms = $cascade->getAsset( a\MetadataSet::TYPE, 'b893fd058b7f0856002a5e11185ff809' );
    
    // dump the string array of dynamic field names
    u\DebugUtility::dump( $ms->getDynamicMetadataFieldDefinitionNames() );

    // find out if a field exists
    $field_name = 'exclude-from-left';
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
        // Possible values: array( Yes, No )
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
        
        // add another possible value at the end
        u\DebugUtility::out( "Appending Maybe" );
        $dmfd->appendValue( "Maybe" );
        $ms->edit(); // commit the change!!!
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
        
        // swap No and Maybe
        u\DebugUtility::out( "Swapping No and Maybe" );
        $dmfd->swapValues( "No", "Maybe" );
        $ms->edit(); // commit the change!!!
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
        
        // maybe not, delete Maybe
        u\DebugUtility::out( "Removing Maybe" );
        $dmfd->removeValue( "Maybe" );
        $ms->edit(); // commit the change!!!
        u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
    
        // set selected by default for No
        $dmfd->setSelectedByDefault( "No" );
        $ms->edit();  // commit the change!!!
        
        // check if Maybe still exists
        u\DebugUtility::out(
            "The possible value 'Maybe' " .
            ( $dmfd->hasPossibleValue( "Maybe" ) ? "exists" : "does not exist" )
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