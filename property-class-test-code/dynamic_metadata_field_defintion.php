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
    $dmfd->appendValue( "Chinese" );
    $ms->edit();
    
    $dmfd->swapValues( "Chinese", "Japanese" );
    $ms->edit();
    
    if( $dmfd->hasDefaultValue() )
    {
        u\DebugUtility::dump( $dmfd->getDefaultValue()->toStdClass() );
        u\DebugUtility::out( $dmfd->getDefaultValueString() );
    }
    
    u\DebugUtility::out( $dmfd->getFieldType() );
    u\DebugUtility::out( $dmfd->getLabel() );
    u\DebugUtility::out( $dmfd->getName() );
    
    u\DebugUtility::dump( $dmfd->getPossibleValues() );
    u\DebugUtility::dump( $dmfd->getPossibleValueStrings() );
    u\DebugUtility::dump( u\StringUtility::boolToString( $dmfd->getRequired() ) );
    u\DebugUtility::dump( $dmfd->getVisibility() );
        
    u\DebugUtility::dump( u\StringUtility::boolToString( $dmfd->hasPossibleValue( "Spanish") ) );
    
    $dmfd->removeValue( "Chinese" );
    $ms->edit()->dump();
    
    $dmfd->setLabel( "Languages" );
    $ms->edit()->dump();
    
    $dmfd->setRequired( true );
    $ms->edit()->dump();
    
    $dmfd->unsetSelectedByDefault( "Japanese" );
    $ms->edit()->dump();
    
    // radio
    $dmfd = $ms->getDynamicMetadataFieldDefinition( "gender" );
    $dmfd->setSelectedByDefault( "Male" );
    u\DebugUtility::dump( $dmfd->toStdClass() );
    $ms->edit()->dump();
    
    $dmfd->setVisibility( c\T::VISIBLE );
    $ms->edit()->dump();
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