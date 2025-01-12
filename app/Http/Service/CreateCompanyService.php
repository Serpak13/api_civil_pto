<?php

namespace App\Http\Service;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateCompanyService
{

    public function createCompany($data){
        try{
            DB::beginTransaction();
            $company = new Company();
            $company->name = $data['name'];
            $company->address = $data['address'];
            $company->phone = $data['phone'];
            $company->email = $data['email'];
            $company->ceo = $data['ceo'];
            $company->save();
            DB::commit();
            return ['result'=>'success', 'company'=>$company];
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Ошибка при создании', [
                'code'=>$e->getCode(),
                'message'=>$e->getMessage(),
                'trace'=>$e->getTraceAsString()
            ]);
            return [
              'result'=>'error',
              'code'=>$e->getCode(),
              'message'=>$e->getMessage(),
            ];
        }
    }

}
