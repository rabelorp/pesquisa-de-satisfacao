<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 
use Illuminate\Database\QueryException; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Users;


class UsersController extends Controller
{
    private $model;

    public function __construct(Users $users){

        $this->model = $users;

    }

    public function getAll(){

        $users = $this->model->all();
        
        try {
            if($users->isEmpty()) {
                return response()->json(['status'=> 'Nenhum usuario encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($users, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Error ao encontrar usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }       
        

    }

    public function get($id){

        $user = $this->model->find($id);
        
        try {  
            if(!$user) {
                return response()->json(['status' => 'Nenhum usuario encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($user, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao encontrar usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   

    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), Users::$rules); 
        
        try {
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_CREATED);
            }
            $user = $this->model->create($request->all());
            return response()->json(['status' => 'usuario criado com sucesso'], Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao criar usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function update($id, Request $request){ 

        $validator = Validator::make($request->all(), Users::$rules);
        $user = $this->model->find($id);

        try {
            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_CREATED);
            }else if($user){
                $user = $this->model->find($id)->update($request->all());
                return response()->json(['status' => 'usuario alterado com sucesso'], Response:: HTTP_CREATED);            
            }
            return response()->json(['status' => 'usuario nao encontrado'], Response:: HTTP_NOT_FOUND);


        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao alterar usuario'.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function delete($id){ 

        $user = $this->model->find($id); 
        // $transaction = Transactions::where('id_client', $user->id)->get();
        
        try {
            if($user){

                // foreach ($transaction as $trans) {
            
                //     Evaluations::where('id', $trans->id_evaluation)->delete();

                // }
                // $transaction = Transactions::where('id_client', $user->id)->delete();
                $user = $this->model->find($id)->delete();

                return response()->json(['status' => 'usuario deletado com sucesso'], Response:: HTTP_CREATED);
            }
            return response()->json(['status' => 'usuario nao encontrado'], Response:: HTTP_NOT_FOUND);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao deletar usuario '], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }
}
