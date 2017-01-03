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
    $site_name      = 'web-service-tutorial';
    $parent_folder  =
        $cascade->getAsset( a\Folder::TYPE, 'formats', $site_name );

    $script = 
"#if ( \$currentPagePath )
#set( \$path = \$currentPagePath.split( \"\/\") )
#set( \$root = \$path[ 0 ] )

#if( \$root != 'index' )
#set( \$root = \$root + '-folder' )
#end

<div id=\"velocity-storage\">
<div id=\"root-folder\">\$root</div>
</div>
#end";

    $script_format_name = 'global-information';
    $script_format      = $cascade->getScriptFormat( 'formats/' . $script_format_name, $site_name );

    if( is_null( $script_format ) )
    {
        $cascade->createScriptFormat(
            $parent_folder,
            $script_format_name,
            $script
        );
    }

    $xml =
<<<XSLTSCRIPT
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
exclude-result-prefixes="xsl" version="1.0" 
xmlns:node="http://www.upstate.edu/chanw/node" 
xmlns:str="http://xsltsl.org/string">

<xsl:include href="/formats/Upstate/library/node-processing"/>

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

<!-- site-title -->
<xsl:template match="//div[@id='site-title']">
<div id="site-title">
    <xsl:apply-templates select="//div[@id='hide-site-title']/node()"/>
</div>
</xsl:template>

<!-- site-search -->
<xsl:template match="//div[@id='show-site-search']">
<xsl:apply-templates select="//div[@id='hide-site-search']/node()"/>
</xsl:template>

<xsl:template match="//div[@id='show-site-title']">
<xsl:apply-templates select="//div[@id='site-title-for-title-element']/node()"/>
</xsl:template>

<!-- top-site-menu -->
<xsl:template match="//div[@id='menubar']">
<xsl:apply-templates select="//div[@id='hide-menubar']"/>
</xsl:template>

<xsl:template match="//div[@id='hide-menubar']">
<xsl:choose>
<xsl:when test="//div[@id='hide-menubar']/nav/ul[not(@id='homenav')]">
<nav id="mainnav">
<ul id="nav">
    <xsl:apply-templates select="//div[@id='hide-menubar']/nav/ul/li"/>
</ul>
</nav>
</xsl:when>
<!-- tabbed sites -->
<xsl:otherwise>
    <xsl:apply-templates select="//div[@id='hide-menubar']/node()"/>
</xsl:otherwise>
</xsl:choose>
</xsl:template>

<!-- remove empty ul for highlighted li -->
<xsl:template match="//div[@id='hide-menubar']/nav/ul/li/ul[not(node())]"/>

<xsl:template match="//div[@id='hide-menubar']/nav/ul/li">
<xsl:variable name="root-folder">
    <xsl:value-of select="//div[@id='root-folder']"/>
</xsl:variable>

<xsl:variable name="id">
    <xsl:value-of select="@id"/>
</xsl:variable>

<xsl:if test="\$id!='' and \$id=\$root-folder">
    <li>
        <xsl:attribute name="id"><xsl:value-of select="\$id"/></xsl:attribute>
        <xsl:attribute name="class">currentMenuItem</xsl:attribute>
        <xsl:apply-templates select="./node()"/>
    </li>
</xsl:if>

<xsl:if test="\$id='' or \$id!=\$root-folder">
    <xsl:choose>
        <!-- remove last separtor -->
        <xsl:when test="(position()=last()) and (@class='separator')"/>

        <!-- reconstruct li for empty ul child, removing ul -->
        <xsl:when test="./ul[not(node())]">
            <li>
                <a>
                    <xsl:attribute name="href"><xsl:value-of select="a/@href"/></xsl:attribute>
                    <xsl:value-of select="."/>
                </a>
            </li>
        </xsl:when>

        <xsl:otherwise>
            <xsl:copy-of select="."/>
        </xsl:otherwise>
    </xsl:choose>
</xsl:if>
</xsl:template>

<xsl:template match="//div[@id='show-javascript']">
<xsl:apply-templates select="//div[@id='hide-javascript']/node()"/>
</xsl:template>

<xsl:template match="//div[@id='show-style']">
<xsl:apply-templates select="//div[@id='hide-style']/node()"/>
</xsl:template>

<xsl:template match="//div[@id='show-theme']">
<xsl:apply-templates select="//div[@id='hide-theme']/node()"/>
</xsl:template>

<xsl:template match="//div[@id='show-footer-contact']">
<xsl:apply-templates select="//div[@id='hide-footer-contact'][position()=1]/node()"/>
</xsl:template>

<xsl:template match="//img">
<xsl:variable name="src" select="@src"/>
<xsl:copy>
    <xsl:attribute name="src">\$src</xsl:attribute>
    <xsl:copy-of select="@*[name() != 'href']"/>
    <xsl:copy-of select="./node()"/>
</xsl:copy>
</xsl:template>

<!-- clean up all the remaining junk -->
<xsl:template match="system-data-structure"/>

</xsl:stylesheet>
XSLTSCRIPT;

    $xslt_format_name = 'template-level-customizable';
    $xslt_format      = $cascade->getXsltFormat( 'formats/' . $xslt_format_name, $site_name );

    if( is_null( $xslt_format ) )
    {
        $cascade->createXsltFormat(
            $parent_folder,
            $xslt_format_name,
            $xml
        );
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