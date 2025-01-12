<?php

namespace App\Http\Service;

use App\Models\Representative;
use Illuminate\Support\Facades\DB;

class CreateRepresentativeService
{

    public function createRepresentative($data){
        try{
            DB::beginTransaction();
            $representative = new Representative();
            $representative->company_id = $data['company_id'] ?? null;
            $representative->name = $data['name'];
            $representative->role = $data['role'];
            $representative->phone = $data['phone'] ?? 'Телефон не указан';
            $representative->email = $data['email'] ?? 'Адрес электронной почты не указан';
            $representative->save();
            DB::commit();
            return [
                'result' => 'success',
                'representative' => $representative
            ];
        }catch (\Exception $exception){
            DB::rollBack();
            return [
                'result' => 'error',
                'code' => 500,
                'message' => $exception->getMessage()
            ];
        }
    }


}
