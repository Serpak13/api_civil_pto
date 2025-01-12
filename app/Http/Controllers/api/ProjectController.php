<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Service\CreateProjectService;
use App\Models\Project;

class ProjectController extends BaseController
{

    protected CreateProjectService $createProjectService;
    public function __construct(CreateProjectService $createProjectService){
        $this->createProjectService = $createProjectService;
    }
    public function getAllProjects(){
        try{
            $projects = Project::all();
            if($projects->isEmpty()){
                return $this->sendError(
                  'Проекты не найдены',
                  [
                      'message'=> 'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                  ]
                );
            }
            return $this->sendSuccess(
                ProjectResource::collection($projects),
                'Успех'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                [
                    'message'=> 'Неизвестная ошибка'
                ]
            );
        }
    }

    public function getProjectById($id){
        try{
            $project = Project::find($id);
            if($project === null){
                return $this->sendError(
                    'Проект не найден',
                    'Введён неверный идентификатор или проекта не существует'
                );
            }
            return $this->sendSuccess(
                new ProjectResource($project),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createProject(CreateProjectRequest $request){
        $date = $request->validated();
        try{
            $project = $this->createProjectService->createProject($date);
            //Продолжить
            if ($project['result'] === 'success'){
                return $this->sendSuccess(
                    new ProjectResource($project['project']),
                    'Запись успешно создана'
                );
            }
            return $this->sendError(
              $project['result'],
              $project['message'],
              $project['code']
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Произошла ошибка при обработке запроса'
            );
        }
    }

    public function updateProject(UpdateProjectRequest $request, $id){
        try{
            $project = Project::find($id);
            if($project === null){
                return $this->sendError(
                    'Проект не найден'
                );
            }
            $project->update($request->validated());
            return $this->sendSuccess(
                new ProjectResource($project),
                'Данные успешно обновлены'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function deleteProject($id){
        try{
            $project = Project::find($id);
            if($project === null){
                return $this->sendError(
                    'Проект не найден'
                );
            }
            $project->delete();
            return $this->sendSuccess(
                'Успех',
                'Проект успешно удалён'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }
}
