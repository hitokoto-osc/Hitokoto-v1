<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once './src/QcloudApi/QcloudApi.php';


$config = array('SecretId'       => 'AKID4kkCVr22nW51qSrnMyNwB1jjexcDi6vs',
                'SecretKey'      => 'Q3wggKl7FMCXz2mQCwWomYvf6pZUdpx7',
                'RequestMethod'  => 'GET',
                'DefaultRegion'  => 'gz');


$wenzhi = QcloudApi::load(QcloudApi::MODULE_WENZHI, $config);

$package = array("text"=>$_GET['text'],"code"=>2097152);

$a = $wenzhi->LexicalAnalysis($package);

if ($a === false) {
    $error = $wenzhi->getError();
    echo "Error code:" . $error->getCode() . ".\n";
    echo "message:" . $error->getMessage() . ".\n";
    echo "ext:" . var_export($error->getExt(), true) . ".\n";
    echo "\nRequest :" . $wenzhi->getLastRequest();
    echo "\nResponse :" . $wenzhi->getLastResponse();
} else {
    $b=-1;
    for ($i = 0; $i < count($a['combtokens']); $i++) {
        $b++;
        $back[$b] = $a['combtokens'][$i]['word'];
    }
    echo json_encode($back);
}


//echo "\n";