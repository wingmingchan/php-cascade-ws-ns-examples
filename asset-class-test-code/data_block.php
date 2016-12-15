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
    /*   
    // part 1: no multiple nodes
    $block = $service->getAsset(
        a\DataBlock::TYPE, "ec29d12c8b7ffe832dc7cebea81e066f" );
        
    $block2 = $service->getAsset(
        a\DataBlock::TYPE, "fd10a8778b7ffe832dc7cebe52acce74" );
        
    $xhtml = $service->getAsset(
        a\DataBlock::TYPE, "fd14defe8b7ffe832dc7cebee8bcf3f0" );
        
    //$block->setStructuredData( $block2->getStructuredData() );
    
    //$block->setText( "group;text-box", "Good News" )->edit();
    
    $xhtml->setXhtml( "<span class='italic'>This is meaningless!</span>" )->
        edit();
    $xhtml->replaceXhtmlByPattern(
        "/" . "<" . "p>([^<]+)<\/p>/", 
        "<div class='text_red'>$1</div>" )->edit();
    
    //echo u\StringUtility::boolToString( $xhtml->searchXhtml( "hello" ) ), BR;
    
    $id = "group;wysiwyg";
    echo u\StringUtility::boolToString( $block->isWYSIWYGNode( $id ) ), BR;
        
    //$block->copyDataTo( $block2 );
    //$block->displayDataDefinition();
    //echo u\StringUtility::getCoalescedString( $block->getXhtml() ), BR;
    //$block->displayXhtml();
    //$xhtml->displayXhtml();
    
    
    //echo "Here", BR;
    //echo u\StringUtility::boolToString( $xhtml->hasStructuredData() ), BR;
    
    //u\DebugUtility::dump( $block->getStructuredData()->toStdClass() );
    
    //$block->getDataDefinition()->dump();
    //u\DebugUtility::dump( $block->getIdentifiers() );

    $block->setBlock(
        "group;block-chooser",
        $cascade->getAsset(
            a\DataBlock::TYPE, "1f21e3268b7ffe834c5fe91e2e0a7b2d" ) )->
        setFile( "group;file-chooser" )-> 
        setPage( "group;page-chooser" )-> 
        setLinkable( "group;linkable-chooser" )-> 
        setSymlink( "group;symlink-chooser" )->
        
        setText( "group;text-box", "Some new text" )->
        edit();

    //u\DebugUtility::dump( $block->mapData()->toStdClass() );
    
    //echo $block->getType(), BR;

    //u\DebugUtility::dump( $block->getService() );
    //$block->getHostAsset()->dump();
    //u\DebugUtility::dump( $block->toStdClass() );
    //u\DebugUtility::dump( $block->getIdentifiers() );
    //$block->getDataDefinition()->dump();
    //echo $block->getDefinitionId(), BR;
    //echo $block->getDefinitionPath(), BR;
   
    //u\DebugUtility::dump( $block->getIdentifierNodeMap() );
    
    $id = "group;radio";
    
    if( $block->hasPossibleValues( $id ) )
        u\DebugUtility::dump( $block->getPossibleValues( $id ) );
  
    $id = "group;wysiwyg";
    
    if( $block->isText( $id ) )
    	echo $block->getText( $id ), BR;
    	
    echo u\StringUtility::getCoalescedString( $block->getTextNodeType( $id ) ), BR;
      
      
    if( $block2->isWYSIWYGNode( $id ) )
    {
        $block2->replaceByPattern(
            "/" . "<" . "p>([^<]+)<\/p>/", 
            "<div class='text_red'>$1</div>", 
            array( $id )
        )->edit();
    }
    else
        echo "Not WYSIWYG node", BR;
    // affects all text nodes    
    $block2->replaceText( "Wonderful", "Amazing" )->edit();
   
    //u\DebugUtility::dump( $block->searchText( "Amazing" ) );
    
    u\DebugUtility::dump( $block->searchWYSIWYGByPattern( "/<p>([^<]+)<\/p>/" ) );

    
    $id = "group;symlink-chooser";
    echo $block->getAssetNodeType( $id ), BR;
    echo $block->getNodeType( $id ), BR;

    if( $block->hasNode( $id ) && $block->isAsset( $id ) )
    {
        if( $block->isSymlinkChooserNode( $id ) )
        {
            echo u\StringUtility::getCoalescedString( $block->getSymlinkId( $id ) ), BR;
        }
    }
    
    $id = "group;symlink-chooser";
    
    if( $block->hasNode( $id ) && $block->isAsset( $id ) )
    {
    	echo $block->getAssetNodeType( $id ), BR;

        if( $block->getAssetNodeType( $id ) == c\T::SYMLINK )
        {
            echo u\StringUtility::getCoalescedString( $block->getSymlinkId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $block->getSymlinkPath( $id ) ), BR;
        }
    }
    
    $id = "group;page-chooser";
    
    if( $block->isAsset( $id ) )
    {
        if( $block->getAssetNodeType( $id ) == c\T::PAGE )
        {
            echo u\StringUtility::getCoalescedString( $block->getPageId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $block->getPagePath( $id ) ), BR;
        }
    }
    
    $id = "group;linkable-chooser";
    
    if( $block->isAsset( $id ) )
    {
        if( $block->getAssetNodeType( $id ) == c\T::LINKABLE )
        {
            echo u\StringUtility::getCoalescedString( $block->getLinkableId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $block->getLinkablePath( $id ) ), BR;
            
            //u\DebugUtility::dump( $block->getNode( $id )->toStdClass() );
            echo $block->getNodeType( $id ), BR;
        }
    }
    
    $id = "group;file-chooser";
    
    if( $block->isAsset( $id ) )
    {
        if( $block->getAssetNodeType( $id ) == "file" )
        {
            echo u\StringUtility::getCoalescedString( $block->getFileId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $block->getFilePath( $id ) ), BR;
        }
    }
    $id = "group;block-chooser";

    if( $block->isAsset( $id ) )
    {
        //echo $block->getAssetNodeType( $id ), BR;
        if( $block->isBlockChooserNode( $id ) )
        {
            echo u\StringUtility::getCoalescedString( $block->getBlockId( $id ) ), BR;
            echo u\StringUtility::getCoalescedString( $block->getBlockPath( $id ) ), BR;
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
*/

    $block = $service->getAsset(
        a\DataBlock::TYPE, "1f21cf0c8b7ffe834c5fe91e6dde13c2" );
    //$block->//appendSibling( "multiple-first;0" )->
        //createNInstancesForMultipleField( 4, "multiple-first;0" );
        //->
        //edit();
        
    //echo $block->getNumberOfSiblings( "multiple-first;0" ), BR;
    //$block->removeLastSibling( "multiple-first;0" );
    $block->swapData( "multiple-first;0", "multiple-first;2" );
/*
        
    // renew the object
    $block  = $block->getStructuredData();
    
    echo $block->getNumberOfChildren(), BR;
    echo $block->getNumberOfSiblings( "multiple-first;0" ), BR;
    
    echo u\StringUtility::boolToString(
        $block->isIdentifierOfFirstNode( "multiple-second;1" ) ), BR;
        
    echo u\StringUtility::boolToString(
        $block->isMultiple( "multiple-second;1" ) ), BR;
        
    $block->removeLastSibling( "multiple-first;0" )->getHostAsset()->edit();
    $block  = $block->getStructuredData();
    
    $block->swapData( "multiple-first;0", "multiple-first;1" )->getHostAsset()->edit();
    $block  = $block->getStructuredData();
*/
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\DataDefinitionBlock" );

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