<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
define('STATIC_PATH','/static/');
define("CAPTCHA_ID", "57c711d3e447e9be0dc993acaa1c22d9");
define("PRIVATE_KEY", "abd00e79ccabf941a408301deb491d9f");

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
