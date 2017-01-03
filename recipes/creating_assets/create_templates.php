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