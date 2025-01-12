<?php

namespace App\Http\Service;

use App\Models\Act;
use Illuminate\Support\Facades\DB;

class CreateActService
{

    public function createAct($data){
        try{
            DB::beginTransaction();

            $act = new Act();
            $act->date_start = $data['date_start'];
            $act->date_end = $data['date_end'];
            $act->project_id = $data['project_id'] ?? null;
            $act->contract_id = $data['contract_id'] ?? null;
            $act->save();

            // Привязываем объект строительства, если он передан
            if (isset($data['building_object_id'])) {
                $act->buildingObjects()->sync([$data['building_object_id']]);
            }

            // Привязываем сертификат, если он передан
            if (isset($data['certificate_id'])) {
                $act->certifications()->sync([$data['certificate_id']]);
            }
            DB::commit();

            return [
                'result' => 'success',
                'act' => $act
            ];
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'result' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ];
        }
    }

}
