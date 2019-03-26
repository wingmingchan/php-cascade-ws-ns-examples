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
    $site_name = "cascade-admin-webapp";
    $site      = $admin->getSite( $site_name );

    $site->setCssFile(
        // CSS file
        $cascade->getAsset( a\File::TYPE,  '081d805b8b7ffe8339ce5d1303b53a50' ),
        // CSS classes
        'leftobject,rightobject,center,centerobject' )->
        // turn on link check
        setLinkCheckerEnabled( true )->
        // external links
        setExternalLinkCheckOnPublish( true )->
        // recycle bin
        setRecycleBinExpiration( a\Site::NEVER )->
        // starting page
        setStartingPage( 
            $cascade->getAsset( a\Page::TYPE, 
                '1f2376798b7ffe834c5fe91ead588ce1' ) )->
        edit();
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