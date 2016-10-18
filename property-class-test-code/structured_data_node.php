<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

/*
array(12) {
  [0]=>
  string(16) "multiple-first;0"
  [1]=>
  string(16) "multiple-first;1"
  [2]=>
  string(6) "single"
  [3]=>
  string(17) "multiple-second;0"
  [4]=>
  string(17) "multiple-second;1"
  [5]=>
  string(17) "multiple-second;2"
  [6]=>
  string(17) "multiple-second;3"
  [7]=>
  string(5) "group"
  [8]=>
  string(28) "group;group-multiple-first;0"
  [9]=>
  string(28) "group;group-multiple-first;1"
  [10]=>
  string(18) "group;group-single"
  [11]=>
  string(29) "group;group-multiple-second;0"
}

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
	// multiple
	$block = $cascade->getAsset( a\DataBlock::TYPE, "1f21fcc48b7ffe834c5fe91e2704e2d0" );
	// everything
	//$block = $cascade->getAsset( a\DataBlock::TYPE, "1f21fb798b7ffe834c5fe91e7f6d784f" );
	//u\DebugUtility::dump( $block->getIdentifiers() );
	$sd    = $block->getStructuredData();
	$map   = $sd->getIdentifierNodeMap();
	
	$node = $map[ "group" ];
	//$node->setText( "10-17-2016" );
	//u\DebugUtility::dump( $node->toStdClass() );
	
	
	//$node->display()->dump();

/*	
	echo u\StringUtility::getCoalescedString( $node->getAssetType() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getBlockId() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getBlockPath() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getFileId() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getFilePath() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getLinkableId() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getLinkablePath() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getPageId() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getPagePath() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getSymlinkId() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getSymlinkPath() ), BR;
*/	
	//echo u\StringUtility::getCoalescedString( $node->getParentId() ), BR;
/*	
	echo $node->getIdentifier(), BR;
	
	u\DebugUtility::dump( $node->getItems() );
	u\DebugUtility::dump( $node->getPossibleValues() );
	echo u\StringUtility::boolToString( $node->getRecycled() ), BR;
	
	echo $node->getText(), BR;
	echo u\StringUtility::getCoalescedString( $node->getTextNodeType() ), BR;
	echo u\StringUtility::getCoalescedString( $node->getType() ), BR;
*/
/*	
	echo u\StringUtility::boolToString( $node->hasItem( "Maybe" ) ), BR;
	echo u\StringUtility::boolToString( $node->IsAsset() ), BR;
	echo u\StringUtility::boolToString( $node->isBlockChooser() ), BR;
	echo u\StringUtility::boolToString( $node->isCalendar() ), BR;
	echo u\StringUtility::boolToString( $node->isCheckbox() ), BR;
	echo u\StringUtility::boolToString( $node->isDatetime() ), BR;
	echo u\StringUtility::boolToString( $node->isDropdown() ), BR;
	echo u\StringUtility::boolToString( $node->isFileChooser() ), BR;
	echo u\StringUtility::boolToString( $node->isGroup() ), BR;
	echo u\StringUtility::boolToString( $node->isLinkableChooser() ), BR;
	echo u\StringUtility::boolToString( $node->isMultiLine() ), BR;
	//echo u\StringUtility::boolToString( $node->isMultiple() ), BR;
	//echo u\StringUtility::boolToString( $node->isMultiSelector() ), BR;
	//echo u\StringUtility::boolToString( $node->isPageChooser() ), BR;
	//echo u\StringUtility::boolToString( $node->isPageChooser() ), BR;
	//echo u\StringUtility::boolToString( $node->isRadio() ), BR;
	echo u\StringUtility::boolToString( $node->isRequired() ), BR;
	echo u\StringUtility::boolToString( $node->isSymlinkChooser() ), BR;
	echo u\StringUtility::boolToString( $node->isText() ), BR;
	echo u\StringUtility::boolToString( $node->isTextarea() ), BR;
	echo u\StringUtility::boolToString( $node->isTextBox() ), BR;
	echo u\StringUtility::boolToString( $node->isWYSIWYG() ), BR;
*/	
	//u\DebugUtility::dump( $node->getStructuredDataNodes() );
	
	//u\DebugUtility::dump( $node->getIdentifierNodeMap() );
	//u\DebugUtility::dump( $node->getChildren() );
	//u\DebugUtility::dump( $node->getDataDefinition() );
	$node->addChildNode( "group;group-multiple-second" );
	u\DebugUtility::dump( $node->toStdClass() );
	//$node->removeLastChildNode( "group;group-multiple-second" );
	//u\DebugUtility::dump( $node->toStdClass() );
	//echo u\StringUtillity::boolToString( $node->
	//u\DebugUtility::dump( $node->cloneNode()->toStdClass() );
	
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