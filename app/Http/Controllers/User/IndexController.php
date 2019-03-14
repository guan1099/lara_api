<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
class IndexController
{
    protected $redis_h_key='str_h:';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index(){
        echo 1;
    }
    public function test(Request $request){
        $u=$request->input('u');
        $p=$request->input('p');
        echo $u;
        $res=true;
        if($res){
            $uid=10000;
            $str=time().$uid.mt_rand(111111,999999);
            $token=substr($str,10,20);

            $key=$this->redis_h_key.$uid;
            Redis::hset($key,'token',$token);
            Redis::expire($key,3600*24*2);    //过期时间
            echo $token;
        }else{
            echo "not";
        }
    }
    public function uCenter(Request $request){
        print_r($_SERVER['HTTP_TOKEN']);
        $uid=10000;
        $key=$this->redis_h_key.$uid;
        $token=Redis::hget($key,'token');
        if($_SERVER['HTTP_TOKEN']==$token){
            echo "登录成功";
        }else{
            echo "FAIL";
        }
    }

    //
}
