<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'list-sites';
//$mode = 'asset-tree';
$mode = 'access-rights';
//$mode = 'copy-site';

try
{
    switch( $mode )
    {
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
            
        case 'copy-site':
            $seed = $cascade->getSite( '_seed' );
            $new_site = $cascade->copySite( $seed, 'test3' );
            $new_site->dump( true );
            
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
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
