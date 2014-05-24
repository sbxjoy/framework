<?php
class FwRunException extends RuntimeException 
{
    public function __construct($message,$code=0)
    {
        parent::__construct($message,$code);
    } 
}

class FwException
{
    protected $_errorController = "error";
    protected $_errorAction     = "error";

    public function __construct()
    {/*{{{*/
    }/*}}}*/

    public function setException($e)
    {/*{{{*/
        $error              = new ArrayObject(array(),ArrayObject::ARRAY_AS_PROPS);
        $exceptionType      = get_class($e);
        $error->exception   = $e;
        $error->type        = $exceptionType;
        FwContainer::find('FwHttp')->setParam('error_handle',$error);
        FwContainer::find('FwWeb')->setDispatched(false);
        FwContainer::find('FwWeb')->setControllerName($this->getErrorControllerName())
                                  ->setActionName($this->getErrorActionName())
                                  ->dispatch();
        FwContainer::find('FwView')->renderView();
    }/*}}}*/

    public function setErrorController($name)
    {/*{{{*/
        $this->_errorController = $name;
        return $this;
    }/*}}}*/

    public function setErrorAction($name)
    {/*{{{*/
        $this->_errorAction = $name;
        return $this;
    }/*}}}*/

    public function getErrorControllerName()
    {/*{{{*/
        return $this->_errorController;
    }/*}}}*/

    public function getErrorActionName()
    {/*{{{*/
        return $this->_errorAction;
    }/*}}}*/
}

?>
