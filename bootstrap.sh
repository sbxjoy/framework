#!/bin/bash

platform=`uname -s`
if [ "$platform" = "Linux" ]
then
    SCRIPT=`readlink -f $0`
    # Absolute path this script is in, thus /home/user/bin
    basedir=`dirname $SCRIPT`
    basename=`basename $SCRIPT`
elif [ "$platform" = "FreeBSD" ]
then
    SCRIPT=`realpath $0`
    # Absolute path this script is in, thus /home/user/bin
    basedir=`dirname $SCRIPT`
    basename=`basename $SCRIPT`
else
    echo "Not support ${platform}"
    exit -1
fi


cd $basedir

sh project/autoload_builder.sh 

if test -e "Loader.php"
then
    content="install Fw success!\n\n"
else
    content="install Fw failed!\n\n"
fi

echo $content
