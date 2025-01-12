<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Http\Resources\ContractResource;
use App\Http\Service\CreateContractService;
use App\Models\Contract;

class ContractController extends BaseController
{

    protected CreateContractService $createContractService;

    public function __construct(CreateContractService $createContractService){
        $this->createContractService = $createContractService;
    }

    public function getAllContracts(){
        try{
            $contracts = Contract::all();
            if($contracts->isEmpty()){
                return $this->sendError(
                    'Контракты не найдены',
                    [
                        'message'=>'Проверьте подключение к базе данных или обратитесь в техническую поддержку'
                    ]
                );
            }
            return $this->sendSuccess(
               ContractResource::collection($contracts),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                [
                    'message'=>'Неизвестная ошибка'
                ]
            );
        }
    }

    public function getContractById($id){
        try{
            $contract = Contract::find($id);
            if($contract === null){
                return $this->sendError(
                  'Контракт не найден',
                    'Введён неверный идентификатор или контракта не существует'
                );
            }
            return $this->sendSuccess(
               new ContractResource($contract),
                'Успех'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }

    public function createContract(CreateContractRequest $request){
        $data = $request->validated();
        try{
            $contractResult = $this->createContractService->createContract($data);
            if($contractResult['result'] === 'success'){
                return $this->sendSuccess(
                    new ContractResource($contractResult['contract']),
                    'Контракт добавлен в базу'
                );
            }
            return $this->sendError(
                $contractResult['message'],
                'Ошибка'
            );
        }catch(\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Ошибка при обработке запроса'
            );
        }
    }

    public function updateContract(UpdateContractRequest $request, $id){
            try{
                $contract = Contract::find($id);
                if($contract === null){
                    return $this->sendError(
                        'Контракт не найден',
                        'Проверьте корректность идентификатора или обратитесь к тех.поддержке'
                    );
                }
                $contract->update($request->validated());
                return $this->sendSuccess(
                    new ContractResource($contract),
                    'Данные о контракте успешно обновлены'
                );
            }catch (\Exception $e){
                return $this->sendError(
                    $e->getMessage(),
                    'Неизвестная ошибка'
                );
            }
    }

    public function deleteContract($id){
        try{
            $contract = Contract::find($id);
            if($contract === null){
                return $this->sendError(
                    'Контракт не найден',
                    'Проверьте корректность идентификатора или обратитесь в тех.поддержку'
                );
            }
            $contract->delete();
            return $this->sendSuccess(
                'Контракт успешно удалён'
            );
        }catch (\Exception $e){
            return $this->sendError(
                $e->getMessage(),
                'Неизвестная ошибка'
            );
        }
    }
}
