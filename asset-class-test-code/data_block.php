<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

/*
array(16) {
  [0]=>
  string(5) "group"
  [1]=>
  string(14) "group;text-box"
  [2]=>
  string(15) "group;text-area"
  [3]=>
  string(13) "group;wysiwyg"
  [4]=>
  string(14) "group;checkbox"
  [5]=>
  string(15) "group;checkbox2"
  [6]=>
  string(14) "group;dropdown"
  [7]=>
  string(11) "group;radio"
  [8]=>
  string(17) "group;multiselect"
  [9]=>
  string(14) "group;calendar"
  [10]=>
  string(15) "group;date-time"
  [11]=>
  string(18) "group;page-chooser"
  [12]=>
  string(18) "group;file-chooser"
  [13]=>
  string(19) "group;block-chooser"
  [14]=>
  string(21) "group;symlink-chooser"
  [15]=>
  string(22) "group;linkable-chooser"
}
*/
try
{
    // part 1: no multiple nodes
    $block = $service->getAsset(
        a\DataBlock::TYPE, "ec29d12c8b7ffe832dc7cebea81e066f" )->dump();
/* 

    $sd->setBlock(
        "group;block-chooser",
        $cascade->getAsset(
            a\DataBlock::TYPE, "1f21e3268b7ffe834c5fe91e2e0a7b2d" ) )->
        setFile( "group;file-chooser" )-> 
        setPage( "group;page-chooser" )-> 
        setLinkable( "group;linkable-chooser" )-> 
        setSymlink( "group;symlink-chooser" )->
        
        setText( "group;text-box", "Some new text" )->
        getHostAsset()->edit();

    //u\DebugUtility::dump( $sd->mapData()->toStdClass() );
    
    //echo $sd->getType(), BR;

    //u\DebugUtility::dump( $sd->getService() );
    //$sd->getHostAsset()->dump();
    //u\DebugUtility::dump( $sd->toStdClass() );
    //u\DebugUtility::dump( $sd->getIdentifiers() );
    //$sd->getDataDefinition()->dump();
    //echo $sd->getDefinitionId(), BR;
    //echo $sd->getDefinitionPath(), BR;
    
    //u\DebugUtility::dump( $sd->getIdentifierNodeMap() );
    
    $id = "group;radio";
    
    if( $sd->hasPossibleValues( $id ) )
        u\DebugUtility::dump( $sd->getPossibleValues( $id ) );
    
    $id = "group;wysiwyg";
    //echo $sd->getTextNodeType( $id ), BR;
    
    if( $sd->isWYSIWYGNode( $id ) )
    {
        $sd->replaceByPattern(
            "/<p>([^<]+)<\/p>/", 
            "<div class='text_red'>$1</div>", 
            array( $id )
        )->getHostAsset()->edit();
        // since the block has been updated, reload the structured data
        $sd = $block->getStructuredData();
    }
    else
        echo "Not WYSIWYG node", BR;
            
    // affects all text nodes    
    $sd->replaceText( "Wonderful", "Amazing" )->getHostAsset()->edit();
    $sd = $block->getStructuredData();
    
    //u\DebugUtility::dump( $sd->searchText( "Amazing" ) );
    
    u\DebugUtility::dump( $sd->searchWYSIWYGByPattern( "/<p>([^<]+)<\/p>/" ) );

    
    $id = "group;symlink-chooser";
    
    if( $sd->hasNode( $id ) && $sd->isAsset( $id ) )
    {
        if( $sd->isSymlinkChooserNode( $id ) )
        {
            echo u\StringUtility::getCoalescedString( $sd->getSymlinkId( $id ) ), BR;
        }
    }
    
    $id = "group;symlink-chooser";
    
    if( $sd->hasNode( $id ) && $sd->isAsset( $id ) )
    {
        if( $sd->getAssetNodeType( $id ) == c\T::SYMLINK )
        {
            echo u\StringUtility::getCoalescedString( $sd->getSymlinkId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $sd->getSymlinkPath( $id ) ), BR;
        }
    }
    
    $id = "group;page-chooser";
    
    if( $sd->isAsset( $id ) )
    {
        if( $sd->getAssetNodeType( $id ) == c\T::PAGE )
        {
            echo u\StringUtility::getCoalescedString( $sd->getPageId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $sd->getPagePath( $id ) ), BR;
        }
    }
    
    $id = "group;linkable-chooser";
    
    if( $sd->isAsset( $id ) )
    {
        if( $sd->getAssetNodeType( $id ) == c\T::LINKABLE )
        {
            //echo u\StringUtility::getCoalescedString( $sd->getLinkableId( $id ) ), BR;
            //echo u\StringUtility::getCoalescedString( $sd->getLinkablePath( $id ) ), BR;
            
            //u\DebugUtility::dump( $sd->getNode( $id )->toStdClass() );
            echo $sd->getNodeType( $id ), BR;
        }
    }
    
    $id = "group;file-chooser";
    
    if( $sd->isAsset( $id ) )
    {
        if( $sd->getAssetNodeType( $id ) == "file" )
        {
            echo u\StringUtility::getCoalescedString( $sd->getFileId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $sd->getFilePath( $id ) ), BR;
        }
    }
    
    $id = "group;block-chooser";
    
    if( $sd->isAsset( $id ) )
    {
        //echo $sd->getAssetNodeType( $id ), BR;
        if( $sd->isBlockChooserNode( $id ) )
        {
            echo u\StringUtility::getCoalescedString( $sd->getBlockId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $sd->getBlockPath( $id ) ), BR;
        }
    }
    */
    // part 2: multiple nodes
/*
array(11) {
  [0]=>
  string(16) "multiple-first;0"
  [1]=>
  string(16) "multiple-first;1"
  [2]=>
  string(16) "multiple-first;2"
  [3]=>
  string(16) "multiple-first;3"
  [4]=>
  string(6) "single"
  [5]=>
  string(17) "multiple-second;0"
  [6]=>
  string(17) "multiple-second;1"
  [7]=>
  string(5) "group"
  [8]=>
  string(28) "group;group-multiple-first;0"
  [9]=>
  string(18) "group;group-single"
  [10]=>
  string(29) "group;group-multiple-second;0"
}

    $block = $service->getAsset(
        a\DataBlock::TYPE, "1f21cf0c8b7ffe834c5fe91e6dde13c2" );
    $sd = $block->getStructuredData();

    $sd->appendSibling( "multiple-first;0" )->
        createNInstancesForMultipleField( 10, "multiple-first;0" )->
        getHostAsset()->edit();
        
    // renew the object
    $sd = $block->getStructuredData();
    
    echo $sd->getNumberOfChildren(), BR;
    echo $sd->getNumberOfSiblings( "multiple-first;0" ), BR;
    
    echo u\StringUtility::boolToString(
        $sd->isIdentifierOfFirstNode( "multiple-second;1" ) ), BR;
        
    echo u\StringUtility::boolToString(
        $sd->isMultiple( "multiple-second;1" ) ), BR;
        
    $sd->removeLastSibling( "multiple-first;0" )->getHostAsset()->edit();
    $sd = $block->getStructuredData();
    
    $sd->swapData( "multiple-first;0", "multiple-first;1" )->getHostAsset()->edit();
    $sd = $block->getStructuredData();
*/
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

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump();
*/
?>