<?php
namespace app\index\controller;

Class Index extends \think\Controller
{
	public function index()
	{
		return $this->fetch();
	}
}
