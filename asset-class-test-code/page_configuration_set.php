<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';
//$mode = 'xml';
//$mode = 'add';

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
                
        case 'dump':
            $pcs->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $pcs->getId() . BR;
            
            echo S_PRE;
            var_dump( $pcs->getPageConfigurationNames() );
            echo E_PRE;
            
            $default_config =  $pcs->getDefaultConfiguration();
   
            echo S_PRE;
            var_dump( $pcs->getPageConfiguration( 
                $default_config->getName() )->
                getPageRegionNames() );
            echo E_PRE;
            
            if( $pcs->getPublishable( $default_config->getName() ) )
            {
                echo "The default config is publishable" . BR;
            }
            else
            {
                echo "The default config is not publishable" . BR;
            }
                   
            if( $mode != 'all' )
                break;
                
        case 'set':
            $pcs->setConfigurationPageRegionBlock( 'Desktop', 'TOP GRAPHICS',
                    $cascade->getAsset( 
                        a\DataBlock::TYPE, 
                        'c23e62358b7f0856002a5e11909ccae3' )
                )->edit();
        
            if( $mode != 'all' )
                break;

        case 'raw':
            $pcs = $service->retrieve( $service->createId( 
                c\T::CONFIGURATIONSET, $id ), c\P::CONFIGURATIONSET );
                
            //$pr = new PageRegion( $pcs->pageConfigurations->
                //pageConfiguration[3]->pageRegions->pageRegion[0] );
            echo S_PRE;
            //var_dump( $pr );
            var_dump( $pcs );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
