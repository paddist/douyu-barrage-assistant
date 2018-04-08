<?php
/**
 * Created by PhpStorm.
 * User: CriliseKR
 * Date: 2018/4/5
 * Time: 4:01
 */

namespace app\barrage\controller;


class Index extends \think\Controller
{
    public function run($msg)
    {
        $content = decode_msg($msg);
        foreach ($content as $k => $v)
        {
            $v = $this->decode_str($v);
            if (strpos($v, '@=') !== false)
            {
                $l2 = array();
                preg_match_all('/(\w+@=.+)\/\//U', $v, $match);
                foreach ($match[1] as $value)
                {
                    $value = $this->decode_msg($value);
                    $l2[] = $value;
                }
                $content[$k] = $l2;
            }
        }
    }

    private function decode_msg($msg)
    {
        $msg = '{"' . $msg . '"}';
        $msg = str_replace('\\', '/', str_replace('/', '","', str_replace('@=', '":"', $msg)));
        return json_decode($msg, true);
    }

    private function decode_str($str)
    {
        return str_replace('@A', '@', str_replace('@AS', '\\', str_replace('@S', '/', str_replace('@A', '@', $str))));
    }
}
