<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Service\CreateCompanyService;
use App\Models\Company;

class CompanyController extends BaseController
{

    protected CreateCompanyService $createCompanyService;
    public function __construct(CreateCompanyService $createCompanyService){
        $this->createCompanyService = $createCompanyService;
    }
    public function getAllCompanies(){
        try{
            $companies = Company::all();
            if($companies->isEmpty()){
                return $this->sendError(
                    'Компании не найдены',
                    [
                        'message'=>'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                    ]
                );
            }
            return $this->sendSuccess(
                $companies,
                'Успех'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                [
                    'message'=>'Неизвестная ошибка'
                ]
            );
        }
    }

    public function getCompanyById($id){
        try{
            $company = Company::find($id);
            if($company === null){
                return $this->sendError(
                    'Компания не найдена',
                    'Введён неверный идентификатор или компании не существует'
                );
            }
            return $this->sendSuccess(
                $company,
                'Успех'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createCompany(CreateCompanyRequest $request){
        $data = $request->validated();
        try{
            $company = $this->createCompanyService->createCompany($data);
            if($company['result'] === 'success'){
                return $this->sendSuccess(
                    new CompanyResource($company['company']),
                  'Успех'
                );
            }
            return $this->sendError(
                $company['message'],
                'Ошибка'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function updateCompany(UpdateCompanyRequest $request, $id){
            try{
                $company = Company::find($id);
                if($company === null){
                    return $this->sendError(
                      'Компания не найдена',
                        'Неверно введён идентификатор или такой компании не существует'
                    );
                }
                $company->update($request->validated());
                return $this->sendSuccess(
                    new CompanyResource($company),
                    'Данные о компании успешно обновлены'
                );
            }catch (\Exception $e){
                return $this->sendError(
                    $e->getMessage(),
                    'Неизвестная  ошибка'
                );
            }
    }

    public function deleteCompany($id){
        try{
            $company = Company::find($id);
            if($company === null){
                return $this->sendError(
                    'Компания не найдена',
                    'Проверьте корректность введённого идентификатора'
                );
            }
            $company->delete();
            return $this->sendSuccess(
                'Данные о компании удалены'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестна ошибка'
            );
        }
    }

}
