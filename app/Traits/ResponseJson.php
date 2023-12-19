<?php

namespace App\Traits;

trait ResponseJson
{
    //============ FETCH DATA RESPONSE ============//
    public function successResponse($data)
    {
        $msg = 'Record found successfuly';
        return response()->json(['status'=>true,'code'=>200,'msg'=>$msg,'data'=>$data]);
    }

    //============ ERROR JSON RESPONSE ==========//
    public function errorResponse($msg)
    {
        return response()->json(['status'=>false,'code'=>400,'msg'=>$msg]);
    }

    //============ INSERT JSON RESPONSE ==========//
    public function insertResponse($data)
    {
        $msg ="Record inserted successfully!";
        return response()->json(['status'=>true, 'code'=>200, 'msg'=>$msg,'data'=>$data]);
    }

    //=========== UPDATE JSON RESPONSE ==========//
    public function updateResponse($data)
    {
        $msg ="Record updated successfully!";
        return response()->json(['status'=>true, 'code'=>200, 'msg'=>$msg,'data'=>$data]);
    }

    //=========== DELETE JSON RESPONSE ==========//
    public function deleteResponse($data)
    {
        $msg ="Record deleted successfully!";
        return response()->json(['status'=>true, 'code'=>200, 'msg'=>$msg,'data'=>$data]);
    }

}