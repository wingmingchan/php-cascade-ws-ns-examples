<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    // pdf/text-folder
    $folder   = $cascade->getAsset( a\Folder::TYPE, '205e12e68b7f08ee00470c64ff93a33a' );
    $settings = $folder->getWorkflowSettings();
    
    $settings->setInheritWorkflows( true );
    $folder->editWorkflowSettings( true, true );
    u\DebugUtility::dump( $folder->getWorkflowSettings()->toStdClass() );
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>