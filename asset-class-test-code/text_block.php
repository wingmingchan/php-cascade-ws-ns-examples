<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

//$mode = 'all';
$mode = 'audits';
//$mode = 'copy';
//$mode = 'display';
//$mode = 'dump';
$mode = 'get';
$mode = 'metadata';
//$mode = 'move';
//$mode = 'rename';
//$mode = 'set';

try
{
    $tb = a\Asset::getAsset( 
        $service, 
        a\TextBlock::TYPE,
        '2ed0abe98b7f085601693b9b195aad7a' );
        
    $f = a\Asset::getAsset( 
        $service, 
        a\Folder::TYPE,
        '980d67e28b7f0856015997e42f97abb2' );

    switch( $mode )
    {
        case 'all':
        
        case 'audits':
            $audits = $tb->getAudits();
            var_dump( $audits );
            if( $mode != 'all' )
                break;
                
        case 'copy':
            $tb->copy( $f, 'text-copy' );
            if( $mode != 'all' )
                break;
        
        case 'display':
            $tb->display();
            if( $mode != 'all' )
                break;
            
        case 'dump':
            $tb->dump( true );
            if( $mode != 'all' )
                break;
            
        case 'get':
            echo $tb->getId() . BR;
            u\DebugUtility::dump( $tb->getIdentifier() );
            echo $tb->getName() . BR;
            echo $tb->getPath() . BR;
            u\DebugUtility::dump( $tb->getProperty() );
            echo $tb->getPropertyName() . BR;
            //u\DebugUtility::dump( $tb->getService() );
            echo $tb->getSiteId() . BR;
            echo $tb->getSiteName() . BR;
             u\DebugUtility::dump( $tb->getSubscribers() );
            echo $tb->getType() . BR;            
            echo $tb->getText() . BR;
            
            // folder
            $tb->getParentContainer()->dump( true );
            echo $tb->getParentContainerId() . BR;
            echo $tb->getParentContainerPath() . BR;
            
            if( $mode != 'all' )
                break;
            
        case 'metadata':
            echo $tb->getCreatedBy() . BR;
            echo $tb->getCreatedDate() . BR;
            u\DebugUtility::dump( $tb->getDynamicFields() );
            u\DebugUtility::dump( $tb->getMetadata() );
            if( $mode != 'all' )
                break;
            
        case 'move':
            if( $tb->isInContainer( $f ) )
            {
                $new_f = a\Asset::getAsset( 
                    $service, 
                    a\Folder::TYPE,
                    '980d67ab8b7f0856015997e4b8d84c5d' );
                $tb->move( $new_f );
            }
            if( $mode != 'all' )
                break;
                
        case 'rename':
                $tb->rename( "old-text" )->move(
                    a\Asset::getAsset( 
                        $service, 
                        a\Folder::TYPE,
                        '980d67e28b7f0856015997e42f97abb2' )
                );
                
            
            if( $mode != 'all' )
                break;
            
        case 'set':
            $text = "Text for the text block.";
            $tb->setText( $text )->edit()->dump( true );
            if( $mode != 'all' )
                break;
                
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>