<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\ReflectionUtility::showMethodSignatures( "ReflectionParameter" );
        
/* outputs:

<ul>
<li>
<code>public static ReflectionParameter::export( $function,  $parameter,  $return )</code></li>
<li>
<code>public ReflectionParameter::__construct( $function,  $parameter )</code></li>
<li>
<code>public ReflectionParameter::__toString()</code></li>
<li>
<code>public ReflectionParameter::getName()</code></li>
<li>
<code>public ReflectionParameter::isPassedByReference()</code></li>
<li>
<code>public ReflectionParameter::getDeclaringFunction()</code></li>
<li>
<code>public ReflectionParameter::getDeclaringClass()</code></li>
<li>
<code>public ReflectionParameter::getClass()</code></li>
<li>
<code>public ReflectionParameter::isArray()</code></li>
<li>
<code>public ReflectionParameter::allowsNull()</code></li>
<li>
<code>public ReflectionParameter::getPosition()</code></li>
<li>
<code>public ReflectionParameter::isOptional()</code></li>
<li>
<code>public ReflectionParameter::isDefaultValueAvailable()</code></li>
<li>
<code>public ReflectionParameter::getDefaultValue()</code></li>
</ul>
*/
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>