<?php
class QFrameLoader
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
            $classpath = apc_fetch("fw:autoload:application:1400038421");
            if ($classpath) return $classpath;

            $classpath = self::getClassMapDef();
            apc_store("fw:autoload:application:1400038421",$classpath); 
        }
        else if(function_exists("eaccelerator_get"))
        {
            $classpath = eaccelerator_get("fw:autoload:application:1400038421");
            if ($classpath) return $classpath;

            $classpath = self::getClassMapDef();
            eaccelerator_put("fw:autoload:application:1400038421",$classpath); 
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
            			"FwBase" => 			"/home/lvxiang/framework/Fwbase.php",
			"QFrameLoader" => 			"/home/lvxiang/framework/Loader.php",
			"QFrame" => 			"/home/lvxiang/framework/QFrame.php",
			"QFrameConfig" => 			"/home/lvxiang/framework/base/QFrameconfig.php",
			"QFrameDomainUser" => 			"/home/lvxiang/framework/base/QFrameduser.php",
			"QFrameHttp" => 			"/home/lvxiang/framework/base/QFramehttp.php",
			"QFrameStandRoute" => 			"/home/lvxiang/framework/base/QFramerouteutils.php",
			"QFrameRouteRegex" => 			"/home/lvxiang/framework/base/QFramerouteutils.php",
			"QFrameUtil" => 			"/home/lvxiang/framework/base/QFrameutils.php",
			"QFrameContainer" => 			"/home/lvxiang/framework/base/QFrameutils.php",
			"QFrameBizResult" => 			"/home/lvxiang/framework/base/QFrameutils.php",
			"QFrameRunException" => 			"/home/lvxiang/framework/base/QFramexception.php",
			"QFrameException" => 			"/home/lvxiang/framework/base/QFramexception.php",
			"QFrameDB" => 			"/home/lvxiang/framework/base/db/QFrameDB.php",
			"QFrameDBPDO" => 			"/home/lvxiang/framework/base/db/QFrameDB.php",
			"QFrameDBStatment" => 			"/home/lvxiang/framework/base/db/QFrameDB.php",
			"QFrameDBException" => 			"/home/lvxiang/framework/base/db/QFrameDB.php",
			"QFrameDBExplainResult" => 			"/home/lvxiang/framework/base/db/QFrameDBExplainResult.php",
			"QFrameLog" => 			"/home/lvxiang/framework/logger/QFrameLog.php",
			"FirePHP" => 			"/home/lvxiang/framework/logger/writers/FirePHP.class.php",
			"QFrameLogWriterDisplay" => 			"/home/lvxiang/framework/logger/writers/QFrameLogWriterDisplay.php",
			"QFrameLogWriterFile" => 			"/home/lvxiang/framework/logger/writers/QFrameLogWriterFile.php",
			"QFrameLogWriterFirephp" => 			"/home/lvxiang/framework/logger/writers/QFrameLogWriterFirephp.php",
			"QFramedbTest" => 			"/home/lvxiang/framework/t/QFramedbTest.php",
			"AllTests" => 			"/home/lvxiang/framework/t/QFramedbTestSuite.php",
			"QFrameAction" => 			"/home/lvxiang/framework/web/QFrameaction.php",
			"QFrameRouter" => 			"/home/lvxiang/framework/web/QFramerouter.php",
			"QFrameRouterDefaultRoute" => 			"/home/lvxiang/framework/web/QFramerouter.php",
			"QFrameView" => 			"/home/lvxiang/framework/web/QFrameview.php",
			"QFrameWeb" => 			"/home/lvxiang/framework/web/QFrameweb.php",

        );
    }
}
//    spl_autoload_register(array("QFrameLoader","autoload"));
?>