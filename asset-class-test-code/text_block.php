<?php 
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
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
$mode = 'set';

try
{
    //$tb = $cascade->getAsset( a\TextBlock::TYPE, '2ed0abe98b7f085601693b9b195aad7a' );
    $tb = $cascade->getAsset( a\TextBlock::TYPE, '06e401898b7ffe83765c5582e367462b' );
    //$f  = $cascade->getAsset( a\Folder::TYPE, '980d67e28b7f0856015997e42f97abb2' );

    switch( $mode )
    {
        case 'all':
        
        case 'audits':
            $audits = $tb->getAudits();
            u\DebugUtility::dump( $audits );
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
            echo $tb->getLastModifiedBy() . BR;
            echo $tb->getLastModifiedDate() . BR;
            
            // folder
            //$tb->getParentContainer()->dump( true );
            echo $tb->getParentContainerId() . BR;
            echo $tb->getParentContainerPath() . BR;
            
            echo u\StringUtility::getCoalescedString( $tb->getExpirationFolderId() ), BR;
            echo u\StringUtility::getCoalescedString( $tb->getExpirationFolderPath() ), BR;
            echo u\StringUtility::boolToString( $tb->getExpirationFolderRecycled() ), BR;
            
            if( $mode != 'all' )
                break;
            
        case 'metadata':
            echo $tb->getCreatedBy() . BR;
            echo $tb->getCreatedDate() . BR;
            
            
            
            $field_name = "text";
            
            if( $tb->hasDynamicField( $field_name ) )
            {
                $df = $tb->getDynamicField( $field_name );
            }
            else
            {
                echo "The dynamic field $field_name does not exist", BR;
            }
            
            if( $tb->hasDynamicFields() )
            {
                u\DebugUtility::dump( $tb->getDynamicFields() );
            }
            else
            {
                echo "There are no dynamic fields", BR;
            }
            
            $tb->getMetadataSet()->dump();
            echo $tb->getMetadataSetId(), BR;
            echo $tb->getMetadataSetPath(), BR;
            u\DebugUtility::dump( $tb->getMetadataStdClass() );
            
            echo S_PRE, "<code>", "bhal", "</code>", E_PRE;
            
            if( $mode != 'all' )
                break;
            
        case 'move':
            if( $tb->isInContainer( $f ) )
            {
                $new_f = $cascade->getAsset(
                    a\Folder::TYPE, '980d67ab8b7f0856015997e4b8d84c5d' );
                $tb->move( $new_f );
            }
            if( $mode != 'all' )
                break;
                
        case 'rename':
                $tb->rename( "old-text" )->move(
                    $cascade->getAsset(
                        a\Folder::TYPE, '980d67e28b7f0856015997e42f97abb2' )
                );
            
            if( $mode != 'all' )
                break;
            
        case 'set':
            $text = "Text for the text block.";
            $tb->setText( $text )->edit();
            
            $tb->setExpirationFolder(
                $cascade->getAsset( a\Folder::TYPE, "2401bc368b7ffe834c5fe91e0027a274" )
            )->edit()->dump();
            
            $tb->setMetadataSet(
                $cascade->getAsset(
                    a\MetadataSet::TYPE, "cc1e51068b7ffe8364375ac78eca378c" )
            )->dump();
            
            if( $mode != 'all' )
                break;
    }
    
    u\ReflectionUtility::showMethodSignatures( "cascade_ws_asset\TextBlock" );
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