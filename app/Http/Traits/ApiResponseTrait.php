<?php 

namespace App\Http\Traits;

trait ApiResponseTrait 
{
    // trait  من أجل قولبة رسائل الإستجابة المعادة لعمليات تسجيل الدخول و الخروج و إنشاء حساب
    public function apiResponse($data,$token,$message,$status){
        $array = [
            'data'=>$data,
            'message'=>$message,
            'access_token'=>$token,
            'token_type'=>'bearer',
        ];

        return response()->json($array,$status);
    }
    
}