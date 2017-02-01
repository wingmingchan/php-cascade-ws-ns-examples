<?php
namespace cascade_ws_extend;

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

class AssetTreeUtility
{
    const DEBUG = false;
    const DUMP  = false;

    public function __construct( a\Cascade $cascade )
    {
        $this->cascade = $cascade;
    }
        
    public function associateBlocksWithMetadataSet( a\Folder $folder, a\MetadataSet $ms )
    {
        // global function in global_functions.php
        $global_function_name = "assetTreeAssociateWithMetadataSet";
        
        $folder->getAssetTree()->traverse(
            array( 
                a\DataBlock::TYPE  => array( $global_function_name ),
                a\FeedBlock::TYPE  => array( $global_function_name ),
                a\IndexBlock::TYPE => array( $global_function_name ),
                a\TextBlock::TYPE  => array( $global_function_name ),
                a\XmlBlock::TYPE   => array( $global_function_name )
            ),
            array( 
                a\DataBlock::TYPE  => array( a\MetadataSet::TYPE => $ms ),
                a\FeedBlock::TYPE  => array( a\MetadataSet::TYPE => $ms ),
                a\IndexBlock::TYPE => array( a\MetadataSet::TYPE => $ms ),
                a\TextBlock::TYPE  => array( a\MetadataSet::TYPE => $ms ),
                a\XmlBlock::TYPE   => array( a\MetadataSet::TYPE => $ms )
            )
        );
        
        return $this;
    }
    
    private $cascade;
}
?>