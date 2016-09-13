<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $block = $cascade->getAsset( a\TextBlock::TYPE, "06e401898b7ffe83765c5582e367462b" );
    // get the Metadata object
    $m     = $block->getMetadata();
    $ms    = $m->getMetadataSet();
  
    // modify the defintion
    $ms->setTitleFieldRequired( true )->
         setTitleFieldVisibility( $ms::INLINE )->
         setDisplayNameFieldRequired( true )->
         setDisplayNameFieldVisibility( $ms::INLINE )->
         edit();
    
    echo "Author: ",            $m->isAuthorFieldRequired()           ? "required" : "not required", BR,
         "Display name: ",      $m->isDisplayNameFieldRequired()      ? "required" : "not required", BR,
         "End date: ",          $m->isEndDateFieldRequired()          ? "required" : "not required", BR,
         "Expiration folder: ", $m->isExpirationFolderFieldRequired() ? "required" : "not required", BR,
         "Keywords: ",          $m->isKeywordsFieldRequired()         ? "required" : "not required", BR,
         "Description: ",       $m->isMetaDescriptionFieldRequired()  ? "required" : "not required", BR,
         "Review date: ",       $m->isReviewDateFieldRequired()       ? "required" : "not required", BR,
         "Start date: ",        $m->isStartDateFieldRequired()        ? "required" : "not required", BR,
         "Summary: ",           $m->isSummaryFieldRequired()          ? "required" : "not required", BR,
         "Teaser: ",            $m->isTeaserFieldRequired()           ? "required" : "not required", BR,
         "Title: ",             $m->isTitleFieldRequired()            ? "required" : "not required", BR;
         
    $m->setAuthor( "Wing" )->
        setDisplayName( "Block" )->
        setEndDate( "2017-12-31T12:00:00" )->
        setKeywords( "Test, More Test" )->
        setMetaDescription( "This is just a test" )->
        setReviewDate( "2016-12-31T12:00:00" )->
        setStartDate( "2016-01-01T00:00:00" )->
        setSummary( "This is just a test" )->
        setTeaser( "This is just a test" )->
        setTitle( "This is just a test" )->
        getHostAsset()->
        setExpirationFolder( $cascade->getAsset( a\Folder::TYPE, "2401bc368b7ffe834c5fe91e0027a274" ) )->
        edit();
        
    echo "Author: ",               $m->getAuthor(), BR,
         "Display name: ",         $m->getDisplayName(), BR,
         "End date: ",             $m->getEndDate(), BR,
         "Expiration folder id: ", $block->getExpirationFolderId(), BR,
         "Keywords: ",             $m->getKeywords(), BR,
         "Description: ",          $m->getMetaDescription(), BR,
         "Review date: ",          $m->getReviewDate(), BR,
         "Start date: ",           $m->getStartDate(), BR,
         "Summary: ",              $m->getSummary(), BR,
         "Teaser: ",               $m->getTeaser(), BR,
         "Title: ",                $m->getTitle(), BR;

    //u\DebugUtility::dump( $m->toStdClass() );

    if( !$ms->getExpirationFolderFieldRequired() )
        $block->setExpirationFolder( NULL )->edit()->dump();
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