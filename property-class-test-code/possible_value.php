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
    $ms   = $cascade->getAsset( a\MetadataSet::TYPE, "06d5db638b7ffe83765c5582062dd782" );
    $dmfd = $ms->getDynamicMetadataFieldDefinition( "languages" );
    
    u\DebugUtility::dump( $dmfd->getPossibleValues() );
    
    // multiselect
    $english = $dmfd->getPossibleValue( "English" );
    echo u\StringUtility::boolToString( $english->getSelectedByDefault() ), BR;
    
    foreach( $dmfd->getPossibleValues() as $pv )
        echo $pv->getValue(), BR;
        
    $dmfd->getPossibleValue( "Japanese" )->setSelectedByDefault( true );
    u\DebugUtility::dump( $dmfd->toStdClass() );
    
    echo u\StringUtility::boolToString( $dmfd->hasPossibleValue( "Spanish" ) ), BR;
    
    // radio
    $dmfd = $ms->getDynamicMetadataFieldDefinition( "gender" );
    $dmfd->getPossibleValue( "Female" )->setSelectedByDefault( false );
    $dmfd->getPossibleValue( "Male" )->setSelectedByDefault( true );
    u\DebugUtility::dump( $dmfd->toStdClass() );
    u\DebugUtility::dump( $dmfd->getPossibleValue( "Female" )->toStdClass() );
    
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