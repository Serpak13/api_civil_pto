<?php

namespace App\Http\Service;

use App\Http\Requests\CreateCertificateRequest;
use App\Models\Certificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateCertificateService
{

    public function createCertificate($data){
        try{

            DB::beginTransaction();
            $certificate = new Certificate();
            $certificate->name = $data['name'];
            $certificate->code = $data['code'];
            $certificate->date_start = $data['date_start'];
            $certificate->date_end = $data['date_end'];
            $certificate->description = $data['description'];
            $certificate->save();
            DB::commit();
            return ['result' => 'success', 'certificate' => $certificate];
        }catch(\Exception $e){
            DB::rollback();
            Log::error( 'Ошибка при создании', [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ] );

            return [ 'result' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage() ];
        }
    }


}
