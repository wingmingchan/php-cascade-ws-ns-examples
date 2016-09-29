<?php
//require_once('auth_tutorial7.php');
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

//$mode = 'list-sites';
//$mode = 'asset-tree';
//$mode = 'access-rights';
$mode = 'check-in-out';
$mode = 'clear-permissions';
$mode = 'copy-asset';
$mode = 'copy-site';
$mode = 'create-group';
$mode = 'move-asset';
$mode = 'search';
$mode = 'none';

try
{
    $page = $cascade->getPage( "9240ca5e8b7f08ee1ccdcc666153c3d6" ); //->dump();

    switch( $mode )
    {
        case 'check-in-out':
        
            $check_mode = 'in';
            $check_mode = 'out';
            
            switch( $check_mode )
            {
                case 'in':
                    $cascade->checkIn( $page );
                    break;
                case 'out':
                    $id = "";
                    $cascade->checkOut( $page, $id );
                    
                    // work with the working copy
                    $working_page = $cascade->getAsset( a\Page::TYPE, $id );
                    $working_page->getMetadata()->setDisplayName( "Upgrade Cascade CMS" )->
                        getHostAsset()->edit();
                    // merge the changes
                    $cascade->checkIn( $page );
                    break;
            }
                
            if( $mode != 'all' )
                break;
                
        case 'clear-permissions':
            $cascade->clearPermissions( a\Page::TYPE, "51e41e738b7f08ee0eb80213bbea02b9" );
            
            if( $mode != 'all' )
                break;
    
        case 'copy-asset':
            $cascade->copyAsset(
                $page,
                $cascade->getAsset( a\Folder::TYPE, "fff3a7538b7f08ee3e513744ae475537" ), // target folder
                "new-page" // new name
            );
            
            if( $mode != 'all' )
                break;
    
        case 'copy-site':
            $seed = $cascade->getSite( '_seed' );
            $cascade->copySite( $seed, 'test', 50 );
            
            if( $mode != 'all' )
                break;

        case 'create-group':
            $create_mode = 'asset-factory';
            $create_mode = 'asset-factory-container';
            $create_mode = 'connector-container';
            $create_mode = 'content-type';
            $create_mode = 'content-type-container';
            $create_mode = 'content-type-index-block';
            
            switch( $create_mode )
            {
                case 'asset-factory':
                    $cascade->createAssetFactory(
                        $cascade->getAsset( a\AssetFactoryContainer::TYPE, "3789d91a8b7f08ee2347507a434b94d3" ),
                        "Upload 1000x500 Image",
                        a\File::TYPE
                    )->dump();
                    break;
                    
                case 'asset-factory-container':
                    $cascade->createAssetFactoryContainer(
                        $cascade->getAsset( a\AssetFactoryContainer::TYPE, "980a7cff8b7f0856015997e40fe58068" ),
                        "Upload"
                    )->dump();
                    break;
                    
                case 'connector-container':
                    $cascade->createConnectorContainer(
                        $cascade->getAsset( a\ConnectorContainer::TYPE, "980a826b8b7f0856015997e424411695" ),
                        "Test"
                    )->dump();
                    break;
                    
                case 'content-type':
                    $cascade->createContentType(
                        $cascade->getAsset( a\ContentTypeContainer::TYPE, "980a7c9f8b7f0856015997e4dbf4ab28" ),
                        "Test",
                        $cascade->getAsset( a\PageConfigurationSet::TYPE, "5f1e42b08b7f08ee226116ffc4f6aac7" ),
                        $cascade->getAsset( a\MetadataSet::TYPE, "980d70498b7f0856015997e430d5c886" ),
                        $cascade->getAsset( a\DataDefinition::TYPE, "9e18141d8b7f08560053896c87327dcd" )
                    )->dump();
                    break;
                    
                case 'content-type-container':
                    $cascade->createContentTypeContainer(
                        $cascade->getAsset( a\ContentTypeContainer::TYPE, "980a7c9f8b7f0856015997e4dbf4ab28" ),
                        "Test Container"
                    )->dump();
                    break;
                    
                case 'content-type-index-block':
                    $cascade->createContentTypeIndexBlock(
                        $cascade->getAsset( a\Folder::TYPE, "ffe39a278b7f08ee3e513744c5d70ead" ),
                        "test-content-type-index",
                        $cascade->getAsset( a\ContentType::TYPE, "9e19734b8b7f08560053896cab006010" )
                    )->dump();
                    break;
            }
            
            if( $mode != 'all' )
                break;



               
        case 'list-sites':
            $sites = $cascade->getSites();
            
            foreach( $sites as $site )
            {
                echo $site->getPathPath() . BR;
            }
            
            if( $mode != 'all' )
                break;
                
        case 'asset-tree':
            $site = $cascade->getSite( '22q' );
            $tree = $site->getAssetTree();
            echo S_PRE . u\XMLUtility::replaceBrackets( $tree->toXml() ) . 
                E_PRE;
            
            if( $mode != 'all' )
                break;
            
        case 'access-rights':
            $ari = $cascade->getAccessRights( 
                a\Page::TYPE, '03b44ae28b7f085600adcd81311fbcdc' ); // test33
                
            echo S_PRE;
            var_dump( $ari->toStdClass() );
            echo E_PRE;
/*               
                
            $user1 = $cascade->getAsset( a\User::TYPE, 'chanw' );
            $user2 = $cascade->getAsset( a\User::TYPE, 'tuw' );
            if( $ari->hasUser( $user1 ) )
            {
                echo "User " . $user1->getName() . " with " .
                     $ari->getUserLevel( $user1 ) . " access." . BR;
            }
            
            // set user2 to read
            $ari->addUserReadAccess( $user2 );
            $cascade->setAccessRights( $ari );
            echo "User " . $user2->getName() . " with " .
                $ari->getUserLevel( $user2 ) . " access." . BR;

            $ari = $cascade->getAccessRights( 
                a\Page::TYPE, '60258bf18b7f0856002a5e11f8cff53b' );
            
            // set user2 to write
            $ari->setUserWriteAccess( $user2 );
            $cascade->setAccessRights( $ari );
            echo "User " . $user2->getName() . " with " .
                $ari->getUserLevel( $user2 ) . " access." . BR;
                
            // set all to none
            $ari->setAllLevel( c\T::NONE );
            $cascade->setAccessRights( $ari );
           
            $ari = $cascade->getAccessRights( 
                a\Folder::TYPE, 'b8bf838f8b7f0856002a5e11586fba90' );
            $group1 = $cascade->getAsset( a\Group::TYPE, 'cru' );
            $group2 = $cascade->getAsset( a\Group::TYPE, 'hemonc' );

            // set group1 to read
            $ari->addGroupReadAccess( $group1 );
            // set group2 to write
            $ari->addGroupWriteAccess( $group2 );
            // set all to none
            $ari->setAllLevel( c\T::NONE );
            // applied to children
            $cascade->setAccessRights( $ari, true ); 

            $ari->denyGroupAccess( $group2 )->denyUserAccess( $user2 );
            $cascade->setAccessRights( $ari );
*/           
            
            if( $mode != 'all' )
                break;
                
        case 'move-asset':
            $page = $cascade->getAsset( 
                a\Page::TYPE, "5f1f70828b7f08ee226116ffc5e5b1b9" );
            /*
            $cascade->moveAsset( $page,
                $cascade->getAsset( 
                    a\Folder::TYPE, "8b5193ee8b7f08ee26d2e6f290705401" ) );
            */
            $cascade->renameAsset( $page, "my-new-page" );
            
            if( $mode != 'all' )
                break;
            
        case 'search':
            u\DebugUtility::dump(
            	$cascade->searchForAssetMetadata(
            		"Cascade",
            		c\S::SEARCHPAGES
            	)
            );
        /*
            u\DebugUtility::dump(
            	$cascade->searchForAssetName(
            		"a*",
            		c\S::SEARCHPAGES
            	)
            );
            u\DebugUtility::dump(
            	$cascade->searchForAssetContent(
            		"Cascade",
            		c\S::SEARCHPAGES
            	)
            );
            u\DebugUtility::dump(
            	$cascade->searchForAll(
            		"a*",
            		"Cascade",
            		"",
            		c\S::SEARCHPAGES
            	)
            );
         */   
            
            if( $mode != 'all' )
                break;
            
    }
    
    u\ReflectionUtility::showMethodSignatures( $cascade );
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
