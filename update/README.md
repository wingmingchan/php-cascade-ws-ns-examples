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
<p>If a string key is not a property defined in the WSDL, or if there is no <code>set</code> method defined for the property, then an exception will be thrown. Exceptions will also be thrown if the parameter is unacceptable for the invoked <code>set</code> method.</p>
<p>For assets that can be associated with metadata (blocks, files, folders, pages, and symlinks), string constants have been defined in classes like <code>Asset</code> and <code>DublinAwareAsset</code>. Use these constants to avoid typos and possible exceptions. Metadata is treated slightly differently. Parameters must be passed into <code>update</code> in a separate entry, using the string <code>metadata</code> as the key, and a sub-array as the value. For example:</p>
<pre>
    $admin->getAsset( a\Folder::TYPE, "e0eda35a8b7f08ee6d3c97dea0f6da4e" )->update(
        array(
            // the entry for metadata alone
            a\DublinAwareAsset::METADATA => array(
                // wired fields
                a\DublinAwareAsset::AUTHOR       => "Wing Ming",
                a\DublinAwareAsset::DISPLAY_NAME => "Struts 2 in Action",
                a\DublinAwareAsset::SUMMARY      => "Struts 2 in Action",
                // dynamic fields
                "exclude-from-menu"              => ""
            ),<br />
            // folder settings
            a\Asset::SHOULD_BE_PUBLISHED         => true,
            a\Asset::SHOULD_BE_INDEXED           => true,
            a\Asset::INCLUDE_IN_STALE_CONTENT    => true
        )
    );
</pre>
<p>Also note that identifiers of dynamic fields can be passed in as keys.</p>
<p>For pages and data definition blocks, besides property names, fully qualified identifiers can also be passed in as keys. For example:</p>
<pre>
    $admin->getAsset( a\DataBlock::TYPE, "0b3aaa208b7f08ee5a4fada2258d6fb9" )->update(
        // structured data nodes, with FQIs as keys
        "wysiwyg-group;wysiwyg-content" => "&lt;p&gt;Je voudrais boire de la bière.&lt;/p&gt;",
    );
</pre>