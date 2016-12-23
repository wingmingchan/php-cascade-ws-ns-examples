<?php
/*
This program shows how to mass-produce large amount of assets, in this case, pages.
This practice is convenient when we need to create these assets for documentation
purposes, for example.

There are a few things that are not obvious in this program:
1. It reads an XML file from a server. The XML file is published from Cascade and
contains table names.
2. An initial page named "cxml_aclentry" has already been set up, so that it is hooked up
with a format showing the number of records and a list of column names of that table.
The table name is fed into the format by using $currentPage.Name.
3. Once the initial page is set up properly, we just need to create copies out of this
page, using table names as page names.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	// read the list
	$url = "cascade_table_names.xml";
	$contents = file_get_contents( $url );
	$contents = str_replace( "<data>", "", $contents );
	$contents = str_replace( "</data>", "", $contents );
	$contents = str_replace( "[", "", $contents );
	$contents = str_replace( "]", "", $contents );
	$contents = str_replace( " ", "", $contents );
	$contents = strtolower( $contents );
	
	// get table names
	$table_names = u\StringUtility::getExplodedStringArray( ",", $contents );
	
	//u\DebugUtility::dump( $table_names );
	
	// "cxml_aclentry"
	$page   = $cascade->getAsset( a\Page::TYPE, "282f633b8b7f08ee1870341e57b47237" );
	$folder = $cascade->getAsset( a\Folder::TYPE, "280853688b7f08ee1870341e0a783d3c" );
	
	foreach( $table_names as $table_name )
	{
		// the first page exists already
		if( $table_name == "cxml_aclentry" )
			continue;
			
		// create a page for each table
		$new_page = $page->copy( $folder, $table_name );
		//$new_page = $cascade->getPage( $table_name, "cascade-database" );
		
		if( !is_null( $new_page ) )
			$new_page->getMetadata()->setTitle( $table_name )->
		    	setDisplayName( $table_name )->getHostAsset()->
		    	setText( "main-content-title", $table_name )->
		    	edit();
	}
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