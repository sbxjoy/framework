<?php


include 'FwLog.php';
include 'writers/FwLogWriterFile.php';
include 'writers/FwLogWriterDisplay.php';
include 'writers/FwLogWriterFirephp.php';
include 'writers/FirePHP.class.php';


$logPath = dirname(__FILE__);
$log = FwLog::getInstance($logPath);


###���������־��ӡ��ҳ����###
#$log->openOutput(FwLog::OUTPUT_MODE_ECHO);
###end#####


###���������־��ӡ��ҳ���ϣ� ��ע����ʽ###
#$log->openOutput(FwLog::OUTPUT_MODE_COMMENT);
###end#####

###���������־��ӡ�� firebug�Ŀ���̨�� ###
#$log->openOutput(FwLog::OUTPUT_MODE_FIREPHP);
###end#####


###�����ֻ�����־��ӡ��ҳ���ϻ��ӡ��firebug�Ŀ���̨�ϣ����뱣���ļ� ###
#$log->setOutputMode(FwLog::OUTPUT_MODE_ECHO );
#$log->setOutput('�����־�������ļ���ֻ��ӡ��ҳ���firbug ����̨��');
###end#####


$log->info('����һ����־��Ϣ');
$res = $log->sql('select * from user where qid in (?,?,?)', array(1,2,3));
$res = $log->warn('select * from user where qid in (?,?,?)', array(1,2,3));
print_r($res);

/* ����ʱ
Array
(
    [errno] => 1
    [errmsg] => Permission denied - failed to open file: xxxxxx/sql.log.20100709
)

��ȷ
Array
(
    [errno] => 0
)
*/
