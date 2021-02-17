<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contributors;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ContributorsController extends Controller
{
    private $model;

    public function __construct(Contributors $contributors){

        $this->model = $contributors;

    }

    public function getAll(){

        $contributors = $this->model->all(); 
        
        try {
            if($contributors->isEmpty()) {
                return response()->json(['status'=> 'Nenhum colaborador encontrado'], Response::HTTP_NOT_FOUND);
            }
                return response()->json($contributors, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Error ao encontrar colaborador'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }       
        

    }

    public function get($id){

        $contributor = $this->model->find($id);
        
        try {
            if(!$contributor) {
                return response()->json(['status' => 'Nenhum colaborador encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($contributor, Response::HTTP_OK);
            
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro: '.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   

    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), Contributors::$rules); 

        try {
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_CREATED);
            }
            $contributor = $this->model->create($request->all());
            return response()->json(['status' => 'Colaborador criado com sucesso'], Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao criar colaborador'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function update($id, Request $request){ 

        $validator = Validator::make($request->all(), Contributors::$rules);
        $contributor = $this->model->find($id);

        try {
            if($validator->fails()){
                return response()->json($validator->erros(), Response::HTTP_CREATED);
            }else if($contributor){
                $contributor = $this->model->find($id)->update($request->all());
                return response()->json(['status' => 'Colaborador alterado com sucesso'], Response:: HTTP_CREATED);            
            }
            return response()->json(['status' => 'Colaborador nao encontrado'], Response:: HTTP_CREATED);            


        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao alterar colaborador'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function delete($id){ 

        $contributor = $this->model->find($id);

        try {
            if($contributor){
                $contributor = $this->model->find($id)->delete();
                return response()->json(['status' => 'Colaborador deletado com sucesso'], Response:: HTTP_CREATED);
            }
            return response()->json(['status' => 'Colaborador nao encontrado'], Response:: HTTP_CREATED);


        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao deletar cliente '], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }
}
