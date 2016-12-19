<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
$mode = 'get';
$mode = 'assignment';
$mode = 'set';
//$mode = 'publish';
//$mode = 'asset-tree';
//$mode = 'raw';

try
{
    $id = "cascade-admin-webapp"; // on sandbox
    $s  = $cascade->getAsset( a\Site::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $s->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $s->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo $s->getBaseFolderId(), BR;
            echo u\StringUtility::getCoalescedString( $s->getCssClasses() ), BR;
            echo u\StringUtility::getCoalescedString( $s->getCssFileId() ), BR;
            echo u\StringUtility::getCoalescedString( $s->getCssFilePath() ), BR;
            echo u\StringUtility::boolToString( $s->getCssFileRecycled() ), BR;
            echo $s->getDefaultMetadataSetId(), BR;
            echo $s->getDefaultMetadataSetPath(), BR;
            echo u\StringUtility::boolToString( $s->getExternalLinkCheckOnPublish() ), BR;
            echo u\StringUtility::boolToString( $s->getLinkCheckerEnabled() ), BR;
            echo $s->getRecycleBinExpiration(), BR;
                
            echo $s->getRootAssetFactoryContainerId(), BR;
            echo $s->getRootConnectorContainerId(), BR;
            echo $s->getRootContentTypeContainerId(), BR;
            echo $s->getRootDataDefinitionContainerId(), BR;
            echo $s->getRootFolderId(), BR;
            echo $s->getRootMetadataSetContainerId(), BR;
            echo $s->getRootPageConfigurationSetContainerId(), BR;
            echo $s->getRootPublishSetContainerId(), BR;
            echo $s->getRootSiteDestinationContainerId(), BR;
            echo $s->getRootTransportContainerId(), BR;
            echo $s->getRootWorkflowDefinitionContainerId(), BR;
            echo $s->getSiteAssetFactoryContainerId(), BR;
            echo $s->getSiteAssetFactoryContainerPath(), BR;
            
            echo u\StringUtility::getCoalescedString( $s->getSiteStartingPageId() ), BR;
            echo u\StringUtility::getCoalescedString( $s->getSiteStartingPagePath() ), BR;
            echo u\StringUtility::boolToString( $s->getSiteStartingPageRecycled() ), BR;
            echo u\StringUtility::boolToString( $s->getUnpublishOnExpiration() ), BR;
            echo $s->getUrl(), BR;
            echo u\StringUtility::boolToString( $s->hasRole(
                $cascade->getAsset( a\Role::TYPE, 5 ) ) ), BR;
            
            
            echo u\StringUtility::getCoalescedString(
                $s->getScheduledPublishDestinationMode() ), BR;
            echo u\StringUtility::getCoalescedString(
                $s->getScheduledPublishDestinations() ), BR;
                
                
            if( $mode != 'all' )
                break;
            
        case 'assignment':
            $r = $cascade->getAsset( a\Role::TYPE, 50 ); // site publisher
            $s->addRole( $r )->edit();
        
            $s->addUserToRole( 
                $r, $cascade->getAsset( a\User::TYPE, 'chanw' ) )->
                addUserToRole( 
                    $r, $cascade->getAsset( a\User::TYPE, 'tuw' ) )->
                addGroupToRole( 
                    $r, $cascade->getAsset( a\Group::TYPE, 'cru' ) )->
                edit();
        
            //$s->removeRole( $r )->edit();
                
            if( $mode != 'all' )
                break;
                
        case 'set':
            $s->
                // URL
                setUrl( 'http://www.upstate.edu/tuw-test' )->
                // metadata set
                setDefaultMetadataSet( 
                    $cascade->getAsset( a\MetadataSet::TYPE,
                        '1f22ac858b7ffe834c5fe91e67ea0fcf' ) )->
                // css
                setCssFile(
                /*
                    $cascade->getAsset( a\File::TYPE, 
                        '4007ae9d8b7f08560139425c99384b99' ), 
                        'leftobject,rightobject,center,centerobject'
                */
                    NULL
                )->
                // asset factory container
                setSiteAssetFactoryContainer( 
                    $cascade->getAsset( a\AssetFactoryContainer::TYPE,
                        '1f217d838b7ffe834c5fe91e9832f910' )
                    // NULL
                )->
                // starting page
                setStartingPage( 
                    $cascade->getAsset( a\Page::TYPE, 
                        '1f2376798b7ffe834c5fe91ead588ce1' )
                    //NULL
                )->
                // send report on error
                setSendReportOnErrorOnly( true )->
                // add user to send report
                addUserToSendReport( a\Asset::getAsset( 
                    $service, a\User::TYPE, 'wing' ) )->
                // add group to send report
                addGroupToSendReport( a\Asset::getAsset( 
                    $service, a\Group::TYPE, 'Administrators' ) )->
                // expiration
                setRecycleBinExpiration( a\Site::NEVER )->
                setExternalLinkCheckOnPublish( true )->
                setLinkCheckerEnabled( false )->
                setUnpublishOnExpiration( true )->
                
                edit()->dump();
                
            if( $mode != 'all' )
                break;
                
        case 'publish':
            //$s->publish();
                
            if( $mode != 'all' )
                break;
        
        case 'asset-tree':
/*/
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootAssetFactoryContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootConnectorContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootContentTypeContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootDataDefinitionContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootMetadataSetContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootPageConfigurationSetContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootPublishSetContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootSiteDestinationContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootTransportContainerAssetTree()->
                toXml() ) );
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getRootWorkflowDefinitionContainerAssetTree()->
                toXml() ) );
/*/
            u\DebugUtility::dump( u\XMLUtility::replaceBrackets( 
                $s->getSiteAssetFactoryContainerAssetTree()->
                toXml() ) );
                
            if( $mode != 'all' )
                break;
        
        case 'raw':
            $s_std = $service->retrieve( $service->createId( 
                c\T::SITE, $id ), c\P::SITE );
/*          
            if( $s_std->timeToPublish == NULL )
                unset( $s_std->timeToPublish );
            else if( strpos( $s_std->timeToPublish, '-' ) !== false )
            {
                $pos = strpos( $s_std->timeToPublish, '-' );
                $s_std->timeToPublish = substr( $s_std->timeToPublish, 0, $pos );
            }
            
            if( $s_std->publishIntervalHours == NULL )
                unset( $s_std->publishIntervalHours );
                
            if( $s_std->publishDaysOfWeek == NULL )
                unset( $s_std->publishDaysOfWeek );
          
            $asset->site = $s_std;
            $service->edit( $asset );
            
            if( !$service->isSuccessful() )
            {
                echo "Failed to edit." . $service->getMessage() . BR;
            }
*/ 

            echo S_PRE;
            var_dump( $s_std );
            echo E_PRE;

            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Site" );
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