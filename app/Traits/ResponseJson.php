<?php

namespace App\Traits;

trait ResponseJson
{
    public function successResponse($data)
    {
        $msg = 'Record found successfuly';
        return response()->json(['status'=>true,'code'=>200,'msg'=>$msg,'data'=>$data]);
    }

    public function errorResponse($msg)
    {
        return response()->json(['status'=>false,'code'=>400,'msg'=>$msg]);
    }
}