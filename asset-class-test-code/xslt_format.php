<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';

try
{
    $id = '8d9b9fac8b7f085600ebf23e56c33fd1';
    $f  =  $cascade->getXsltFormat( $id );
    
    switch( $mode )
    {
        case 'all':

        case 'display':
            $f->display();
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $f->dump( true );
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo 
                c\L::ID . $f->getId() . BR .
                c\L::NAME . $f->getName() . BR .
                c\L::PARENT_FOLDER_ID . $f->getParentContainerId() . BR .
                c\L::PARENT_FOLDER_PATH . $f->getParentContainerPath() . BR .
                c\L::CREATED_DATE . $f->getCreatedDate() . BR .
                c\L::CREATED_BY . $f->getCreatedBy() . BR .
                c\L::LAST_MODIFIED_DATE . $f->getLastModifiedDate() . BR .
                c\L::LAST_MODIFIED_BY . $f->getLastModifiedBy() . BR .
                c\L::PATH . $f->getPath() . BR;
            
            if( $mode != 'all' )
                break;
           
        case 'set':
$xml = <<<XML
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output encoding="UTF-8" indent="yes" method="xml" omit-xml-declaration="no"/>
    
    <!-- identity template -->
    <xsl:template match="@*|node()" priority="-1">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>
    
    <xsl:template match="channel">
    <channel>
        <xsl:apply-templates select="title | link | description | image"/>
        <xsl:for-each select="item">
            <xsl:if test="position() &lt; 6">
                <item>
                    <xsl:copy-of select="node()"/>
                </item>
            </xsl:if>
        </xsl:for-each>
    </channel>
    </xsl:template>
    
</xsl:stylesheet>
XML;
            $f->setXML( $xml )->edit();
            $f->displayXML();
            
            echo $f->getService()->getMessage();
            
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
