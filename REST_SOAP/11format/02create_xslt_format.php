<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name          = "about-test";
    $parent_folder_path = "_cascade/formats";
    $format_name        = "page_template";
    
    $format = $cascade->getXsltFormat(
        "$parent_folder_path/$format_name", $site_name );
    
    if( isset( $format ) )
        $cascade->deleteAsset( $format );
        
    $xml = '
<xsl:stylesheet
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" exclude-result-prefixes="xalan java" version="1.0"
	xmlns:java="http://xml.apache.org/xalan/java"
	xmlns:me="stylesheet"
	xmlns:xalan="http://xml.apache.org/xalan">
	<xsl:output encoding="UTF-8" indent="yes" method="html"/>
	<xsl:template match="@*|node()" priority="-1">
		<xsl:copy>
			<xsl:apply-templates select="@*|node()"/>
		</xsl:copy>
	</xsl:template>
</xsl:stylesheet>';
        
    $format = $cascade->createXsltFormat(
        $cascade->getAsset( a\Folder::TYPE, $parent_folder_path, $site_name ),
        $format_name,
        $xml
    );

    u\DebugUtility::dumpRESTCommands( $service );
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