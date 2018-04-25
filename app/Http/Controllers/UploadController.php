<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use OSS\Core\OssException;

class UploadController extends Controller
{
    public function businessList(Request $request)
    {
        //获取图片存储路径
        $fileName = $request->file('file')->store('public/shop');
        //使用阿里云上传图片
        $client = App::make('aliyun-oss');
        try{
            //上传
            $client->uploadFile('lavarel-eleb',$fileName,storage_path('app/'.$fileName));
            //获取阿里云图片地址,返回json数据,保存至数据库
            $filename = 'https://lavarel-eleb.oss-cn-beijing.aliyuncs.com/'.urlencode($fileName);//urlencode  url地址转码
            return ['url'=>$filename];
        }catch(OssException $e){
            echo '上传失败!';
            //抛出异常
            printf($e->getMessage().'\n');
        }
    }

    public function businessCatAdd(Request $request)
    {
        //获取图片存储路径
        $fileName = $request->file('file')->store('public/category');
        //使用阿里云上传图片
        $client = App::make('aliyun-oss');
        try{
            //上传
            $client->uploadFile('lavarel-eleb',$fileName,storage_path('app/'.$fileName));
            //获取阿里云图片地址,返回json数据,保存至数据库
            $filename = 'https://lavarel-eleb.oss-cn-beijing.aliyuncs.com/'.urlencode($fileName);//urlencode  url地址转码
            return ['url'=>$filename];
        }catch(OssException $e){
            echo '上传失败!';
            //抛出异常
            printf($e->getMessage().'\n');
        }
    }
}
