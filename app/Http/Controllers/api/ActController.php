<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActRequest;
use App\Http\Requests\UpdateActRequest;
use App\Http\Resources\ActResource;
use App\Http\Resources\BuildingObjectResource;
use App\Http\Service\CreateActService;
use App\Models\Act;
use App\Models\BuildingObject;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\Contract;
use App\Models\ExecutiveScheme;
use App\Models\Project;
use App\Models\Representative;
use App\Models\WorkVolume;
use function PHPUnit\Framework\isEmpty;

class ActController extends BaseController
{

    protected CreateActService $createActService;
    public function __construct(CreateActService $createActService){
        $this->createActService = $createActService;
    }
    public function getAllActs(){
        try{
            $acts = Act::all();
             if($acts->isEmpty()){
                 return $this->sendError(
                     'Акты не найдены',
                     [
                         'message' => 'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                     ]
                 );
            }
             return $this->sendSuccess(
                 ActResource::collection($acts),
                 'Успех'
             );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                [
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function getActById($id){
        try {
            $act = Act::find($id);
            if($act===null){
                return $this->sendError(
                    'Акт не найден',
                    [
                        'message'=>'Введён неверный идентификатор или акта не существует'
                    ]
                );
            }
            return $this->sendSuccess(
                new ActResource($act),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }


    public function getActFormData(){  //Закончить функцию
        return response()->json([
            'building_objects' => BuildingObjectResource::collection(BuildingObject::all()),
            'projects' => Project::all(),
            'contracts' => Contract::all(),
            'schemes' => ExecutiveScheme::all(),
            'work_volumes' => WorkVolume::all(),
            'representatives' => Representative::all(),
            'companies' => Company::all(),
            'certificates' => Certificate::all(),
            //Вписать, что вернуть
        ]);
    }

    public function createAct(CreateActRequest $request){ //закончить функцию
        $data = $request->validated();
        try{
            $act = $this->createActService->createAct($data);
            if($act['result']=='success'){
                return $this->sendSuccess(
                    new ActResource($act['act']),
                    'Акт успешно создан'
                );
            }
            return $this->sendError(
                $act['result'],
                $act['message']
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function updateAct(UpdateActRequest $request, $id){
            try{
                $act = Act::find($id);
                if($act===null){
                    return $this->sendError(
                        'Акт не найден'
                    );
                }
                $act->update($request->validated());
                return $this->sendSuccess(
                    new ActResource($act),
                    'Акт успешно обновлён'
                );
            }catch (\Exception $e){
                return $this->sendError(
                    $e->getMessage(),
                    'Ошибка при обработке запроса'
                );
            }
    }

    public function deleteAct($id){
        try{
            $act = Act::find($id);
            if($act===null){
                return $this->sendError(
                    'Акт не найден'
                );
            }
            $act->delete();
            return $this->sendSuccess(
                'Успех',
                'Акт успешно удалён'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }


}
