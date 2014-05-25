<?php
class FwBase
{
    public function __construct()
    {/*{{{*/
    }/*}}}*/
    
    public static function getVersion()
    {/*{{{*/
        return 'Fw_0.0.1';
    }/*}}}*/

    public static function createWebApp()
    {/*{{{*/
        return FwContainer::find('FwWeb'); 
    }/*}}}*/

}
?>
