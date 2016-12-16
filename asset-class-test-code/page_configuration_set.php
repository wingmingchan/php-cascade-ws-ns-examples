<?php
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
$mode = 'dump';
$mode = 'get';
$mode = 'set';
//$mode = 'raw';
//$mode = 'xml';
//$mode = 'add';
//$mode = 'delete';

try
{
    //$id = "d7b67e638b7f085600a0fcdc2ef6d531"; // 3 Column
    $id = "fc51bcda8b7f085600406eac9dc67ed8"; // 3 Column Test 2
    $pcs = $cascade->getAsset( a\PageConfigurationSet::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $pcs->display();
            
            if( $mode != 'all' )
                break;
                
        case 'add':
        /*
            $pcs->addConfiguration( 
                'XML', // name
                $cascade->getAsset( a\Template::TYPE, 'fd27b6798b7f08560159f3f08e013f23' ),
                '.xml',
                T::XML
            );
        */
            if( $mode != 'all' )
                break;
                
        case 'delete':
            //$pcs->deletePageConfiguration( 'XML' )->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $pcs->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $pcs->getId() . BR;
            
            /*
            u\DebugUtility::dump( $pcs->getPageConfigurationNames() );
            
            $default_config =  $pcs->getDefaultConfiguration();
            
            echo u\StringUtility::boolToString( 
                $pcs->getIncludeXMLDeclaration( "PDF" ) ), BR;
            
            echo u\StringUtility::boolToString(
                $pcs->getOutputExtension( "PDF" ) ), BR;
   
            u\DebugUtility::dump( $pcs->getPageConfiguration( 
                $default_config->getName() )->
                getPageRegionNames() );
            
            if( $pcs->getPublishable( $default_config->getName() ) )
            {
                echo "The default config is publishable" . BR;
            }
            else
            {
                echo "The default config is not publishable" . BR;
            }
            */
            //u\DebugUtility::dump( $pcs->getPageConfigurations() );
            //$pcs->getPageConfigurationTemplate( "PDF" )->dump();
            //u\DebugUtility::dump( $pcs->getPageRegionNames( "Mobile" ) );
            //u\DebugUtility::dump( $pcs->getPageRegion( "Mobile", "DEFAULT" ) );
            //u\DebugUtility::dump( $pcs->getPageRegion( "Mobile", "DEFAULT" ) );
            //echo $pcs->getSerializationType( "PDF" ), BR;
            
            echo u\StringUtility::boolToString( $pcs->hasPageConfiguration( "XML" ) ), BR;
            echo u\StringUtility::boolToString( $pcs->hasPageRegion( "Mobile", "DEFAULT" ) ), BR;
                 
            if( $mode != 'all' )
                break;
                
        case 'set':
    /*
            $pcs->setConfigurationPageRegionBlock( 'Mobile', 'DEFAULT',
                    $cascade->getAsset( 
                        a\DataBlock::TYPE, 
                        'c23e62358b7f0856002a5e11909ccae3' )
                )->edit();
                
            $pcs->setConfigurationPageRegionFormat( 'Mobile', 'DEFAULT',
                    $cascade->getAsset( 
                        a\XsltFormat::TYPE, 
                        '404872688b7f0856002a5e11bb8c8642' )
                )->edit();
  
            //$pcs->setDefaultConfiguration( "Mobile" )->edit();
            $pcs->setFormat( "Mobile",
                $cascade->getAsset( 
                    a\XsltFormat::TYPE, 
                    '404872688b7f0856002a5e11bb8c8642' )
            )->edit();
      */
            //$pcs->setIncludeXMLDeclaration( "Mobile", true )->edit();
            $pcs->setOutputExtension( "Mobile", ".php" )->
                setPublishable( "Mobile", true )->
                setSerializationType( "Mobile", "XML" )->
                edit();
                 
            if( $mode != 'all' )
                break;

        case 'raw':
            $pcs = $service->retrieve( $service->createId( 
                c\T::CONFIGURATIONSET, $id ), c\P::CONFIGURATIONSET );
                
            //$pr = new PageRegion( $pcs->pageConfigurations->
                //pageConfiguration[3]->pageRegions->pageRegion[0] );
            //u\DebugUtility::dump( $pr );
            u\DebugUtility::dump( $pcs );
        
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\PageConfigurationSet" );
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