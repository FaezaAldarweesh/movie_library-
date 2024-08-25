<?php

namespace App\Http\Traits;

trait ApiTrait {
    // trait  من أجل قولبة رسائل الإستجابة المعادة 
        public function Response($data,$message,$status){
        $array = [
            'data'          => $data,
            'message'       => $message,
        ];
        return response()->json($array,$status);
    }
    
    //========================================================================================================================

       public function customeResponse($message,$status)
       {
        return response()->json($message,$status);
       }
    
    //========================================================================================================================
}


?>