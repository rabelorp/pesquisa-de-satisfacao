<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Evaluations;
use App\Models\Transactions;

class EvaluationsController extends Controller
{
    private $model;

    public function __construct(Evaluations $evaluations){

        $this->model = $evaluations;

    }

    public function getAll(){

        $evaluations = $this->model->all(); 
        
        try {
            if($evaluations->isEmpty()) {
                return response()->json(['status'=> 'Nenhuma avaliacao encontrada'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($evaluations, Response::HTTP_OK);
            
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Error ao encontrar avaliacao'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }       
        

    }

    public function get($id){

        $evaluation = $this->model->find($id);

        try {
            if(!$evaluation) {
                return response()->json(['status' => 'Nenhuma avaliacao encontrada'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($evaluation, Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['error' => 'Error ao encontrar avaliacao'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   

    }

    public function create(Request $request){

        $validatorEvaluation = Validator::make($request->all(), Evaluations::$rules); 
        $validatorTransaction = Validator::make($request->all(), Transactions::$rules);   
        try {
            if ($validatorEvaluation->fails() || $validatorTransaction->fails()) {
                return response()->json(['status' => 'Preencha todos os campos'], Response::HTTP_CREATED);
            }
            $evaluation = $this->model->create($request->all());

            $request->request->add(['id_evaluation' => $evaluation->id]); 
            $transaction = Transactions::create($request->all()); 

            return response()->json(['status' => 'Avaliacao criada com sucesso'], Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao criar avaliacao'.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

    }

    public function update($id, Request $request){ 
        
        $validatorEvaluation = Validator::make($request->all(), Evaluations::$rules); 
        $validatorTransaction = Validator::make($request->all(), Transactions::$rules);   
        try {
            if ($validatorEvaluation->fails() || $validatorTransaction->fails()) {
                return response()->json(['status' => 'Preencha todos os campos'], Response::HTTP_CREATED);
            }
            $evaluation = $this->model->find($id)->update($request->all());

            $request->request->add(['id_transaction' => $request->id_transaction]); 
            $transaction = Transactions::find($request->id_transaction)->update($request->all());  

            return response()->json(['status' => 'Avaliacao alterada com sucesso'], Response::HTTP_CREATED);
            
        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao alterar avaliacao'.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
        
    }

    public function delete($id){   

        $evaluation = $this->model->find($id);

        try {
            if($evaluation){
                $transaction = Transactions::where('id_evaluation', $evaluation->id)->delete();
                $evaluation = $this->model->find($id)->delete();
                return response()->json(['status' => 'Avaliacao deletada com sucesso'], Response:: HTTP_CREATED);
            }
            return response()->json(['status' => 'Avaliacao nao encontrada'], Response:: HTTP_NOT_FOUND);

        } catch (QueryException $exception) {
            return response()->json(['status' => 'Erro ao deletar avaliacao '.$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }
}
