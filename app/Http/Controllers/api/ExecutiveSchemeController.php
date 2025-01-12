<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;

use App\Http\Requests\CreateExecutiveSchemeRequest;
use App\Http\Requests\UpdateSchemeRequest;
use App\Http\Resources\ExecutiveSchemeResource;
use App\Http\Service\CreateExecutiveSchemeService;
use App\Models\ExecutiveScheme;

class ExecutiveSchemeController extends BaseController
{

    protected CreateExecutiveSchemeService $createExecutiveSchemeService;
    public function __construct(CreateExecutiveSchemeService $createExecutiveSchemeService){
        $this->createExecutiveSchemeService = $createExecutiveSchemeService;
    }

    public function getAllExecutiveSchemes(){
        try{
            $schemes = ExecutiveScheme::all();
            if($schemes->isEmpty()){
                return $this->sendError(
                    'Схемы не найдены',
                    [
                        'message'=> 'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                    ]
                );
            }
            return $this->sendSuccess(
                ExecutiveSchemeResource::collection($schemes),
                'Успех'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                [
                    'message'=>'Неизвестная ошибка'
                ]
            );
        }
    }

    public function getExecutiveSchemeById($id){
        try{
            $scheme = ExecutiveScheme::find($id);
            if($scheme == null){
                return $this->sendError(
                    'Схема не найдена',
                    'Введён неверный идентификатор или схемы не существует'
                );
            }
            return $this->sendSuccess(
                new ExecutiveSchemeResource($scheme),
                'Успех'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createExecutiveScheme(CreateExecutiveSchemeRequest $request){
            $data = $request->validated();
            try{
                $scheme = $this->createExecutiveSchemeService->createExecutiveScheme($data);
                if($scheme['result'] === 'success'){
                    return $this->sendSuccess(
                        new ExecutiveSchemeResource($scheme['scheme']),
                        'Запись о схеме успешно создана'
                    );
                }
                return $this->sendError(
                    $scheme['result'],
                    $scheme['message']
                );
            }catch (\Exception $exception){
                return $this->sendError(
                    $exception->getMessage(),
                    'Произошла ошибка при обработке запроса'
                );
            }
    }

    public function updateExecutiveScheme(UpdateSchemeRequest $request, $id){
        try{
            $scheme = ExecutiveScheme::find($id);
            if($scheme === null){
                return $this->sendError(
                    'Схема не найдена'
                );
            }
            $scheme->update($request->validated());
            return $this->sendSuccess(
                new ExecutiveSchemeResource($scheme),
                'Данные успешно обновлены'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Ошибка обновления'
            );
        }
    }

    public function deleteExecutiveScheme($id){
        try{
            $scheme = ExecutiveScheme::find($id);
            if($scheme === null){
                return $this->sendError(
                    'Схема не найдена',
                    'Проверьте корректность идентификатора или обратитесь в тех.поддержку'
                );
            }
            $scheme->delete();
            return $this->sendSuccess(
                'Успех',
                'Схема успешно удалена'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

}
