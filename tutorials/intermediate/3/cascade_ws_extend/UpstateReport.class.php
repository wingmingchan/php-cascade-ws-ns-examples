<?php
namespace cascade_ws_extend;

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

class UpstateReport extends a\Report
{
    const DEBUG = false;
    const DUMP  = false;

    public function __construct( a\Cascade $cascade )
    {
        // pass the $cascade object to the parent
        parent::__construct( $cascade );
        $this->cascade = $cascade;
    }
    
    public function reportNumberOfTemplates()
    {
        return $this->traverse( a\Template::TYPE, "assetTreeReportNumberOfTemplates" );
    }
    
    public function reportTemplateFormatPaths()
    {
        return $this->traverse( a\Template::TYPE, "assetTreeReportTemplateFormatPaths" );
    }
    
    public function reportTemplatePaths()
    {
        return $this->traverse( a\Template::TYPE, "assetTreeReportTemplatePaths" );
    }
    
    private function traverse( string $type, string $func )
    {
        $my_root = $this->getRoot();
        
        if( !isset( $my_root ) )
            throw new e\ReportException( c\M::ROOT_FOLDER_NOT_SET );

        $my_at                 = $my_root->getAssetTree();
        $my_cache              = $this->getCache();
        $my_functions          = array();
        $my_functions[ $type ] = array( $func );
        $my_params             = array();
        $my_params[ 'cache' ]  = $my_cache;
        $my_results            = $this->getResults();
        $my_results[ $type ]   = array();
        
        $my_at->traverse(
            $my_functions,
            $my_params,
            $my_results
        );
        return $my_results;
    }  
    private $cascade;
}
?>