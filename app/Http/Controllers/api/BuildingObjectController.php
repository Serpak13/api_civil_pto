<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateBuildingObjectRequest;
use App\Http\Requests\UpdateBuildingObjectRequest;
use App\Http\Resources\BuildingObjectResource;
use App\Http\Service\CreateBuildingObjectService;
use App\Models\BuildingObject;


class BuildingObjectController extends BaseController
{

    protected CreateBuildingObjectService $createBuildingObjectService;
    public function __construct(CreateBuildingObjectService $createBuildingObjectService){
        $this->createBuildingObjectService = $createBuildingObjectService;
    }

    public function getAllBuildingObjects(){
        try{
            $buildingObjects = BuildingObject::all();
            if($buildingObjects->isEmpty()){
                return $this->sendError(
                    "Информация о строительных объектах не найдена",
                    'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                );
            }
            return $this->sendSuccess(
               BuildingObjectResource::collection($buildingObjects),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function getBuildingObjectById($id){
        try{
            $object = BuildingObject::find($id);
            if($object === null){
                return $this->sendError(
                    'Объект не найден',
                    'Введён неверный идентификатор или объекта не существует'
                );
            }
            return $this->sendSuccess(
               new BuildingObjectResource($object),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createBuildingObject(CreateBuildingObjectRequest $request){
        $data = $request->validated();
        try{
            $buildingObject = $this->createBuildingObjectService->createBuildingObject($data);
            if($buildingObject['result'] === 'success'){
                return $this->sendSuccess(
                    new BuildingObjectResource($buildingObject['buildingObject']),
                    'Запись о объекте успешно создана'
                );
            }
            return $this->sendError(
                $buildingObject['result'],
                $buildingObject['message']
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function updateBuildingObject(UpdateBuildingObjectRequest $request, $id){
        try{
            $buildingObject = BuildingObject::find($id);
            if($buildingObject === null){
                return $this->sendError(
                    'Ошибка',
                    'Строительный объект не найден'
                );
            }
            $buildingObject->update($request->validated());
            return $this->sendSuccess(
                new BuildingObjectResource($buildingObject),
                'Информация успешно обновлена'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка обработки запроса'
            );
        }
    }
    public function deleteBuildingObject($id){
        try{
            $buildingObject = BuildingObject::find($id);
            if($buildingObject === null){
                return $this->sendError(
                    'Ошибка',
                    'Строительный объект не найден'
                );
            }
            $buildingObject->delete();
            return $this->sendSuccess(
                'Успех',
                'Информация о строительном объекте удалена'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

}
