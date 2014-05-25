<?php
class FwLoader 
{
    public static function loadClass($classname)
    {
        $classpath = self::getClassPath();
        if (isset($classpath[$classname]))
        {
            include($classpath[$classname]);
        }
    }
    protected static function getClassPath()
    {
        static $classpath=array();
        if (!empty($classpath)) return $classpath;
        if(function_exists("apc_fetch"))
        {
            $classpath = apc_fetch("fw:autoload:application:1401033573");
            if ($classpath) return $classpath;

            $classpath = self::getClassMapDef();
            apc_store("fw:autoload:application:1401033573",$classpath); 
        }
        else if(function_exists("eaccelerator_get"))
        {
            $classpath = eaccelerator_get("fw:autoload:application:1401033573");
            if ($classpath) return $classpath;

            $classpath = self::getClassMapDef();
            eaccelerator_put("fw:autoload:application:1401033573",$classpath); 
        }
        else
        {
            $classpath = self::getClassMapDef();
        }
        return $classpath;
    }
    protected static function getClassMapDef()
    {
        return array(
            			"Framework" => 			"/home/lvxiang/framework/Fw.php",
			"FwBase" => 			"/home/lvxiang/framework/Fwbase.php",
			"FwLoader" => 			"/home/lvxiang/framework/Loader.php",
			"FwConfig" => 			"/home/lvxiang/framework/base/Fwconfig.php",
			"FwRunException" => 			"/home/lvxiang/framework/base/Fwexception.php",
			"FwException" => 			"/home/lvxiang/framework/base/Fwexception.php",
			"FwHttp" => 			"/home/lvxiang/framework/base/Fwhttp.php",
			"FwStandRoute" => 			"/home/lvxiang/framework/base/Fwrouteutils.php",
			"FwRouteRegex" => 			"/home/lvxiang/framework/base/Fwrouteutils.php",
			"FwContainer" => 			"/home/lvxiang/framework/base/Fwutils.php",
			"FwBizResult" => 			"/home/lvxiang/framework/base/Fwutils.php",
			"FwDB" => 			"/home/lvxiang/framework/base/db/FwDB.php",
			"FwDBPDO" => 			"/home/lvxiang/framework/base/db/FwDB.php",
			"FwDBStatment" => 			"/home/lvxiang/framework/base/db/FwDB.php",
			"FwDBException" => 			"/home/lvxiang/framework/base/db/FwDB.php",
			"FwDBExplainResult" => 			"/home/lvxiang/framework/base/db/FwDBExplainResult.php",
			"FwLog" => 			"/home/lvxiang/framework/logger/FwLog.php",
			"FirePHP" => 			"/home/lvxiang/framework/logger/writers/FirePHP.class.php",
			"FwLogWriterDisplay" => 			"/home/lvxiang/framework/logger/writers/FwLogWriterDisplay.php",
			"FwLogWriterFile" => 			"/home/lvxiang/framework/logger/writers/FwLogWriterFile.php",
			"FwLogWriterFirephp" => 			"/home/lvxiang/framework/logger/writers/FwLogWriterFirephp.php",
			"FwdbTest" => 			"/home/lvxiang/framework/t/FwdbTest.php",
			"AllTests" => 			"/home/lvxiang/framework/t/FwdbTestSuite.php",
			"FwAction" => 			"/home/lvxiang/framework/web/Fwaction.php",
			"FwRouter" => 			"/home/lvxiang/framework/web/Fwrouter.php",
			"FwRouterDefaultRoute" => 			"/home/lvxiang/framework/web/Fwrouter.php",
			"FwView" => 			"/home/lvxiang/framework/web/Fwview.php",
			"FwWeb" => 			"/home/lvxiang/framework/web/Fwweb.php",

        );
    }
}
spl_autoload_register(array("FwLoader","autoload"));
