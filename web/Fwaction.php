<?php
class FwAction
{
    public function __construct()
    {/*{{{*/
        $this->init();
    }/*}}}*/

    /**
     * Dispatch the requested action
     * 
     * @param string $action : Method name of action
     * @return void
     */

    public function dispatch($action)
    {/*{{{*/
        $this->preDispatch();
        $this->$action();
        $this->postDispatch();
    }/*}}}*/

    public function init()
    {/*{{{*/
    }/*}}}*/

    public function preDispatch()
    {/*{{{*/
    }/*}}}*/

    public function postDispatch()
    {/*{{{*/
    }/*}}}*/

    /**
     * Assigns variables to the view script 
     * 
     * assign('name',$value) assigns a variable called 'name' with the corresponding $value.
     * 
     * assign($array) assigns the array keys as variable names (with the corresponding array values)
     *
     * @see __set()
     * @param string|array
     * @param if assigning a named variable , use this as the value
     */

    public function assign($spec,$value=null,$dohtmlspecialchars=true)
    {/*{{{*/
        if(is_string($spec))
        {
            FwBizResult::ensureFalse('_' == substr($spec, 0, 1),"Setting private or protected class members is not allowed");
            if($dohtmlspecialchars && is_string($value))
            {
                $value = htmlspecialchars($value);
            }
            FwContainer::find('FwView')->$spec = $value;
        }elseif(is_array($spec))
        {
            //TODO if(is_array($val))
            foreach($spec as $key=>$val)
            {
                FwBizResult::ensureFalse('_' == substr($key, 0, 1),"Setting private or protected class members is not allowed");
                if(is_string($val))
                {
                    FwContainer::find('FwView')->$key = $dohtmlspecialchars ? htmlspecialchars($val) : $val;
                }else
                {
                    FwContainer::find('FwView')->$key = $val;
                }
            }
        }
    }/*}}}*/

    /**
     * Set the noRender flag , if true, will not autorender views
     * @param boolean $flag
     */

    public function setNoViewRender($flag)
    {/*{{{*/
        return FwContainer::find('FwView')->setNoRender($flag);
    }/*}}}*/

    /**
     * Get cur Controller Name
     * @return string
     */

    public function getControllerName()
    {/*{{{*/
        return FwWeb::$curController;
    }/*}}}*/

    /**
     * Gets cur Action Name
     * @return string
     */

    public function getActionName()
    {/*{{{*/
        return FwWeb::$curAction;
    }/*}}}*/

    /**
     * Gets a parameter from {@link $_request Request object}. If the 
     * parameter does not exist , NULL will be returned . 
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */

    public function getParam($key , $default = null)
    {/*{{{*/
        $value = FwContainer::find('FwHttp')->get($key);

        return (null==$value && null !== $default) ? $default : $value;
    }/*}}}*/

    public function getRequest($key = null , $default = null)
    {/*{{{*/
        $value = FwContainer::find('FwHttp')->getRequest($key , $default);

        return $value;
    }/*}}}*/

    public function getPost($key = null , $default = null)
    {/*{{{*/
        $value = FwContainer::find('FwHttp')->getPost($key , $default);

        return $value;
    }/*}}}*/

    /**
     * Processes a view script
     *
     * @param string $name: The script script name to process
     *
     */

    public function render($name=null,$noController=false)
    {/*{{{*/
        if(is_null($name)) return;
        FwContainer::find('FwView')->setControllerRender(true);
        return FwContainer::find('FwView')->render($name,$noController);
    }/*}}}*/

    /**
     * modify the default suffix of view script
     *
     * @param string $suffix: The script suffix name
     *
     */

    public function setViewSuffix($suffix)
    {/*{{{*/
        if(empty($suffix)) return false;
        FwContainer::find('FwView')->setViewSuffix($suffix);
    }/*}}}*/

    public function _forward($action , $controller=null)
    {/*{{{*/
        if(null !== $controller)
        {
            FwContainer::find('FwWeb')->setControllerName($controller);
        }
        FwContainer::find('FwWeb')->setActionName($action);
        FwContainer::find('FwWeb')->setDispatched(false);
        FwContainer::find('FwWeb')->dispatch();
    }/*}}}*/

    public function initView()
    {/*{{{*/
        $this->view = FwContainer::find('FwView');
    }/*}}}*/

}
?>
