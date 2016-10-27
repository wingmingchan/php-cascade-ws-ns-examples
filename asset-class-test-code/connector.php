<?php
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $connector = $cascade->getAsset( 
        a\TwitterConnector::TYPE, "017580c98b7f08ee707c11d62dc35154" )->dump();
    $ct1 = $cascade->getAsset( a\ContentType::TYPE, "1378b3e38b7f08ee1890c1e4df869132" );
    // RWD
    $ct2 = $cascade->getAsset( a\ContentType::TYPE, "5f4525208b7f08ee76b12c41beb6145a" );
    
    /*
    $connector->addContentTypeLink(
        $cascade->getAsset( a\ContentType::TYPE, "1378b3e38b7f08ee1890c1e4df869132" ),
        "XML"
    )->edit() ->dump();
    */
    
    echo u\StringUtility::getCoalescedString( $connector->getAuth1() ), BR;
    echo u\StringUtility::getCoalescedString( $connector->getAuth2() ), BR;
    echo u\StringUtility::getCoalescedString( $connector->getUrl() ), BR;
    echo u\StringUtility::boolToString( $connector->getVerified() ), BR;
    echo u\StringUtility::getCoalescedString( $connector->getVerifiedDate() ), BR;
    echo u\StringUtility::boolToString(
        $connector->hasContentType( "_common_assets:RWD One Region" ) ), BR;
    //$connector->removeContentTypeLink( $ct );
    //u\DebugUtility::dump( $connector->getConnectorContentTypeLinks() );
    //u\DebugUtility::dump( $connector->getConnectorParameters() );
    
    $destination = $cascade->getAsset(
        a\Destination::TYPE, "0755e15e8b7f08ee3295aa6d6c19fbe2" );
        
    $connector->setDestination( $destination )->edit();
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