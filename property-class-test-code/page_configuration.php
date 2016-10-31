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
    $pcs = $cascade->getAsset(
        a\PageConfigurationSet::TYPE, "255a2bd18b7ffe3b00a7e343711b563e" );
    $pc  = $pcs->getPageConfiguration( "Desktop" );
    //u\DebugUtility::dump( $pc->toStdClass() );
    //$pc->display();
    //$pc->dump();
    echo u\StringUtility::boolToString( $pc->getDefaultConfiguration() ), BR;
    
    echo u\StringUtility::getCoalescedString( $pc->getFormatId() ), BR;
    echo u\StringUtility::getCoalescedString( $pc->getFormatPath() ), BR;
    echo u\StringUtility::boolToString( $pc->getFormatRecycled() ), BR;
    
    echo $pc->getId(), BR;
    echo $pc->getName(), BR;
    echo u\StringUtility::boolToString( $pc->getIncludeXMLDeclaration() ), BR;
    echo $pc->getOutputExtension(), BR;
    
    //u\DebugUtility::dump( $pc->getPageRegion( "DEFAULT" ) );
    //u\DebugUtility::dump( $pc->getPageRegionNames() );
    //u\DebugUtility::dump( $pc->getPageRegions() );
    //u\DebugUtility::dump( $pc->getPageRegionBlock( "DEFAULT" ) );
    //u\DebugUtility::dump( $pc->getPageRegionFormat( "DEFAULT" ) );

    //echo u\StringUtility::boolToString( $pc->getPublishable() ), BR;
    //echo $pc->getSerializationType(), BR;
    //$pc->getTemplate()->dump();
    echo $pc->getTemplateId(), BR;
    echo $pc->getTemplatePath(), BR;
    echo u\StringUtility::boolToString( $pc->hasPageRegion( "LOGO" ) ), BR;
    //u\DebugUtility::dump( $pc->setDefaultConfiguration( true )->toStdClass() );
    
    /*
    u\DebugUtility::dump( $pc->setFormat(
        $cascade->getAsset( a\XsltFormat::TYPE, "255a4cec8b7ffe3b00a7e3433e083063" )
    )->toStdClass() );
    */
    
    //u\DebugUtility::dump( $pc->setIncludeXMLDeclaration( true )->toStdClass() );
    //u\DebugUtility::dump( $pc->setOutputExtension( ".html" )->toStdClass() );
    //u\DebugUtility::dump( $pc->setPageRegionBlock( "SEARCH PRINT" )->toStdClass() );
    //u\DebugUtility::dump( $pc->setPageRegionFormat( "LAST MODIFIED" )->toStdClass() );
    //u\DebugUtility::dump( $pc->setPublishable( false )->toStdClass() );
    //u\DebugUtility::dump( $pc->setRegionNoBlock( "SEARCH PRINT", true )->toStdClass() );
    //u\DebugUtility::dump( $pc->setRegionNoFormat( "SEARCH PRINT", true )->toStdClass() );
    //u\DebugUtility::dump( $pc->setSerializationType( "XML" )->toStdClass() );

    u\DebugUtility::dump( $pc->setSerializationType( "XML" )->toStdClass() );
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