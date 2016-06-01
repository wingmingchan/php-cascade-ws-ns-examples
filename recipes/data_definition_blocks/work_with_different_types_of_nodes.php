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
    $dd_block = $cascade->getAsset( 
        a\DataDefinitionBlock::TYPE, "a40972818b7f0856011c5ec6864706c7" );
    $fqi      = $dd_block->getIdentifiers();
    
    foreach( $fqi as $id )
    {
        if( $dd_block->isGroupNode( $id ) )
        {
            echo "Group: ", $id, BR;
        }
        elseif( $dd_block->isTextNode( $id ) )
        {
            // text box
            if( $dd_block->isTextBox( $id ) )
            {
                $dd_block->setText( $id, "A text box" );
            }
            // textarea
            elseif( $dd_block->isMultiLineNode( $id ) )
            {
                $dd_block->setText( $id, "A textarea" );
            }
            // WYSIWYG
            elseif( $dd_block->isWYSIWYG( $id ) )
            {
                $dd_block->setText( $id, "<p>A new paragraph.</p>" );
            }
            // datetime
            elseif( $dd_block->isDatetimeNode( $id ) )
            {
                $dd_block->setText( $id, strtotime( '2016-06-02 08:07:00 -0500' ) . '000' );
            }
            // calendar
            elseif( $dd_block->isCalendarNode( $id ) )
            {
                $dd_block->setText( $id, '6-2-2016' );
            }
            // multi-selector
            elseif( $dd_block->isMultiSelectorNode( $id ) )
            {
                $dd_block->setText( $id, "Year 2;Year 3" );
            }
            // dropdown
            elseif( $dd_block->isDropdownNode( $id ) )
            {
                $dd_block->setText( $id, "Option 1" );
            }
            // radio
            elseif( $dd_block->isRadioNode( $id ) )
            {
                $dd_block->setText( $id, "Maybe" );
            }
            // checkboxes
            elseif( $dd_block->isCheckboxNode( $id ) )
            {
                if( $id == "group;checkbox" )
                    $dd_block->setText( $id, "Swimming;Jogging" );
                elseif( $id == "group;checkbox2" )
                    $dd_block->setText( $id, "" );
            }
        }
        else // assets
        {
            // block chooser
            if( $dd_block->isBlockChooser( $id ) )
            {
                $dd_block->setBlock( $id, 
                    $cascade->getAsset( 
                        a\DataBlock::TYPE, "9b4286798b7f08560139425ca3edcdb5" ) );
            }
            // file chooser
            elseif( $dd_block->isFileChooser( $id ) )
            {
                $dd_block->setFile( $id,
                    $cascade->getAsset( 
                        a\File::TYPE, "ed634da48b7f08560139425c052c9055" ) );
            }
            // page chooser
            elseif( $dd_block->isPageChooser( $id ) )
            {
                $dd_block->setPage( $id,
                    $cascade->getAsset( 
                        a\Page::TYPE, "09cec3188b7f08ee36475e3f72a18ef7" ) );
            }
            // symlink chooser
            elseif( $dd_block->isSymlinkChooser( $id ) )
            {
                $dd_block->setSymlink( $id,
                    $cascade->getAsset( 
                        a\Symlink::TYPE, "0c2260718b7f08ee74ff46e2c1f11ad9" ) );
            }
            // linkable chooser
            elseif( $dd_block->isLinkableChooser( $id ) )
            {
                $dd_block->setLinkable( $id,
                    $cascade->getAsset( 
                        a\Symlink::TYPE, "0c2260718b7f08ee74ff46e2c1f11ad9" ) );
            }
        }
    }
    $dd_block->edit();
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}
?>