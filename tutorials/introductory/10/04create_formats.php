<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name      = 'web-service-test';
    $parent_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'formats', $site_name );
        
    $script = "#if ( \$currentPagePath )
    #set( \$path = \$currentPagePath.split( \"\/\") )
    #set( \$root = \$path[ 0 ] )

    #if( \$root != 'index' )
        #set( \$root = \$root + '-folder' )
    #end

<div id=\"velocity-storage\">
  <div id=\"root-folder\">\$root</div>
</div>
#end";
    
    $cascade->createFormat(
        $parent_folder,
        'global-information',
        a\ScriptFormat::TYPE,
        $script
    );
    
    $xml =
<<<XSLTSCRIPT
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
    exclude-result-prefixes="xsl" version="1.0">
    
    <xsl:output encoding="UTF-8" indent="yes" method="html" omit-xml-declaration="yes"/>
      
    <!-- identity template -->
    <xsl:template match="@*|node()" priority="-1">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>
    
    <xsl:template match="body//text()">
        <xsl:variable name="body-text"><xsl:value-of select="."/></xsl:variable>
    </xsl:template>
    
    <xsl:template match="//div[@id='storage']"/>
    <xsl:template match="//div[@id='velocity-storage']"/>
    <xsl:template match="//div[@id='show-page-style']"/>

    <!-- clean up all the remaining junk -->
    <xsl:template match="system-data-structure"/>

</xsl:stylesheet>
XSLTSCRIPT;

    $cascade->createFormat(
        $parent_folder,
        'template-level-customizable',
        a\XsltFormat::TYPE,
        "",
        $xml
    );
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