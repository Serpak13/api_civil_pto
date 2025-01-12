<?php

namespace App\Http\Service;

use App\Models\BuildingObject;
use Illuminate\Support\Facades\DB;

class CreateBuildingObjectService
{
    public function createBuildingObject($data){
        try{
            DB::beginTransaction();
            $buildingObject = new BuildingObject();
            $buildingObject->contract_id = $data['contract_id'] ?? null;
            $buildingObject->address = $data['address'];
            $buildingObject->save();
            DB::commit();
            return[
              'result' => 'success',
              'buildingObject' => $buildingObject
            ];
        }catch(\Exception $e){
            DB::rollBack();
            return[
                'result' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
