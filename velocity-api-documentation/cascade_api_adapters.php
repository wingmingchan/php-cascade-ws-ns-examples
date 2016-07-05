<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$parent_folder_path = "/formats/velocity/api-documentation/com-hannonhill-cascade-api-adapters";

$data = array(

    // dynamic metadata field
    array(
        "dynamic-metadata-field-api-adapter",
        "DynamicMetadataFieldImpl",
        "DynamicMetadataFieldImpl",
        "api-dynamic-metadata-field-impl-script",
        array(
            "com.hannonhill.cascade.api.adapters.DynamicMetadataFieldImpl"
        )
    ),
    
    // feed block
    array(
        "feed-block-api-adapter",
        "FeedBlockAPIAdapter",
        "FeedBlockAPIAdapter",
        "api-feed-block-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.FeedBlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // file
    array(
        "file-api-adapter",
        "FileAPIAdapter",
        "FileAPIAdapter",
        "api-file-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.FileAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PublishableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // folder
    array(
        "folder-api-adapter",
        "FolderAPIAdapter",
        "FolderAPIAdapter",
        "api-folder-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.FolderAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PublishableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // identifier
    array(
        "identifier-api-adapter",
        "IdentifierImpl",
        "IdentifierImpl",
        "api-identifier-impl-script",
        array(
            "com.hannonhill.cascade.api.adapters.IdentifierImpl"
        )
    ),
    
    // index block
    array(
        "index-block-api-adapter",
        "IndexBlockAPIAdapter",
        "IndexBlockAPIAdapter",
        "api-index-block-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.IndexBlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),

    // metadata
    array(
        "metadata-api-adapter",
        "MetadataAPIAdapter",
        "MetadataAPIAdapter",
        "api-metadata-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.MetadataAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter",
        )
    ),
    
    // page
    array(
        "page-api-adapter",
        "PageAPIAdapter",
        "PageAPIAdapter",
        "api-page-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.PageAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PublishableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // path
    array(
        "path-api-adapter",
        "PathImpl",
        "PathImpl",
        "api-path-impl-script",
        array(
            "com.hannonhill.cascade.api.adapters.PathImpl",
        )
    ),
    
    // path identifier
    array(
        "path-identifier-api-adapter",
        "PathIdentifierImpl",
        "PathIdentifierImpl",
        "api-path-identifier-impl-script",
        array(
            "com.hannonhill.cascade.api.adapters.PathIdentifierImpl",
            "com.hannonhill.cascade.api.adapters.IdentifierImpl"
        )
    ),
    
    // reference
    array(
        "reference-api-adapter",
        "ReferenceAPIAdapter",
        "ReferenceAPIAdapter",
        "api-reference-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.ReferenceAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // structured data node
    array(
        "structured-data-node-api-adapter",
        "StructuredDataNodeAPIAdapter",
        "StructuredDataNodeAPIAdapter",
        "api-structured-data-node-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.StructuredDataNodeAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // structured data node $1
    array(
        "structured-data-node-d1-api-adapter",
        "StructuredDataNodeAPIAdapter\$1",
        "StructuredDataNodeAPIAdapter\$1",
        "api-structured-data-node-d1-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.StructuredDataNodeAPIAdapter\$1",
        )
    ),
    
    // structured data node $2
    array(
        "structured-data-node-d2-api-adapter",
        "StructuredDataNodeAPIAdapter\$2",
        "StructuredDataNodeAPIAdapter\$2",
        "api-structured-data-node-d2-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.StructuredDataNodeAPIAdapter\$2",
        )
    ),
    
    // symlink
    array(
        "symlink-api-adapter",
        "SymlinkAPIAdapter",
        "SymlinkAPIAdapter",
        "api-symlink-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.SymlinkAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // text block
    array(
        "text-block-api-adapter",
        "TextBlockAPIAdapter",
        "TextBlockAPIAdapter",
        "api-text-block-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.TextBlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
    
    // xhtml data definition block
    array(
        "dd-block-api-adapter",
        "XHTMLDataDefinitionBlockAPIAdapter",
        "XHTMLDataDefinitionBlockAPIAdapter",
        "api-dd-block-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.XHTMLDataDefinitionBlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),

    // xml block
    array(
        "xml-block-api-adapter",
        "XMLBlockAPIAdapter",
        "XMLBlockAPIAdapter",
        "api-xml-block-adapter-script",
        array(
            "com.hannonhill.cascade.api.adapters.XMLBlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BlockAPIAdapter",
            "com.hannonhill.cascade.api.adapters.MetadataAwareAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.FolderContainedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.PermissionsCapableAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.NamedAssetAPIAdapter",
            "com.hannonhill.cascade.api.adapters.BaseAssetAPIAdapter"
        )
    ),
);
?>