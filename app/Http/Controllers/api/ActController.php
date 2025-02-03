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
use PhpOffice\PhpWord\TemplateProcessor;
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

    public function generateAct($id){
        try{
            $act = Act::find($id);
            if($act===null){
                return $this->sendError(
                    'Акт не найден'
                );
            }

            $templatePath = resource_path('docs\act.docx');

            if(!file_exists($templatePath)){
                return response()->json([
                   'error'=>'Шаблон акта не найден',
                    'path'=>$templatePath
                ], 404);
            }
            //Заполнение шаблона
            $templateProcessor = new TemplateProcessor($templatePath);
            $templateProcessor->setValues([
                'ACT_NUMBER' => $act->id,
                'DATE_START' => $act->date_start,
                'DATE_END' => $act->date_end,

            ]);

            // Путь для сохранения
            $outputDirectory = storage_path('app/acts');
            if (!is_dir($outputDirectory)) {
                mkdir($outputDirectory, 0755, true); // Создаём директорию с правами доступа
            }

            $outputPath = $outputDirectory . '/act_' . $act->id . '.docx';

            // Сохранение файла
            $templateProcessor->saveAs($outputPath);

            return $this->sendSuccess(
                $outputPath,
                'Акт успешно заполнен'
            );

        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запросов'
            );
        }
    }

}
