<?php

namespace App\Http\Service;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateWorkVolumeRequest;
use App\Models\WorkVolume;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;

class CreateWorkVolumeService
{
    public function createWorkVolume($data){
        try{
            DB::beginTransaction();
            $workVolume = new WorkVolume();
            $workVolume->name = $data['name'];
            $workVolume->description = $data['description'];
            $workVolume->quantity = $data['quantity'];
            $workVolume->act_id = $data['act_id'] ?? null;
            $workVolume->save();
            DB::commit();
            return[
                'result' => 'success',
                'workVolume' => $workVolume
            ];
        }catch (\Exception $exception){
            DB::rollBack();
            return [
                'result' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }


}
