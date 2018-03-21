<?php
/**
 * Created by PhpStorm.
 * User: kongr
 * Date: 2018/3/20
 * Time: 14:34
 */
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

//注册连接成功回调
$client->on("connect", function($cli) {
    $cli->send(packMsg("type@=loginreq/roomid@=606118/"));
    $cli->send(packMsg('type@=joingroup/rid@=606118/gid@=-9999/'));
});

//注册数据接收回调
$client->on("receive", function($cli, $data){
    static $flag = true;
    decode_msg($data);
    if ($flag)
    {
        swoole_timer_tick(45000, function() use ($cli){
            $cli->send(packMsg('type@=mrkl/'));
            echo '发送心跳';
        });
        echo '心跳启动';
        $flag = false;
    }
});

//注册连接失败回调
$client->on("error", function($cli){
    echo "Connect failed\n";
});

//注册连接关闭回调
$client->on("close", function($cli){
    echo "Connection close\n";
});

//发起连接
$client->connect(gethostbyname('openbarrage.douyutv.com'), 8601);

function packMsg($str)
{
    $length = pack('V', 4 + 4 + strlen($str) + 1);
    $code = $length;
    $magic = chr(0xb1).chr(0x02).chr(0x00).chr(0x00);
    $end = chr(0x00);
    return $length.$code.$magic.$str.$end;
}

function decode_msg($msg)
{
    $msg = substr($msg, strpos($msg,'type'));
    $arr = explode('/', $msg);
    $content = array();
    foreach ($arr as $line)
    {
        if (empty(trim($line)))
        {
            continue;
        }
        $line = explode('@=', $line);
        $content[$line[0]] = $line[1];
    }
    var_export($content);
}