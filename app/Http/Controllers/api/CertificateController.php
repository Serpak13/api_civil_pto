<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Http\Resources\CertificateResource;
use App\Http\Service\CreateCertificateService;
use App\Models\Certificate;

class CertificateController extends BaseController
{
    protected CreateCertificateService $createCertificateService;
    public function __construct(CreateCertificateService $createCertificateService){
        $this->createCertificateService = $createCertificateService;
    }

    public function getAllCertificates(){
        try{
            $certificates = Certificate::all();
            if($certificates->isEmpty()){
                return $this->sendError(
                    "Сертификаты не найдены",
                    [
                        'message'=>'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                    ]
                );
            }
            return $this->sendSuccess(
                CertificateResource::collection($certificates),
                'Успех'
            );
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage());
        }
    }

    public function getCertificateById($id){
        try{
            $certificate = Certificate::find($id);
            if($certificate === null){
                return $this->sendError(
                    'Сертификат не найден',
                    'Введён неверный идентификатор или сертификата не существует'
                );
            }
            return $this->sendSuccess(
                new CertificateResource($certificate),
                'Успех'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createCertificate(CreateCertificateRequest $request){
        $data = $request->validated();
        try{
            $certificateResult = $this->createCertificateService->createCertificate($data);

            if ($certificateResult['result'] === 'success'){
                return $this->sendSuccess(
                    $certificateResult['certificate'],
                    'Успех'
                );
            }
            return $this->sendError(
                $certificateResult['message'],
                'Ошибка'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Произошла ошибка при обработке запроса'
            );
        }
    }

    public function updateCertificate(UpdateCertificateRequest $request, $id){

        try{
            $certificate = Certificate::find($id);
            if($certificate === null){
                return $this->sendError(
                    'Сертификат не найден',
                    'Неверно введён идентификатор или такого сертификата не существует'
                );
            }
            $certificate->update($request->validated());
            return $this->sendSuccess(
                $certificate,
                'Данные сертификата успешно обновлены'
            );
        }catch (\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function deleteCertificate($id){
        try{
            $certificate = Certificate::find($id);
            if($certificate === null){
                return $this->sendError(
                    'Сертификат не найден',
                    'Проверьте корректность введённого идентификатора'
                );
            }
            $certificate->delete();
            return $this->sendSuccess(
                'Сертификат успешно удалён'
            );
        }catch(\Exception $exception){
            return $this->sendError(
                $exception->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }
}
