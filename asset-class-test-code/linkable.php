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
	$page = $cascade->getAsset(
	    a\Page::TYPE, "06a23e5b8b7ffe830820c9fac501387b" );
/*	    
	echo $page->getCreatedBy(), BR;
	echo $page->getCreatedDate(), BR;
	//u\DebugUtility::dump( $page->getDynamicField( "exclude-from-menu" ) );
	//u\DebugUtility::dump( $page->getDynamicFields() );
	echo u\StringUtility::getCoalescedString( $page->getExpirationFolderId() ), BR;
	echo u\StringUtility::getCoalescedString( $page->getExpirationFolderPath() ), BR;
	echo u\StringUtility::boolToString( $page->getExpirationFolderRecycled() ), BR;
	echo $page->getLastModifiedBy(), BR;
	echo $page->getLastModifiedDate(), BR;
*/
	//u\DebugUtility::dump( $page->getMetadata() );
	//$page->getMetadataSet()->dump();
	//echo u\StringUtility::getCoalescedString( $page->getMetadataSetId() ), BR;
	//echo u\StringUtility::getCoalescedString( $page->getMetadataSetPath() ), BR;
	//u\DebugUtility::dump( $page->getMetadataStdClass() );
	//echo u\StringUtility::boolToString( $page->hasDynamicField( "exclude-from-menu" ) ), BR;
	/*
	$page->setExpirationFolder(
		$cascade->getAsset(
	    	a\Folder::TYPE, "39d53a118b7ffe834c5fe91e7e2e0cd9" )
	)->edit();
	*/
	
	//$page->setMetadata( $page->getMetadata() );
	//$page->setMetadataSet( $cascade->getAsset(
	    //a\MetadataSet::TYPE, "35963bf48b7ffe83164c931407216994" ) );
	//echo a\Linkable::getLinkableType( $service, "06a23e5b8b7ffe830820c9fac501387b" ), BR;
	a\Linkable::getLinkable( $service, "06a23e5b8b7ffe830820c9fac501387b" )->dump();
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
	echo S_PRE . $er . E_PRE; 
}
/*
Useful code templates:
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility" );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_asset\Page", "edit" );
        
    u\ReflectionUtility::showMethodDescription( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );

    u\DebugUtility::dump( $page );

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>