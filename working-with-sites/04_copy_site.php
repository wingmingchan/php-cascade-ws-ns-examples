<?php 
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'cascade-database';
    $url       = 'webapp.upstate.edu/' . $site_name;
    
    try
    {
        $cascade->getSite( $site_name );
        echo "The site $site_name already exists.";
    }
    catch( e\NoSuchSiteException $e )
    {
    	$seed_site = $cascade->getSite( "_rwd_seed" );
        $cascade->copySite( $seed_site, $site_name, 20 );
        echo "The site $site_name has been created.";
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