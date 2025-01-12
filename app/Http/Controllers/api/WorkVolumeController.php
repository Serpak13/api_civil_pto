<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorkVolumeRequest;
use App\Http\Requests\UpdateWorkVolumeRequest;
use App\Http\Resources\WorkVolumeResource;
use App\Http\Service\CreateWorkVolumeService;
use App\Models\WorkVolume;

class WorkVolumeController extends BaseController
{

    protected CreateWorkVolumeService $createWorkVolumeService;
    public function __construct(CreateWorkVolumeService $createWorkVolumeService){
        $this->createWorkVolumeService = $createWorkVolumeService;
    }

    public function getAllWorkVolumes(){
        try{
            $workVolumes = WorkVolume::all();
            if($workVolumes->isEmpty()){
                return $this->sendError(
                    'Информация по объёмам работ отсутствует',
                    [
                        'message'=> 'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                    ]
                );
            }
            return $this->sendSuccess(
                WorkVolumeResource::collection($workVolumes),
                'Успех'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                [
                    'message' => 'Неизвестная ошибка'
                ]
            );
        }
    }

    public function getWorkVolumeById($id){
        try{
            $workVolume = WorkVolume::find($id);
            if($workVolume == null){
                return $this->sendError(
                    'Данные по объёму работ не найдены',
                    'Введён неверный идентификатор или данных не существует'
                );
            }
            return $this->sendSuccess(
                new WorkVolumeResource($workVolume),
                'Успех'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createWorkVolume(CreateWorkVolumeRequest $request){
        $data = $request->validated();
        try{
            $workVolume = $this->createWorkVolumeService->createWorkVolume($data);
            if($workVolume['result'] === 'success'){
                return $this->sendSuccess(
                    new WorkVolumeResource($workVolume['workVolume']),
                    'Данные по объёму работ успешно внесены'
                );
            }
            return $this->sendError(
                $workVolume['result'],
                $workVolume['message']
            );
        }catch (\Exception $exception){
            return $this->sendError(
                'Ошибка обработки запросов'
            );
        }
    }

    public function updateWorkVolume(UpdateWorkVolumeRequest $request, $id){
        try{
            $workVolume = WorkVolume::find($id);
            if($workVolume === null){
                return $this->sendError(
                    'Данные не найдены'
                );
            }
            $workVolume->update($request->validated());
            return $this->sendSuccess(
                new WorkVolumeResource($workVolume),
                'Данные успешно обновлены'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function deleteWorkVolume($id){
        try{
            $workVolume = WorkVolume::find($id);
            if($workVolume === null){
                return $this->sendError(
                    'Данные не найдены'
                );
            }
            $workVolume->delete();
            return $this->sendSuccess(
                'Данные успешно удалены'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                'Ошибка при выполнении запроса'
            );
        }
    }


}
