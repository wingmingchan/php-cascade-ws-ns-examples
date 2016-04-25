<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$step = 2; // control flag

try
{
    $site_name         = 'web-service-tutorial';
    $global_role_name  = 'Manager';
    $site_role_name    = 'Site Test Role';
    $group_name        = 'web-service-tutorial-group';
    $username          = 'web-service-tutorial-user';
    $password          = '1234';
    
    $ms_container_name = 'Test Metadata Set Container';
    $folder_ms_name    = 'Folder';
    $page_ms_name      = 'Page';

    switch( $step )
    {
        case 1: // site
            $url = 'webapp.upstate.edu/web-service-tutorial';
    
            try
            {
                $cascade->getSite( $site_name );
                echo "The site $site_name already exists.";
            }
            catch( e\NoSuchSiteException $e )
            {
                $cascade->createSite(
                    $site_name,
                    $url,
                    c\T::FIFTEEN // expiration: 15 days
                );
                echo "The site $site_name has been created.";
            }
            break;
            
        case 2: // role
            try
            {
                $cascade->getRoleByName( $global_role_name );
                echo "The role $global_role_name already exists.";
            }
            catch( e\NullAssetException $e )
            {
                $cascade->createRole( $global_role_name, "global" );
                echo "The role $global_role_name has been created.";
            }

            try
            {
                $cascade->getRoleByName( $site_role_name );
                echo "The role $site_role_name already exists.";
            }
            catch( e\NullAssetException $e )
            {
                $cascade->createRole( $site_role_name, a\Site::TYPE );
                echo "The role $site_role_name has been created.";
            }
            break;
            
        case 3: // group
            if( is_null( $cascade->getGroup( $group_name ) ) && $cascade->hasRoleName( $site_role_name ) )
            {
                $cascade->createGroup( $group_name, $site_role_name );
                echo "The group $group_name has been created.";
            }
            else
            {
                echo "The group $group_name already exists.";
            }
            break;
            
        case 4: // user
            if( is_null( $cascade->getUser( $username ) ) )
            {
                $site        = $cascade->getAsset( a\Site::TYPE, $site_name );
                $group       = $cascade->getAsset( a\Group::TYPE, $group_name );
                $global_role = $cascade->getRoleAssetByName( $global_role_name );
                
                $cascade->
                    createUser(
                        $username,
                        $password,
                        $group,
                        $global_role
                    )->
                    enable()->
                    setDefaultGroup( $group )->
                    setDefaultSite( $site );                
                echo "The user $username has been created.";
            }
            else
            {
                echo "The user $username already exists.";
            }
            break;
            
        case 5: // metadata set container
            // note that "Metadata Sets" is not part of the path
            if( is_null( $cascade->getMetadataSetContainer( $ms_container_name, $site_name ) ) )
            {
                $cascade->createMetadataSetContainer(
                    $cascade->getAsset( a\MetadataSetContainer::TYPE, '/', $site_name ),
                    $ms_container_name );
                echo "The metadata set container $ms_container_name has been created.";
            }
            else
            {
                echo "The metadata set container $ms_container_name already exists.";
            }
            break;
            
        case 6: // metadata sets
            $ms_container = 
                $cascade->getAsset( a\MetadataSetContainer::TYPE, $ms_container_name, $site_name );
            
            // for folder
            if( is_null( $cascade->getMetadataSet( $ms_container_name . '/' . $folder_ms_name, $site_name ) ) )
            {
                $cascade->createMetadataSet(
                        $ms_container,
                        $folder_ms_name )->
                    setDisplayNameFieldVisibility( a\MetadataSet::INLINE )->
                    addField( 
                        'exclude-from-menu',      // field name
                        c\T::CHECKBOX,            // type
                        'Exclude from Menu Bar',  // label
                        false,                    // required
                        c\T::INLINE,              // visibility
                        "Yes"                     // possible value
                    )->
                    addField( 
                        'exclude-from-left',      // field name
                        c\T::CHECKBOX,            // type
                        'Exclude from Left Menu', // label
                        false,                    // required
                        c\T::INLINE,              // visibility
                        "Yes"                     // possible value
                    )->
                    addField( 
                        'show-intra-icon',        // field name
                        c\T::CHECKBOX,            // type
                        'Show Intra Icon',        // label
                        false,                    // required
                        c\T::INLINE,              // visibility
                        "Yes"                     // possible value
                    );    
                echo "The metadata set $folder_ms_name has been created." . BR;
            }
            else
            {
                echo "The metadata set $folder_ms_name already exists." . BR;
            }
            
            // for page
            if( is_null( $cascade->getMetadataSet( $ms_container_name . '/' . $page_ms_name, $site_name ) ) )
            {
                $folder_ms = $cascade->getAsset( a\MetadataSet::TYPE, $ms_container_name . '/' . $folder_ms_name, $site_name );
                
                $folder_ms->copy( $ms_container, $page_ms_name )->
                    addField( 
                        'displayed-as-submenu',   // field name
                        c\T::CHECKBOX,            // type
                        'Displayed As Submenu',   // label
                        false,                    // required
                        c\T::INLINE,              // visibility
                        "Yes"                     // possible value
                    )->
                    // move displayed-as-submenu up
                    swapFields( 'displayed-as-submenu', 'show-intra-icon' )->
                    swapFields( 'displayed-as-submenu', 'exclude-from-left' )->
                    addField( 
                        'category',               // field name
                        c\T::RADIO,               // type
                        'Category',               // label
                        false,                    // required
                        c\T::INLINE,              // visibility
                        "Feature;News;Normal"     // possible value
                    )->
                    setSelectedByDefault( 'category', 'Normal' )->
                    edit(); // commit setSelectedByDefault                    
                echo "The metadata set $page_ms_name has been created.";
            }
            else
            {
                echo "The metadata set $page_ms_name already exists.";
            }
            break;
            
        case 7: // folders
            $group = $cascade->getAsset( a\Group::TYPE, $group_name );
            
            // grant write access of Base Folder to group
            $cascade->grantAccess( 
                a\Folder::TYPE, '/', $site_name, // the base folder
                true,                            // applied to children
                $group,
                c\T::WRITE
            );
            
            // create folders, set metadata set, and access rights
            $folder_names = array(
                'templates', 'blocks', 'formats', 'images', 'files'
            );
            $base_folder  = 
                $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolder();
            $ms           =
                $cascade->getAsset( 
                    a\MetadataSet::TYPE, 
                    $ms_container_name . '/' . $folder_ms_name, $site_name );
    
            foreach( $folder_names as $folder_name )
            {
                $folder = $cascade->getFolder( $folder_name, $site_name );
                
                if( is_null( $folder ) )
                {
                    $folder = $cascade->
                        createFolder(
                            $base_folder, // parent folder
                            $folder_name )->
                        setMetadataSet( $ms )->
                        setShouldBeIndexed( false )->   // all not indexable
                        setShouldBePublished( false )-> // all not publishable
                        edit(); // commit!!!
                }
            
                // publishable folders
                if( $folder_name == 'images' || $folder_name == 'files' )
                {
                    $folder->setShouldBePublished( true )->edit(); // commit!!!
                }
        
                // read access only to templates and formats
                if( $folder_name == 'templates' || $folder_name == 'formats' )
                {
                    $cascade->grantAccess( 
                        a\Folder::TYPE, $folder_name, $site_name, // the folder
                        true, $group, c\T::READ );
                }
            }
            break;

        case 8: // formats
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
            $xslt_format      = $cascade->getScriptFormat( 'formats/' . $xslt_format_name, $site_name );
    
            if( is_null( $xslt_format ) )
            {
                $cascade->createXsltFormat(
                    $parent_folder,
                    $xslt_format_name,
                    $xml
                );
            }
            break;
        
        case 9: // text blocks
            $parent_folder  =
                $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
                
            $code = "<!--#passthrough<?php $pagetitle = 'Faculty Listing';
require_once('faculty/script/faculty_utilities.php');
echo \$pagetitle;
?>#passthrough-->";
        
            $text_block_name = 'title';
            $text_block = $cascade->getTextBlock( 'blocks/' . $text_block_name, $site_name );
            
            if( is_null( $text_block ) )
            {
                $cascade->createTextBlock(
                    $parent_folder,
                    $text_block_name,
                    $code );
            }

            $code = "<div id=\"logo\"></div>";
    
            $text_block_name = 'logo';
            $text_block = $cascade->getTextBlock( 'blocks/' . $text_block_name, $site_name );

            if( is_null( $text_block ) )
            {
                $cascade->createTextBlock(
                    $parent_folder,
                    $text_block_name,
                    $code );
            }
            break;
            
        case 10: // templates
            $parent_folder  =
                $cascade->getAsset( a\Folder::TYPE, 'templates', $site_name );
            $template_format =
                $cascade->getAsset( a\XsltFormat::TYPE, 'formats/template-level-customizable', $site_name );
            $velocity_format =
                $cascade->getAsset( a\ScriptFormat::TYPE, 'formats/global-information', $site_name );
            $logo_block =
                $cascade->getAsset( a\TextBlock::TYPE, 'blocks/logo', $site_name );
            
            $xml = "<html>
<head>
<meta content=\"text/html;charset=utf-8\" http-equiv=\"Content-Type\"/>
<title><system-region name=\"PAGE TITLE\"/></title>
</head>
<body>
<system-region name=\"GOOGLE ANALYTIC\"/>
<system-region name=\"STORAGE\"/>
<system-region name=\"VELOCITY STORAGE\"/>
<div class=\"clearfix\" id=\"outmostwrapper\">
<div class=\"clearfix\" id=\"outerwrapper\">
<div id=\"accessibility\"><a href=\"#button\">Menu</a> <a href=\"#content\">Skip to Content</a></div>
<div class=\"clearfix\" id=\"wrapper\">
<header class=\"clearfix\" id=\"header\"><!-- first row -->
<system-region name=\"HOSTED HEADER\"/>
<div id=\"globalnav-wrapper\">
<nav id=\"globalnav-container\"><system-region name=\"GLOBAL NAVIGATION\"/></nav>
<!-- end globalnav_container -->
</div>
<!-- end globalnav_wrapper -->
<div class=\"clearfix\" id=\"logo-sitetitle-search\">
<div id=\"logo\"><system-region name=\"LOGO\"/></div>
<div id=\"site-title\"></div>
<!-- end site_title -->
<div id=\"search-print\"><system-region name=\"SEARCH PRINT\"/></div>
<!-- end search-print -->
</div>
<!-- end logo-sitetitle-search -->
<div class=\"clearfix\" id=\"menubar\"></div>
<!-- end menubar -->
</header>
<!-- end header -->
<div id=\"main-body\">
<div class=\"clearfix\" id=\"breadcrumb\"><system-region name=\"BREADCRUMB\"/><div id=\"show-site-search\"></div></div>
<div class=\"clearfix\" id=\"textbox\">
<div id=\"left-column\"></div>
<div id=\"right-column\"></div>
<div id=\"center-column\"><a name=\"content\"></a><!-- for three-column layout -->
<div id=\"center-column-content\">
<system-region name=\"MEDIA\"/>
<system-region name=\"TOP GRAPHICS\"/>

<!--startprint-->
<system-region name=\"REMOTE INCLUDE\"/>
<system-region name=\"DEFAULT\"/>
<!--stopprint-->

</div><!-- end center-column-content-->
</div><!-- end center-column -->
<!-- end textbox -->
</div>
<!-- end main-body -->
<div class=\"pad5\"></div>
<footer id=\"footer\"><!-- globalfooter -->
<div class=\"clearfix\" id=\"footer-content\"><system-region name=\"FOOTER NAVIGATION\"/> 
<div id=\"last-modified\"><system-region name=\"LAST MODIFIED\"/> <div id=\"show-footer-contact\"></div></div>
</div>
</footer>
</div>
<!-- end footer_content -->
<!-- end footer -->
</div>
<!-- end wrapper -->
<div class=\"clr\"></div>
</div>
<!-- end outerwrapper -->
</div>
<!-- end outmostwrapper -->
<div class=\"clr pad10\"></div>
<system-region name=\"SPECTATE TRACKING\"/>
</body>
</html>
";            

            $template_name = 'three-columns';
            $template      = $cascade->getTemplate( 'templates/' . $template_name, $site_name );
            
            if( is_null( $template ) )
            {
                // create desktop template
                $cascade->createTemplate(
                        $parent_folder,
                        $template_name,
                        $xml
                    )->setFormat( $template_format )->
                    setPageRegionFormat( "VELOCITY STORAGE", $velocity_format )->
                    setPageRegionBlock( "LOGO", $logo_block )->
                    edit();
            }
    
            // create xml template
            $xml = "<system-region name=\"DEFAULT\"/>";
            
            $template_name = 'xml';
            $template      = $cascade->getTemplate( 'templates/' . $template_name, $site_name );
            
            if( is_null( $template ) )
            {
                $cascade->createTemplate(
                    $parent_folder,
                    $template_name,
                    $xml
                );
            }
            break;
            
        case 11: // config set container and config set
            $desktop_template = 
                $cascade->getAsset(
                    a\Template::TYPE, 'templates/three-columns', $site_name );
            $xml_template     = 
                $cascade->getAsset( a\Template::TYPE, 'templates/xml', $site_name );
        
            // create a text block to be attached to a region at the config level
            $block_folder  =
                $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
            $code = "<div id='top-graphics'>Top Graphics</div>";
        
            $block_name = 'top-graphics';
            $block      = $cascade->getTextBlock( 'blocks/' . $block_name, $site_name );
            
            if( is_null( $block ) )
            {
                $block = $cascade->createTextBlock(
                    $block_folder,
                    $block_name,
                    $code );
            }
            
            $csc_name = 'Test Configuration Set Container';
            $csc      = $cascade->getPageConfigurationSetContainer( $csc_name, $site_name );
        
            if( is_null( $csc ) )
            {
                // create configuration set container
                $csc = $cascade->createPageConfigurationSetContainer(
                    $cascade->getAsset( 
                        a\PageConfigurationSetContainer::TYPE, '/', $site_name ),
                    'Test Configuration Set Container'
                );
            }
            
            $pcs_name = 'Three Columns';
            $pcs      = $cascade->getPageConfigurationSet( $csc_name . '/' . $pcs_name, $site_name );
    
            if( is_null( $pcs ) )
            {
                // create configuration set with default configuration
                $pcs = $cascade->createPageConfigurationSet(
                    $csc,              // parent container
                    $pcs_name,         // configuration set name
                    'Desktop',         // default configuration name
                    $desktop_template, // template
                    '.php',            // file extension
                    c\T::HTML          // serialization type
                )->
                // attach a block to a region at config level
                setConfigurationPageRegionBlock( 
                    'Desktop', 'TOP GRAPHICS', $block )->
                edit();
                // add xml configuration
                $pcs->addPageConfiguration( 'XML', $xml_template, '.xml', c\T::XML );        
            }
            break;
            
        case 12: // transport container and transport
            $transport_container_name = 'Test Transport Container';
            $transport_container      = $cascade->getTransportContainer( $transport_container_name, $site_name );
        
            if( is_null( $transport_container ) )
            {
                // create transport container
                $transport_container = $cascade->createTransportContainer(
                    $cascade->getAsset( a\TransportContainer::TYPE, '/', $site_name ),
                        $transport_container_name
                );
            }
    
            $transport_name = 'webapp-ftp';
            $transport      = $cascade->getFtpTransport( $transport_container_name . '/' . $transport_name, $site_name );
            
            if( is_null( $transport ) )
            {
                // create ftp transport
                $ftp_transport = $cascade->createFtpTransport(
                    $transport_container, // parent container
                    $transport_name,
                    'cascade',            // host
                    '123',                // port
                    'test',               // username
                    'test'                // password
                )->setDoPASV( true )->edit();
               }
            break;
            
        case 13: // destination container and destination
            $destination_container_name = 'Test Destination Container';
            $destination_container      = $cascade->getSiteDestinationContainer( $destination_container_name, $site_name );
            
            if( is_null( $destination_container ) )
            {
                // create destination container
                $destination_container = $cascade->createSiteDestinationContainer(
                    $cascade->getAsset( 
                        a\SiteDestinationContainer::TYPE, '/', $site_name ),
                    $destination_container_name
                );
            }
            
            $ftp_transport    = $cascade->getAsset( a\FtpTransport::TYPE, 'Test Transport Container/webapp-ftp', $site_name );
            $destination_name = 'Web-Service-tutorial-Web';
            $destination      = $cascade->getSiteDestinationContainer( $destination_container_name . '/' . $destination_name, $site_name );
    
            if( is_null( $destination ) )
            {
                // create destination
                $destination = $cascade->createDestination(
                    $destination_container,
                    $destination_name,
                    $ftp_transport
                )->
                enable()->
                addGroup( $cascade->getAsset( a\Group::TYPE, $group_name ) )->
                edit();
            }
            break;
            
        case 14: // data definition container and data definition
            $dd_container_name = 'Test Data Definition Container';
            $dd_container      = $cascade->getDataDefinitionContainer( $dd_container_name, $site_name );
        
            if( is_null( $dd_container ) )
            {
                // create data definition  container
                $dd_container = $cascade->createDataDefinitionContainer(
                    $cascade->getAsset( 
                        a\DataDefinitionContainer::TYPE, '/', $site_name ),
                    $dd_container_name
                );
            }
            
            $dd_name = 'Page';
            $dd      = $cascade->getDataDefinition( $dd_container_name . '/' . $dd_name, $site_name );
        
            $xml = 
"<system-data-structure>
    <text wysiwyg=\"true\" identifier=\"wysiwyg-content\" 
    label=\"Content\"/>
</system-data-structure>";

            if( is_null( $dd ) )
            {
                // create a data definition for pages
                $cascade->createDataDefinition(
                    $dd_container,
                    $dd_name,
                    $xml );
            }

            $dd_name = 'Simple Text';
            $dd      = $cascade->getDataDefinition( $dd_container_name . '/' . $dd_name, $site_name );

            $xml = 
"<system-data-structure>
    <text identifier=\"text\"/>
</system-data-structure>";

            if( is_null( $dd ) )
            {
                // create a data definition for blocks
                $cascade->createDataDefinition(
                    $dd_container,
                    $dd_name,
                    $xml );
            }
            break;
            
        case 15: // content type container and content type
            $ct_container_name = 'Test Content Type Container';
            $ct_container      = $cascade->getContentTypeContainer( $ct_container_name, $site_name );
            
            if( is_null( $ct_container ) )
            {
                // create content type container
                    $ct_container = $cascade->createContentTypeContainer(
                        $cascade->getAsset( 
                            a\ContentTypeContainer::TYPE, '/', $site_name ),
                        $ct_container_name
                    );
            }
            
            $ct_name = 'Normal XHTML';
            $ct      = $cascade->getContentType( $ct_container_name . '/' . $ct_name, $site_name );
            
            if( is_null( $ct ) )
            {
                // create content type without data definition
                $cascade->createContentType(
                    $ct_container,
                    $ct_name,
                    $cascade->getAsset( 
                        a\PageConfigurationSet::TYPE, 
                        'Test Configuration Set Container/Three Columns', $site_name ),
                    $cascade->getAsset(
                        a\MetadataSet::TYPE,
                        'Test Metadata Set Container/Page', $site_name )
                );
            }
            
            $ct_name = 'Three Columns';
            $ct      = $cascade->getContentType( $ct_container_name . '/' . $ct_name, $site_name );
            
            if( is_null( $ct ) )
            {
                // create content type with a data definition
                $cascade->createContentType(
                    $ct_container,
                    $ct_name,
                    $cascade->getAsset( 
                        a\PageConfigurationSet::TYPE, 
                        'Test Configuration Set Container/Three Columns', $site_name ),
                    $cascade->getAsset(
                        a\MetadataSet::TYPE,
                        'Test Metadata Set Container/Page', $site_name ),
                    $cascade->getAsset(
                        a\DataDefinition::TYPE,
                        'Test Data Definition Container/Page', $site_name )
                );
            }
            break;
            
        case 16: // XHTML block and data definition block
            $block_name = 'xhtml-block';
            $block      = $cascade->getDataBlock( 'blocks/' . $block_name, $site_name );
            
            if( is_null( $block ) )
            {
                // create an xhtml block to be attached to a region at the page level
                $block_folder =
                    $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
                $code = "<p>Some content.</p>";
        
                $cascade->createXhtmlBlock(
                    $block_folder,
                    $block_name,
                    $code );
            }
            
            $block_name = 'simple-text-block';
            $block      = $cascade->getDataBlock( 'blocks/' . $block_name, $site_name );
            
            if( is_null( $block ) )
            {
                // create a data definition block 
                // to be attached to a region at the page level
                $data_definition =
                    $cascade->getAsset( 
                        a\DataDefinition::TYPE, 
                        'Test Data Definition Container/Simple Text', $site_name );
                $block_folder =
                    $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
                $cascade->createDataDefinitionBlock(
                    $block_folder,
                    $block_name,
                    $data_definition )->
                setText( 'text', 'Some content for the data block.' )->
                edit();
            }        
            break;
            
        case 17: // pages
            $base_folder = $cascade->getAsset( a\Folder::TYPE, '/', $site_name );
            $page_name = 'index';
            $page      = $cascade->getPage( $page_name, $site_name );
            
            if( is_null( $page ) )
            {
                $ct = $cascade->getAsset( 
                    a\ContentType::TYPE, 
                    'Test Content Type Container/Normal XHTML', $site_name );

                // create an xhtml page
                $code = "<p>Some content for index.</p>";
                $cascade->createXhtmlPage(
                    $base_folder,
                    $page_name,
                    $code,
                    $ct
                )->
                setRegionBlock(
                    'Desktop',       // config name
                    'SEARCH PRINT',  // region name
                    // the block
                    $cascade->getAsset( 
                        a\DataBlock::TYPE, 'blocks/simple-text-block', $site_name )
                )->edit();
            }
            
            $page_name = 'test';
            $page      = $cascade->getPage( $page_name, $site_name );

            if( is_null( $page ) )
            {
                $ct = $cascade->getAsset( 
                    a\ContentType::TYPE, 
                    'Test Content Type Container/Three Columns', $site_name );
                    
                $cascade->createDataDefinitionPage(
                    $base_folder,
                    $page_name,
                    $ct
                )->
                // attach block
                setRegionBlock(
                    'Desktop',  // config name
                    'STORAGE',  // region name
                    // the block
                    $cascade->getAsset( 
                        a\DataBlock::TYPE, 'blocks/xhtml-block', $site_name )
                )->edit();
            }
            break;
            
        case 18: // asset factory container and asset factory
            $af_container_name = 'Site Managers';
            $af_container      = $cascade->getAssetFactoryContainer( $af_container_name, $site_name );
        
            if( is_null( $af_container ) )
            {
                // create asset factory container
                $af_container = $cascade->createAssetFactoryContainer(
                    $cascade->getAsset( 
                        a\AssetFactoryContainer::TYPE, '/', $site_name ),
                    $af_container_name
                );
            }
            
            $group = $cascade->getAsset( a\Group::TYPE, $group_name );
            
            // grant access to container
            $ari = $cascade->getAccessRights( 
                a\AssetFactoryContainer::TYPE, $af_container_name, $site_name );
            $ari->addGroupReadAccess( $group );     // read access
            $cascade->setAccessRights( $ari );
            
            $ba_folder_name = '_base-assets';
            $ba_folder      = $cascade->getFolder( $ba_folder_name, $site_name );
            
            if( is_null( $ba_folder ) )
            {
                $base_folder = 
                    $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolder();
                
                // create base assets folder
                $ba_folder = 
                    $cascade->
                        createFolder(
                            $base_folder, // parent folder
                            $ba_folder_name )->
                        setShouldBeIndexed( false )->   // all not indexable
                        setShouldBePublished( false )-> // all not publishable
                        edit(); // commit!!!
            }
    
            $ba_page_name = 'new-page';
            $ba_page      = $cascade->getPage( $ba_folder_name . '/' . $ba_page_name, $site_name );
            
            if( is_null( $ba_page ) )
            {
                // create base page
                $ba_page = $cascade->getAsset( a\Page::TYPE, 'test', $site_name )->
                    copy( $ba_folder, 'new-page' );
            }
            
            $af_name = 'New Page';
            $af      = $cascade->getAssetFactory( $af_container_name . '/' . $af_name, $site_name );
            
            if( is_null( $af ) )
            {
                // create asset factory
                $af =
                    $cascade->
                        createAssetFactory(
                            $af_container, // container
                            $af_name,      // name
                            a\Page::TYPE,  // asset type
                            c\T::NONE      // workflow mode
                        )->
                        setBaseAsset( $ba_page )->
                        addGroup( $group )->
                        edit();
            }
            break;
        
        case 19: // index blocks
            $block_folder  =
                $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
            $file_folder   =
                $cascade->getAsset( a\Folder::TYPE, 'files', $site_name );
            $ct            = $cascade->getAsset( 
                a\ContentType::TYPE, 
                'Test Content Type Container/Normal XHTML', $site_name );
    
            $block_name = 'normal-xhtml-index';
            $block      = $cascade->getIndexBlock( 'blocks/' . $block_name, $site_name );
            
            if( is_null( $block ) )
            {
                // create a content type index block
                $cib = $cascade->createContentTypeIndexBlock(
                    $block_folder,
                    $block_name,
                    $ct
                );
            }
    
            $block_name = 'folder-index';
            $block      = $cascade->getIndexBlock( 'blocks/' . $block_name, $site_name );
            
            if( is_null( $block ) )
            {
                // create a folder index block
                $cib = 
                    $cascade->createFolderIndexBlock(
                        $block_folder,
                        $block_name,
                        $file_folder
                    )->
                    setDepthOfIndex( 5 )->
                    setIndexFiles( true )->
                    setIndexPages( true )->
                    setFolder(
                        // Base Folder
                        $cascade->getAsset( a\Folder::TYPE, '/', $site_name ) 
                    )->
                    edit();
            }        
            break;
            
        case 20: // files
            $images_folder = 
                $cascade->getAsset( a\Folder::TYPE, 'images', $site_name );
            $files_folder  = $cascade->getAsset( a\Folder::TYPE, 'files', $site_name );
            
            $css = array(
                "global.css" => "http://www.upstate.edu/assets/global.css",
                "2009-theme.css" => "http://www.upstate.edu/assets/2009-theme.css"
            );
            
            $images = array(
                "rwd-upstate-logo.jpg" => "http://www.upstate.edu/assets/images/rwd-upstate-logo.jpg",
                "hloa.jpg" => "http://www.upstate.edu/specialevents/images/hloa.jpg"
            );
            
            $global_css = $cascade->getFile( 'files/global.css', $site_name );
            $theme_css  = $cascade->getFile( 'files/2009-theme.css', $site_name );
            
            if( is_null( $global_css ) && is_null( $theme_css ) )
            {
                // create css
                foreach( $css as $file_name => $url )
                {
                    $cascade->createFile( 
                        $files_folder,            // parent
                        $file_name,               // filename
                        file_get_contents( $url ) // text
                    );
                }
            }
            
            $logo = $cascade->getFile( 'images/rwd-upstate-logo.jpg', $site_name );
            $hloa = $cascade->getFile( 'images/hloa.jpg', $site_name );
            
            if( is_null( $logo ) && is_null( $hloa ) )
            {
                // create images
                foreach( $images as $file_name => $url )
                {
                    $cascade->createFile( 
                        $images_folder, 
                        $file_name,
                        "",                       // no text
                        file_get_contents( $url ) // binary data
                    );
                }
            }
            break;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>