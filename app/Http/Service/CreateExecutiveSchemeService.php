<?php

namespace App\Http\Service;

use App\Models\ExecutiveScheme;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateExecutiveSchemeService{
    public function createExecutiveScheme($data){
        try{
            DB::beginTransaction();
            $scheme = new ExecutiveScheme();
            $scheme->name = $data['name'];
            $scheme->code_scheme = $data['code_scheme'];
            $scheme->description = $data['description'];
            $scheme->act_id = $data['act_id'];
            $scheme->save();
            DB::commit();
            return [
                'result' => 'success',
                'scheme' => $scheme
            ];
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Ошибка при создании', [
                'code'=>$e->getCode(),
                'message'=>$e->getMessage(),
                'trace'=>$e->getTraceAsString()
            ]);
            return[
              'result' => 'error',
              'code' => $e->getCode(),
              'message' => $e->getMessage(),
            ];
        }
    }
}
