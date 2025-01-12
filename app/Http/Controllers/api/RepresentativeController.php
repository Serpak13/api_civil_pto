<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRepresentativeRequest;
use App\Http\Requests\UpdateRepresentativeRequest;
use App\Http\Resources\RepresentativeResource;
use App\Http\Service\CreateRepresentativeService;
use App\Models\Representative;

class RepresentativeController extends BaseController
{

    protected CreateRepresentativeService $createRepresentativeService;
    public function __construct(CreateRepresentativeService $createRepresentativeService){
        $this->createRepresentativeService = $createRepresentativeService;
    }

    public function getAllRepresentatives(){
        try{
            $representatives = Representative::all();
            if($representatives->isEmpty()){
                return $this->sendError(
                    'Представители не найдены',
                    [
                        'message' => 'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                    ]
                );
            }
            return $this->sendSuccess(
               RepresentativeResource::collection($representatives),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                [
                    'message' => 'Неизвестная ошибка'
                ]
            );
        }
    }

    public function getRepresentativeById($id){
        try{
            $representative = Representative::find($id);
            if($representative === null){
                return $this->sendError(
                    'Представитель не найден',
                    'Введён неверный идентификатор или представителя не существует'
                );
            }
            return $this->sendSuccess(
                new RepresentativeResource($representative),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createRepresentative(CreateRepresentativeRequest $request){
        $data = $request->validated();
        try{
            $representative = $this->createRepresentativeService->createRepresentative($data);
            if($representative['result'] == 'success'){
                return $this->sendSuccess(
                    new RepresentativeResource($representative['representative']),
                    'Запись о представителе успешно создана'
                );
            }
            return $this->sendError(
                $representative['result'],
                $representative['message']
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function updateRepresentative(UpdateRepresentativeRequest $request, $id){
        try{
            $representative = Representative::find($id);
            if($representative === null){
                return $this->sendError(
                    'Данные не найдены'
                );
            }
            $representative->update($request->validated());
            return $this->sendSuccess(
                new RepresentativeResource($representative),
                'Успех'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function deleteRepresentative($id){
        try{
            $representative = Representative::find($id);
            if($representative === null){
                return $this->sendError(
                    'Данные о представителе не найдены'
                );
            }
            $representative->delete();
            return $this->sendSuccess(
                'Данные о представителе успешно удалены'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка обработки запросов'
            );
        }
    }

}
