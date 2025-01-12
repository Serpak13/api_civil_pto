<?php

namespace App\Http\Service;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class CreateProjectService
{

    public function createProject($data){
        try{
          DB::beginTransaction();
          $project = new Project();
          $project->building_object_id = $data['building_object_id'] ?? null;
          $project->name = $data['name'];
          $project->project_code = $data['project_code'];
          $project->project_section = $data['project_section'];
          $project -> project_stage = $data['project_stage'];
          $project -> save();
          DB::commit();
          return [
            'result' => 'success',
            'project' => $project
          ];
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'result' => 'error',
                'code' => 500,
                'message' => $e->getMessage()
            ];
        }
    }


}
