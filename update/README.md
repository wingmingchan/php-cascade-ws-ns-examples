# php-cascade-ws-ns-examples/update
<p>Here I want to show how to use a single-liner (code with a single semi-colon) to update the settings, the data, and/or metadata, of an asset. Example:</p> 
<pre>
    $admin->getAsset( a\AssetFactory::TYPE, "d5614f418b7f08ee363559330f0af607" )->update(
        array(
            // asset factory data
            "description"             => "Test Asset Factory",
            "overwrite"               => true,
            "allowSubfolderPlacement" => true
        )
    );
</pre>
<p>The basic idea is that <code>update</code> takes an array parameter, an associative array (i.e., a map) storing string keys and referencing values of various types, turns the string keys into <code>set</code> methods, and executes the methods with the associated values as parameters to be passed into these methods. For the <code>update</code> method to work properly, the following three conditions must be met:</p>
<ul>
<li>A string key must be a property name defined in the WSDL</li>
<li>After the property name is turned into a <code>set</code> method name, the method must be defined in the library</li>
<li>A <code>set</code> method must take only one parameter, which is supplied as the value of the corresponding string key; the value can be anything</li>
</ul>