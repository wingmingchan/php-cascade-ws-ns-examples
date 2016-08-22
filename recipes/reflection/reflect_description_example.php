<?php
/* 
This program works for classes that are documented in a certain way. 
See the source of ReflectionUtility for an example.
*/

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\ReflectionUtility::showMethodDescription( "cascade_ws_AOHS\AssetOperationHandlerService", "getAudits" );
    
/* output:

<p>Gets the audits object after the call of readAudits().</p>
*/

    u\ReflectionUtility::showMethodExample( "cascade_ws_AOHS\AssetOperationHandlerService", "getAudits" );
    
/* outputs:

<pre>u\DebugUtility::dump( $service->getAudits() );</pre>
*/
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>