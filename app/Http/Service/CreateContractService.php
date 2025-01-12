<?php

namespace App\Http\Service;

use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateContractService
{

    public function createContract($data){
        try{
            DB::beginTransaction();
            $contract = new Contract();
            $contract->company_id = $data['company_id'];
            $contract->contract_number = $data['contract_number'];
            $contract->contract_type = $data['contract_type'];
            $contract->contract_date = $data['contract_date'];
            $contract->contract_status = $data['contract_status'];
            $contract->payment_status = $data['payment_status'];
            $contract->save();
            DB::commit();
            return [
                'result' => 'success',
                'contract' => $contract
            ];
        }catch (\Exception $e){
            DB::rollback();
            Log::error('Ошибка при создании', [
                'code'=>$e->getCode(),
                'message'=>$e->getMessage(),
                'trace'=>$e->getTraceAsString()
            ]);

            return [
                'result' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

}
