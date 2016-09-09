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
    $default_ms = $cascade->getAsset( a\MetadataSet::TYPE, "cc1e51068b7ffe8364375ac78eca378c" );
    $my_test_ms = $cascade->getAsset( a\MetadataSet::TYPE, "06d5db638b7ffe83765c5582062dd782" );
    
    revealInfo( $my_test_ms );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

function revealInfo( a\MetadataSet $ms )
{
    echo S_H2, "Wired Fields", E_H2, S_UL;
    
    foreach( a\MetadataSet::$wired_fields as $field_name )
    {
        $required_method_name = u\StringUtility::getMethodName( $field_name ) .
            "FieldRequired";
        $visibility_method_name = u\StringUtility::getMethodName( $field_name ) .
            "FieldVisibility";
            
        echo S_LI, $field_name . ", " .
            ( $ms->$required_method_name() ? "required" : "not required" ) . ", " .
            $ms->$visibility_method_name(), E_LI;
    }
    
    echo E_UL;
    
    if( $ms->hasDynamicMetadataFieldDefinitions() )
    {
        echo S_H2, "Dynamic Fields", E_H2, S_UL;
        
        foreach( $ms->getDynamicMetadataFieldDefinitionNames() as $dmfs_name )
        {
            $dmfd = $ms->getDynamicMetadataFieldDefinition( $dmfs_name );
            
            echo S_LI, $dmfd->getName(), " &mdash; ",
                "type: ", $dmfd->getFieldType(), "; ",
                ( !$dmfd->isText() ?
                    "possible values: " . implode( ";", $dmfd->getPossibleValueStrings() ) . "; " :
                    "" ),
                ( $dmfd->isRequired() ? "required" : "not required" ), "; ",
                E_LI;
        }
        
        echo E_UL;
    }
    else
    {
        echo "This MS does not have dynamic fields", BR;
    }
}
?>