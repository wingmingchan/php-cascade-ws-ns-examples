<?php
/*
This program is used to set up all destinations with
new transports outside Global.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // transports in Global
    //$global_web_transport = $cascade->getAsset(
        //a\FtpTransport::TYPE, "57abc6cd8b7f0856006702a06dafeb80" );
    $global_www_transport = $cascade->getAsset(
        a\FtpTransport::TYPE, "6e0d1f298b7f0856015997e48a8179fc" );
        
    // transports in _common_assets site
    //$web_transport = $cascade->getAsset(
        //a\FtpTransport::TYPE, "b33b0f148b7f08ee1a35bdff2303edb5" );
    $www_transport = $cascade->getAsset(
        a\FtpTransport::TYPE, "b355b78e8b7f08ee1a35bdff460ed223" );
        
    //$web_des_subscribers = $global_web_transport->getSubscribers();  
    $www_des_subscribers = $global_www_transport->getSubscribers();  
/*    
    foreach( $web_des_subscribers as $web_des_subscriber )
    {
        $des = $web_des_subscriber->getAsset( $service );
        $des->setTransport( $web_transport )->edit();
    }
*/
    foreach( $www_des_subscribers as $www_des_subscriber )
    {
        $des = $www_des_subscriber->getAsset( $service );
        $des->setTransport( $www_transport )->edit();
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