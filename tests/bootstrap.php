<?php
// @codingStandardsIgnoreFile
require_once __DIR__.'/../vendor/autoload.php';

use Qiniu\Auth;

$accessKey = getenv('QINIU_SDK_ENV_ACCESSKEY');
$secretKey = getenv('QINIU_SDK_ENV_SECRETKEY');
$testAuth = new Auth($accessKey, $secretKey);

$bucketName = 'phpsdk';
$key = 'php-logo.png';
$key2 = 'niu.jpg';

$bucketNameBC = 'phpsdk-bc';
$bucketNameNA = 'phpsdk-na';

$dummyAccessKey = 'abcdefghklmnopq';
$dummySecretKey = '1234567890';
$dummyAuth = new Auth($dummyAccessKey, $dummySecretKey);

$tid = getenv('TRAVIS_JOB_NUMBER');

//cdn
$timestampAntiLeechEncryptKey = getenv('QINIU_SDK_ENV_TIMESTAMP_ENCRPTKEY');
$customDomain = "http://phpsdk.qiniuts.com";

var_dump($accessKey);
var_dump($secretKey);
var_dump($timestampAntiLeechEncryptKey);
$vars = getenv('TRAVIS_SECURE_ENV_VARS');
var_dump($vars);
var_dump($_SERVER);

$testEnv = getenv('QINIU_TEST_ENV');

if (!empty($tid)) {
    $pid = getmypid();
    $tid = strstr($tid, '.');
    $tid .= '.' . $pid;
}

function qiniuTempFile($size)
{
    $fileName = tempnam(sys_get_temp_dir(), 'qiniu_');
    $file = fopen($fileName, 'wb');
    if ($size > 0) {
        fseek($file, $size-1);
        fwrite($file, ' ');
    }
    fclose($file);
    return $fileName;
}
