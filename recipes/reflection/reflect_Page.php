<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\ReflectionUtility::showMethodSignatures( "cascade_ws_asset\Page" );
        
/* outputs:

<ul>
<li>
<code>public cascade_ws_asset\Page::__construct( $service,  $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::appendSibling( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::createNInstancesForMultipleField( $number,  $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::displayDataDefinition()</code></li>
<li>
<code>public cascade_ws_asset\Page::displayXhtml()</code></li>
<li>
<code>public cascade_ws_asset\Page::edit( $wf = NULL,  $wd = NULL,  $new_workflow_name = "",  $comment = "",  $exception = 1 )</code></li>
<li>
<code>public cascade_ws_asset\Page::getAssetNodeType( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getBlockFormatMap( $configuration )</code></li>
<li>
<code>public cascade_ws_asset\Page::getBlockId( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getBlockPath( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getConfigurationSet()</code></li>
<li>
<code>public cascade_ws_asset\Page::getConfigurationSetId()</code></li>
<li>
<code>public cascade_ws_asset\Page::getConfigurationSetPath()</code></li>
<li>
<code>public cascade_ws_asset\Page::getContentType()</code></li>
<li>
<code>public cascade_ws_asset\Page::getContentTypeId()</code></li>
<li>
<code>public cascade_ws_asset\Page::getContentTypePath()</code></li>
<li>
<code>public cascade_ws_asset\Page::getDataDefinition()</code></li>
<li>
<code>public cascade_ws_asset\Page::getFileId( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getFilePath( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getIdentifiers()</code></li>
<li>
<code>public cascade_ws_asset\Page::getLastPublishedDate()</code></li>
<li>
<code>public cascade_ws_asset\Page::getLastPublishedBy()</code></li>
<li>
<code>public cascade_ws_asset\Page::getLinkableId( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getLinkablePath( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getMaintainAbsoluteLinks()</code></li>
<li>
<code>public cascade_ws_asset\Page::getMetadataSet()</code></li>
<li>
<code>public cascade_ws_asset\Page::getMetadataSetId()</code></li>
<li>
<code>public cascade_ws_asset\Page::getMetadataSetPath()</code></li>
<li>
<code>public cascade_ws_asset\Page::getMetadataStdClass()</code></li>
<li>
<code>public cascade_ws_asset\Page::getNodeType( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getNumberOfSiblings( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getPageConfigurationSet()</code></li>
<li>
<code>public cascade_ws_asset\Page::getPageId( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getPageLevelRegionBlockFormat()</code></li>
<li>
<code>public cascade_ws_asset\Page::getPagePath( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getPageRegion( $config_name,  $region_name )</code></li>
<li>
<code>public cascade_ws_asset\Page::getPageRegions( $config_name )</code></li>
<li>
<code>public cascade_ws_asset\Page::getPageRegionNames( $config_name )</code></li>
<li>
<code>public cascade_ws_asset\Page::getParentFolder()</code></li>
<li>
<code>public cascade_ws_asset\Page::getParentFolderId()</code></li>
<li>
<code>public cascade_ws_asset\Page::getParentFolderPath()</code></li>
<li>
<code>public cascade_ws_asset\Page::getPossibleValues( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getShouldBeIndexed()</code></li>
<li>
<code>public cascade_ws_asset\Page::getShouldBePublished()</code></li>
<li>
<code>public cascade_ws_asset\Page::getStructuredData()</code></li>
<li>
<code>public cascade_ws_asset\Page::getSymlinkId( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getSymlinkPath( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getText( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getTextNodeType( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::getWorkflow()</code></li>
<li>
<code>public cascade_ws_asset\Page::getXhtml()</code></li>
<li>
<code>public cascade_ws_asset\Page::hasConfiguration( $config_name )</code></li>
<li>
<code>public cascade_ws_asset\Page::hasIdentifier( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::hasNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::hasPageConfiguration( $config_name )</code></li>
<li>
<code>public cascade_ws_asset\Page::hasPageRegion( $config_name,  $region_name )</code></li>
<li>
<code>public cascade_ws_asset\Page::hasPhantomNodes()</code></li>
<li>
<code>public cascade_ws_asset\Page::hasStructuredData()</code></li>
<li>
<code>public cascade_ws_asset\Page::isAsset( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isAssetNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isBlockChooser( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isBlockChooserNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isCalendar( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isCalendarNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isCheckbox( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isCheckboxNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isDatetime( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isDatetimeNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isDropdown( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isDropdownNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isFileChooser( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isFileChooserNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isGroup( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isGroupNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isLinkableChooser( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isLinkableChooserNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isMultiLine( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isMultiLineNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isMultiSelector( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isMultiSelectorNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isPageChooser( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isPageChooserNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isMultiple( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isPublishable()</code></li>
<li>
<code>public cascade_ws_asset\Page::isRadio( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isRadioNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isRequired( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isSymlinkChooser( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isSymlinkChooserNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isTextBox( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isTextBoxNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isText( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isTextNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isWYSIWYG( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::isWYSIWYGNode( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::mapData()</code></li>
<li>
<code>public cascade_ws_asset\Page::publish( $destination = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::removeLastSibling( $identifier )</code></li>
<li>
<code>public cascade_ws_asset\Page::replaceByPattern( $pattern,  $replace,  $include = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::replaceXhtmlByPattern( $pattern,  $replace )</code></li>
<li>
<code>public cascade_ws_asset\Page::replaceText( $search,  $replace,  $include = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::searchText( $string )</code></li>
<li>
<code>public cascade_ws_asset\Page::searchTextByPattern( $pattern )</code></li>
<li>
<code>public cascade_ws_asset\Page::searchXhtml( $string )</code></li>
<li>
<code>public cascade_ws_asset\Page::searchWYSIWYGByPattern( $pattern )</code></li>
<li>
<code>public cascade_ws_asset\Page::setBlock( $identifier,  $block = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setContentType( $c,  $exception = 1 )</code></li>
<li>
<code>public cascade_ws_asset\Page::setFile( $identifier,  $file = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setLinkable( $identifier,  $linkable = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setMaintainAbsoluteLinks( $bool )</code></li>
<li>
<code>public cascade_ws_asset\Page::setMetadata( $m )</code></li>
<li>
<code>public cascade_ws_asset\Page::setPage( $identifier,  $page = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setRegionBlock( $config_name,  $region_name,  $block = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setRegionFormat( $config_name,  $region_name,  $format = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setRegionNoBlock( $config_name,  $region_name,  $no_block )</code></li>
<li>
<code>public cascade_ws_asset\Page::setRegionNoFormat( $config_name,  $region_name,  $no_format )</code></li>
<li>
<code>public cascade_ws_asset\Page::setShouldBeIndexed( $bool )</code></li>
<li>
<code>public cascade_ws_asset\Page::setShouldBePublished( $bool )</code></li>
<li>
<code>public cascade_ws_asset\Page::setStructuredData( $structured_data )</code></li>
<li>
<code>public cascade_ws_asset\Page::setSymlink( $identifier,  $symlink = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Page::setText( $identifier,  $text )</code></li>
<li>
<code>public cascade_ws_asset\Page::setXhtml( $xhtml )</code></li>
<li>
<code>public cascade_ws_asset\Page::swapData( $identifier1,  $identifier2 )</code></li>
<li>
<code>public cascade_ws_asset\Page::unpublish()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getCreatedBy()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getCreatedDate()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getDynamicField( $name )</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getDynamicFields()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getExpirationFolderId()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getExpirationFolderPath()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getExpirationFolderRecycled()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getLastModifiedBy()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getLastModifiedDate()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::getMetadata()</code></li>
<li>
<code>public cascade_ws_asset\Linkable::hasDynamicField( $name )</code></li>
<li>
<code>public cascade_ws_asset\Linkable::setExpirationFolder( $f )</code></li>
<li>
<code>public cascade_ws_asset\Linkable::setMetadataSet( $m )</code></li>
<li>
<code>public cascade_ws_asset\Linkable::setPageContentType( $c )</code></li>
<li>
<code>public static cascade_ws_asset\Linkable::getLinkable( $service,  $id_string )</code></li>
<li>
<code>public static cascade_ws_asset\Linkable::getLinkableType( $service,  $id_string )</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::getParentContainer()</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::getParentContainerId()</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::getParentContainerPath()</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::isDescendantOf( $container )</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::isInContainer( $c )</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::move( $new_parent,  $doWorkflow = false )</code></li>
<li>
<code>public cascade_ws_asset\ContainedAsset::rename( $new_name,  $doWorkflow = false )</code></li>
<li>
<code>public cascade_ws_asset\Asset::copy( $parent,  $new_name )</code></li>
<li>
<code>public cascade_ws_asset\Asset::display()</code></li>
<li>
<code>public cascade_ws_asset\Asset::dump( $formatted = false )</code></li>
<li>
<code>public cascade_ws_asset\Asset::getAudits( $type = "",  $start_time = NULL,  $end_time = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Asset::getId()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getIdentifier()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getName()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getPath()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getProperty()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getPropertyName()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getService()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getSiteId()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getSiteName()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getSubscribers()</code></li>
<li>
<code>public cascade_ws_asset\Asset::getType()</code></li>
<li>
<code>public cascade_ws_asset\Asset::publishSubscribers( $destination = NULL )</code></li>
<li>
<code>public cascade_ws_asset\Asset::reloadProperty()</code></li>
<li>
<code>public static cascade_ws_asset\Asset::getAsset( $service,  $type,  $id_path,  $site_name = NULL )</code></li>
</ul>
*/
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>