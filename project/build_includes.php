<?php

define( "FILE_DEFAULT_DIRECTORY_CREATION_MODE", 0755 );

if($argc == 4 )
{
    $a = new AssemblyBuilder();
    $a->run($argv[1],$argv[2],$argv[3]);
}
else
{
    echo "Usage: /usr/local/bin/php build_includes <root_path> <outfile> <cache_key>\n";
}

class AssemblyBuilder
{/*{{{*/
    private static $_paths = array();
    private static $_skipFolders = array('web-inf', 'tmp', '.svn', 'sqls', 'logs', 'project','example');
    private static $_skipFiles= array();
    private static $_fileNameTemplate = array('php');
    
    public function getCodeTpl()
    {/*{{{*/
return '<?php
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
            $classpath = apc_fetch("___CACHEKEY___");
            if ($classpath) return $classpath;

            $classpath = self::getClassMapDef();
            apc_store("___CACHEKEY___",$classpath); 
        }
        else if(function_exists("eaccelerator_get"))
        {
            $classpath = eaccelerator_get("___CACHEKEY___");
            if ($classpath) return $classpath;

            $classpath = self::getClassMapDef();
            eaccelerator_put("___CACHEKEY___",$classpath); 
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
            ___DATA___
        );
    }
}
spl_autoload_register(array("FwLoader","autoload"));
';
    }/*}}}*/

    public function run($rootPath,$outfile,$cacheKey)
    {/*{{{*/
        self::$_paths = explode(":",$rootPath);
        foreach (self::$_paths as $path)
        {
            $files = self::findFiles($path);
            foreach (self::findClasses($files) as $class => $filename)
            {
                if (empty($classes[$class]))
                    $classes[$class] = $filename;
                else
                    echo "Repeatedly Class $class in file $filename\n";
            }
        }
        
        self::generatorAssemblyFile($classes,$outfile,$this->getCodeTpl(),$cacheKey);
    
        echo "\ngenerator assembly file successed!\n";
    }/*}}}*/

    static private function generatorAssemblyFile($classes,$outFile,$code,$cacheKey)
    {/*{{{*/
        $assemblyfile = fopen( $outFile, 'w+' );

        $arrayCode = "";
        foreach ($classes as $key => $value)
        {
            $arrayCode  .= "\t\t\t\"$key\" => \t\t\t\"$value\",\n";
        }
        $cacheKey = $cacheKey.":".time();
        $code = str_replace("___DATA___",$arrayCode,$code);
        $code = str_replace("___CACHEKEY___",$cacheKey,$code);
        return fwrite( $assemblyfile, $code);
    }/*}}}*/

    static private function findClasses($files)
    {/*{{{*/
        $classes = array();
	    foreach ($files as $file)
	    {
	        foreach (self::findClassFromAFile($file) as $class)
	        {
	            if (empty($classes[$class]))
	                $classes[$class] = $file;
	            else
                    echo "Repeatedly Class $class in file $file\n";
	        }
	    }
	    return $classes;
    }/*}}}*/

    static private function findClassFromAFile($file)
    {/*{{{*/
        $classes = array();
        $lines = file($file);
        foreach ($lines as $line)
        {
            if (preg_match("/^\s*class\s+(\w+)\s*/", $line, $match))
            {
                $classes[] = $match[1];
            }
            if (preg_match("/^\s*abstract\s*class\s+(\w+)\s*/", $line, $match))
            {
                $classes[] = $match[1];
            }
            if (preg_match("/^\s*interface\s+(\w+)\s*/", $line, $match))
            {
                $classes[] = $match[1];
            }

        }
        return $classes;
    }/*}}}*/

    static private function skipFiles($file)
    {/*{{{*/
        foreach(self::$_skipFiles as $fileRule)
        {
            if(preg_match("/$fileRule/i",$file))
                return ;
        }
        $suffix = self::getFileSuffix($file);
        return ( false == in_array($suffix, self::$_fileNameTemplate) 
            || (1 == preg_match("/\.svn/", $file)) || (0 == preg_match("/.+\.php/", $file)) ); 
    }/*}}}*/

    static private function isInFileTemplates($file)
    {/*{{{*/
    }/*}}}*/

    static private function isSkipFolders($file)
    {/*{{{*/

        foreach (self::$_skipFolders as $skip)
        {
            $skip = quotemeta($skip);
            if (1 == preg_match("/$skip/", $file) && is_dir($file))
            {
                return true;
            }
        }
    }/*}}}*/
    
    static private function findFiles($dirname)
    {/*{{{*/
         $filelist = array();
         $currentfilelist = scandir($dirname);
         if(is_array($currentfilelist ))
         foreach ($currentfilelist as $file)
         {
             if ($file == "." || $file == ".." || self::isSkipFolders($file))
             {
                 continue;
             }

             $file = "$dirname/$file";

             if (is_dir($file))
             {
                 foreach (self::findFiles($file) as $tmpFile)
                 {
                     $filelist[] = $tmpFile;
                 }
                 continue;
             }

             if (false == self::skipFiles($file))
             {
                echo $file."\n";
                $filelist[] = $file;
             }
         }
         return $filelist;
    }/*}}}*/

    static private function getFileSuffix($fileName)
    {/*{{{*/
        $pointPos = strrpos($fileName, "."); 
         
        if ($pointPos)
        {
            return substr($fileName, $pointPos+1, strlen($fileName) - $pointPos); 
        }
        return;
    }/*}}}*/
}/*}}}*/
