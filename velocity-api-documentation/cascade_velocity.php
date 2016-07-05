<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$parent_folder_path = "/formats/velocity/api-documentation/com-hannonhill-cascade-velocity";

$data = array(

    // cascade comparison date tool
    array(
        "api-cascade-comparison-date-tool",
        "CascadeComparisonDateTool",
        "CascadeComparisonDateTool",
        "api-cascade-comparison-date-tool-script",
        array(
            "com.hannonhill.cascade.velocity.CascadeComparisonDateTool",
            "org.apache.velocity.tools.generic.ComparisonDateTool",
            "org.apache.velocity.tools.generic.DateTool",
            "org.apache.velocity.tools.generic.FormatConfig",
            "org.apache.velocity.tools.generic.LocaleConfig",
            "org.apache.velocity.tools.generic.SafeConfig"
        )
    ),
    

    // cascade field tool
    array(
        "api-cascade-field-tool",
        "CascadeFieldTool",
        "CascadeFieldTool",
        "api-cascade-field-tool-script",
        array(
            "com.hannonhill.cascade.velocity.CascadeFieldTool",
            "org.apache.velocity.tools.generic.FieldTool",
            "org.apache.velocity.tools.generic.SafeConfig"
        )
    ),
    
    // locator tool
    array(
        "api-locator-tool",
        "\$_ (LocatorTool)",
        "\$_ (LocatorTool)",
        "api-locator-tool-script",
        array(
            "com.hannonhill.cascade.velocity.LocatorTool"
        )
    ),
    
    // locator tool search query
    array(
        "api-locator-tool-search-query",
        "LocatorTool\$SearchQuery",
        "LocatorTool\$SearchQuery",
        "api-locator-tool-search-query-script",
        array(
            "com.hannonhill.cascade.velocity.LocatorTool\$SearchQuery"
        )
    ),
    
    // node sort tool
    array(
        "api-node-sort-tool",
        "LocatorTool\$SearchQuery",
        "LocatorTool\$SearchQuery",
        "api-node-sort-tool-script",
        array(
            "com.hannonhill.cascade.velocity.NodeSortTool",
            "org.apache.velocity.tools.generic.SortTool"
        )
    ),
    
    // property tool
    array(
        "api-property-tool",
        "PropertyTool",
        "PropertyTool",
        "api-property-tool-script",
        array(
            "com.hannonhill.cascade.velocity.PropertyTool"
        )
    ),
    
    // serializer tool
    array(
        "api-serializer-tool",
        "SerializerTool",
        "SerializerTool",
        "api-serializer-tool-script",
        array(
            "com.hannonhill.cascade.velocity.SerializerTool"
        )
    ),
    
    // string tool
    array(
        "api-string-tool",
        "StringTool",
        "StringTool",
        "api-string-tool-script",
        array(
            "com.hannonhill.cascade.velocity.StringTool"
        )
    ),
    

);
?>