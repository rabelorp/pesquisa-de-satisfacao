<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 
use Illuminate\Database\QueryException; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Clients;
use App\Models\Transactions;
use App\Models\Evaluations;

class ClientsController extends Controller
{
    private $model;

    public function __construct(Clients $clients){

        $this->model = $clients;

    }

    public function getAll(){

        $clients = $this->model->all();
        
        try {
            if($clients->isEmpty()) {
                return response()->json(['status'=> 'Nenhum cliente encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($clients, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Error ao encontrar cliente'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }       
        

    }

    public function get($id){

        $client = $this->model->find($id);
        
        try {  
            if(!$client) {
                return response()->json(['status' => 'Nenhum cliente encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($client, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao encontrar cliente'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   

    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), Clients::$rules); 
        
        try {
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_CREATED);
            }
            $client = $this->model->create($request->all());
            return response()->json(['status' => 'Cliente criado com sucesso'], Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao criar cliente'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function update($id, Request $request){ 

        $validator = Validator::make($request->all(), Clients::$rules);
        $client = $this->model->find($id);

        try {
            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_CREATED);
            }else if($client){
                $client = $this->model->find($id)->update($request->all());
                return response()->json(['status' => 'Cliente alterado com sucesso'], Response:: HTTP_CREATED);            
            }
            return response()->json(['status' => 'Cliente nao encontrado'], Response:: HTTP_NOT_FOUND);


        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao alterar cliente'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function delete($id){ 

        $client = $this->model->find($id); 
        $transaction = Transactions::where('id_client', $client->id)->get();
        
        try {
            if($client){

                foreach ($transaction as $trans) {
            
                    Evaluations::where('id', $trans->id_evaluation)->delete();

                }
                $transaction = Transactions::where('id_client', $client->id)->delete();
                $client = $this->model->find($id)->delete();

                return response()->json(['status' => 'Cliente deletado com sucesso'], Response:: HTTP_CREATED);
            }
            return response()->json(['status' => 'Cliente nao encontrado'], Response:: HTTP_NOT_FOUND);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao deletar cliente '], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }
}
