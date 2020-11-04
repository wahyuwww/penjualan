<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pegawai;
use Validator;
use App\Http\Resources\PegawaiResource;

class PegawaiController extends Controller
{
    public function login_pegawai(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'username'=>'required',
            'password'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>FALSE,
                'msg'=>$validator->errors()
            ],400);
        }

        $username = $request->input('username');
        $password = $request->input('password');

        $pegawai = Pegawai::where([
            ['username',$username],
            ['is_aktif',1]
        ])->first();

        if(is_null($pegawai))
        {
            //jika pegawai tidak ditemukan
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Username Tidak ditemukan'
            ],200);
        }
        else
        {
            //jika pegawai ditemukan
            if(password_verify($password,$pegawai->password))
            {
                //jika password sesuai
                return response()->json([
                    'status'=>TRUE,
                    'msg'=>'Username ditemukan',
                    'pegawai'=>new PegawaiResource($pegawai)
                ],200);
            }
            else
            {
                //jika password tidak sesuai
                return response()->json([
                    'status'=>FALSE,
                    'msg'=>'Username & Password Tidak Sesuai',
                ],200);
            }
        }
    }
}
