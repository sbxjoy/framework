#!/bin/bash

################################################################
#
# Qihoo project source deploy tool
# @Wiki: http://add.corp.qihoo.net:8360/display/platform/deploy_tools
#
###############################################################

#  根据term的编码格式进行设置
export LANGUAGE="utf-8"
#export LANGUAGE="gbk"

#  项目名
PROJECT_NAME="QFrame"

#  项目版本号
VERSION="1.0.2"

#  项目svn地址
SVN_URL="https://ipt.src.corp.qihoo.net/svn/fw/trunk/"

#  线上集群

leakCluster="w3v.ipt.bjt.qihoo.net w4v.ipt.bjt.qihoo.net leak1.safe.bjt.qihoo.net w94v.add.ccc w95v.add.ccc"

expCluster="texp01v.add.ccc.qihoo.net"

haoCluster="w66v.add.ccc w67v.add.ccc eng05v.add.ccc  eng05v.add.cct w67v.add.cct w68v.add.cct w69v.add.cct w70v.add.cct w71v.add.cct w72v.add.cct w69v.add.ccc w70v.add.ccc w71v.add.ccc w83v.add.ccc w84v.add.ccc w85v.add.ccc w77v.add.ccc w78v.add.ccc w79v.add.ccc w81v.add.cct w82v.add.cct w83v.add.cct w12v.add.zwt w13v.add.zwt w14v.add.zwt w15v.add.zwt w16v.add.zwt w17v.add.zwt w18v.add.zwt w19v.add.zwt w20v.add.zwt w24v.add.zwt w25v.add.zwt w26v.add.zwt w91v.add.ccc w92v.add.ccc w93v.add.ccc w01v.cms.ccc w27v.add.zwt w28v.add.zwt w119v.add.ccc w120v.add.ccc w04v.add.bjsc w05v.add.bjsc w06v.add.bjsc w07v.add.bjsc w37v.add.zwt w38v.add.zwt w39v.add.zwt w40v.add.zwt w41v.add.zwt w42v.add.zwt"

payCluster="w04v.add.vnet w05v.add.vnet w06v.add.vnet w10v.add.vnet w11v.add.vnet app02v.add.vnet.qihoo.net w14v.add.vnet w15v.add.vnet w16v.add.vnet w35v.add.zwt.qihoo.net w36v.add.zwt.qihoo.net w113v.add.ccc.qihoo.net w114v.add.ccc.qihoo.net"

cmsCluster="cms1v.add.cct.qihoo.net cms1v.add.ccc.qihoo.net cms2v.add.cct.qihoo.net cms2v.add.ccc.qihoo.net"

onlineFileMap="w03v.add.ccc w04v.add.ccc w03v.add.cct w04v.add.cct"

POP_WIN="w115v.add.ccc w116v.add.ccc"

S3="w62v.add.cct.qihoo.net"

dong="w-m09.dong.shgt.qihoo.net tempt7.ops.zzbc.qihoo.net m01v.dong.shgt.qihoo.net w-m10.dong.shgt.qihoo.net"

ilike="app01v.ilike.zwt"

pay="w38v.add.ccc w39v.add.ccc"

i360="10.102.79.160"

appstorage="w-w9.wg.ccp.qihoo.net w9api.opend.ccc.qihoo.net w10api.opend.ccc.qihoo.net w11api.opend.zwt.qihoo.net"

dongtmp='obox1.safe.zwt obox2.safe.zwt obox3.safe.zwt obox4.safe.zwt obox1.safe.zzbc obox2.safe.zzbc obox3.safe.zzbc obox4.safe.zzbc obox1.safe.ccp obox2.safe.ccp obox3.safe.ccp obox4.safe.ccp tempt28.ops.shgt tempt27.ops.shgt.qihoo.net tempt26.ops.shgt tempt25.ops.shgt.qihoo.net'

aoyun="w1.soft.bjt.qihoo.net w2.soft.bjt.qihoo.net w3.soft.bjt.qihoo.net w04.add.bjt.qihoo.net w08.add.bjt.qihoo.net"
aoyuna="w07.add.bjt.qihoo.net soft1.add.ccc.qihoo.net w100v.add.ccc.qihoo.net w98v.add.ccc.qihoo.net soft3.add.ccc.qihoo.net soft2.add.ccc.qihoo.net"
openi="openi01v.opend.zwt.qihoo.net openi02v.opend.zwt.qihoo.net openi01v.opend.ccc.qihoo.net openi02v.opend.ccc.qihoo.net apc1.add.bjt.qihoo.net"
daohang="w131v.add.ccc.qihoo.net w132v.add.ccc.qihoo.net w90v.add.zwt.qihoo.net w91v.add.zwt.qihoo.net w124v.add.ccc.qihoo.net w125v.add.ccc.qihoo.net w126v.add.ccc.qihoo.net w184v.add.zwt.qihoo.net w126v.add.bjsc.qihoo.net kb01v.add.zwt.qihoo.net kb02v.add.zwt.qihoo.net kb03v.add.zwt.qihoo.net kb04v.add.zwt.qihoo.net kb05v.add.zwt.qihoo.net kb06v.add.zwt.qihoo.net kb07v.add.zwt.qihoo.net kb01v.add.bjsc.qihoo.net kb02v.add.bjsc.qihoo.net kb03v.add.bjsc.qihoo.net kb04v.add.bjsc.qihoo.net kb05v.add.bjsc.qihoo.net kb06v.add.bjsc.qihoo.net kb07v.add.bjsc.qihoo.net w135v.add.bjsc.qihoo.net w136v.add.bjsc.qihoo.net w137v.add.bjsc.qihoo.net"
tmp="w127v.add.ccc.qihoo.net w128v.add.ccc.qihoo.net w129v.add.ccc.qihoo.net w130v.add.ccc.qihoo.net w133v.add.ccc.qihoo.net w28v.add.bjt.qihoo.net w29v.add.bjt.qihoo.net tcluster1v.add.ccc.qihoo.net"
unknow="app03v.add.zwt.qihoo.net app04v.add.zwt.qihoo.net app04v.add.ccc.qihoo.net app05v.add.ccc.qihoo.net"
baoxianxiang="w02.add.bjt.qihoo.net w01.add.bjt.qihoo.net w03.add.bjt.qihoo.net w09.add.bjt.qihoo.net w1v.ipt.bjt w2v.ipt.bjt w01v.add.ccc w02v.add.ccc w01v.add.cct w02v.add.cct tw01v.add.ccc w57v.add.ccc w58v.add.ccc w59v.add.ccc w58v.add.cct w59v.add.cct w60v.add.cct 10.16.15.253"
testCluster="192.168.0.172 192.168.100.157 192.168.100.150 192.168.100.31 192.168.100.142 192.168.100.164 192.168.100.20 192.168.100.169 192.168.100.103 192.168.100.135 192.168.100.207 192.168.100.26 10.16.15.110 10.16.15.112 10.16.15.123 10.16.15.103 10.16.15.115 218.30.117.19 10.16.15.68 10.16.27.110 10.16.15.124 10.16.15.41 10.16.15.17 10.16.27.56"
jishu="csew01v.add.zwt.qihoo.net csew02v.add.zwt.qihoo.net csew03v.add.zwt.qihoo.net csew04v.add.zwt.qihoo.net csew05v.add.zwt.qihoo.net csew01v.add.bjsc.qihoo.net csew02v.add.bjsc.qihoo.net csew03v.add.bjsc.qihoo.net csew04v.add.bjsc.qihoo.net"
new_add="10.16.29.62"
online_cluster="$jishu"

#for all_exec not for fw
gangliahyb="w-w701.add.hyb.qihoo.net w-w702.add.hyb.qihoo.net w-w703.add.hyb.qihoo.net w-w704.add.hyb.qihoo.net w-w705.add.hyb.qihoo.net w-w706.add.hyb.qihoo.net w-w707.add.hyb.qihoo.net w-w708.add.hyb.qihoo.net"
gangliaMongoNjt="w-mdb01.add.njt.qihoo.net w-mdb02.add.njt.qihoo.net w-mdb03.add.njt.qihoo.net w-mdb04.add.njt.qihoo.net w-mdb05.add.njt.qihoo.net w-mdb06.add.njt.qihoo.net"
exec4njt13="w1301.add.njt w1302.add.njt w1303.add.njt w1304.add.njt w1305.add.njt w1306.add.njt w1307.add.njt w1308.add.njt w1309.add.njt w1310.add.njt w1311.add.njt w1312.add.njt w1313.add.njt w1314.add.njt w1315.add.njt w1316.add.njt w1317.add.njt w1318.add.njt w1319.add.njt w1320.add.njt w1301v.add.njt w1302v.add.njt w1303v.add.njt w1304v.add.njt w1305v.add.njt"
#online_cluster="$exec4njt13"

#  测试集群
beta_cluster="test2v.add.dxt"

#  部署帐号
SSH_USER="sync360"
#SSH_USER="search"

#  目标机的部署目录
REMOTE_DEPLOY_DIR="/home/q/php/$PROJECT_NAME"
#  目标机上真实的目录,一般不用更改
REAL_REMOTE_DEPLOY_DIR="/home/q/php/$PROJECT_NAME-$VERSION"

#  deploy-release.sh 使用，自动执行 $AUTORUN_RELEASE_CMD , 主要用于autoload.sh, 不需要可直接注释
#AUTORUN_RELEASE_CMD="cd $REMOTE_DEPLOY_DIR;sh project/autoload_builder.sh"

#  deploy-package.sh 使用，自动执行 $REMOTE_DEPLOY_DIR/bootstrap.sh , 脚本需要执行权限,不需要可直接注释
#SUDO_AUTORUN_PACKAGE="bootstrap.sh"
#AUTORUN_PACKAGE="bootstrap.sh"
AUTORUN_PACKAGE_CMD="cd $REMOTE_DEPLOY_DIR;sh project/autoload_builder.sh;"


#  用于diff命令  打包时过滤logs目录
DEPLOY_BASENAME=`basename $REMOTE_DEPLOY_DIR`
#  用于diff命令， 获取线上代码时，有时候需要过滤掉日志等文件
TAR_EXCLUDE="--exclude $DEPLOY_BASENAME/logs --exclude $DEPLOY_BASENAME/src/www/thumb"

#  deploy debug 标志，1 表示打开调试信息
UTILS_DEBUG=1

##################################################################################################

SSH="sudo -u $SSH_USER ssh"
SCP="sudo -u $SSH_USER scp"

# 保存本地临时文件的目录
LOCAL_TMP_DIR="/tmp/deploy_tools/$USER"

# 上传代码时过滤这些文件
BLACKLIST='(.*\.tmp$)|(.*\.log$)|(.*\.svn.*)'

# 线上保存临时文件的目录
ONLINE_TMP_DIR="/tmp"

# 备份代码的目录
ONLINE_BACKUP_DIR="/home/$SSH_USER/deploy_history/$PROJECT_NAME"          
LOCAL_DEPLOY_HISTORY_DIR="/home/$USER/deploy_history/$PROJECT_NAME"  

# 代码更新历史(本地文件）
DEPLOY_HISTORY_FILE="$LOCAL_DEPLOY_HISTORY_DIR/deploy_history"            
DEPLOY_HISTORY_FILE_BAK="$LOCAL_DEPLOY_HISTORY_DIR/deploy_history.bak" 
