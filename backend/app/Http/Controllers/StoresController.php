<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class StoresController extends Controller
{
    private $model;

    public function __construct(Stores $stores){

        $this->model = $stores;

    }

    public function getAll(){

        $stores = $this->model->all(); 
        
        try {
            if($stores->isEmpty()) {
                return response()->json(['status'=> 'Nenhuma loja encontrada'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($stores, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Error ao encontrar loja'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }       
        

    }

    public function get($id){

        $store = $this->model->find($id); 
        
        try {
            if(!$store) {
                return response()->json(['status' => 'Nenhuma loja encontrada'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($store, Response::HTTP_OK);
                
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro: '.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   

    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), Stores::$rules); 

        try {
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_CREATED);
            }
            $store = $this->model->create($request->all());
            return response()->json(['status' => 'Loja criada com sucesso'], Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao criar loja'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function update($id, Request $request){ 

        $validator = Validator::make($request->all(), Stores::$rules);
        $store = $this->model->find($id);

        try {
            if($validator->fails()){
                return response()->json($validator->erros(), Response::HTTP_CREATED);
            }else if($store){
                $store = $this->model->find($id)->update($request->all());
                return response()->json(['status' => 'Loja alterada com sucesso'], Response:: HTTP_CREATED);            
            }
            return response()->json(['status' => 'Loja nao encontrada'], Response:: HTTP_NOT_FOUND);


        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro: '.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function delete($id){ 

        $store = $this->model->find($id);


        try {
            if($store){
                $store = $this->model->find($id)->delete();
                return response()->json(['status' => 'Loja deletada com sucesso'], Response:: HTTP_CREATED);
            }
            return response()->json(['status' => 'Loja nao encontrada'], Response:: HTTP_NOT_FOUND);


        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao deletar cliente '], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }
}
