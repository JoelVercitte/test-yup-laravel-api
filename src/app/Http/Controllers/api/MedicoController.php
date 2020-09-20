<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Medico;

class MedicoController extends Controller
{
    
    public function index()
    {
        
        return Medico::all();
    }
    

    
    public function store(Request $request)
    {
        //o tamanho de um crm começa com 4 numeros até 10, e possui o estado no final, ex: 0000000000/XX
        //somando os 4 numeros obrigatorios e os 3 digitos do estado, são no minimo 7 digitos
        //o maximo é 13 seguindo a mesma logica
        //wk
        if(strlen($request->input('crm_medico'))>= 7 && strlen($request->input('crm_medico'))<= 13){
            //tamanho ok
            //removendo o /XX do estado para obter apenas os numeros
            $numeros = substr($request->input('crm_medico'), 0,-3); 

            if(ctype_digit($numeros)){
                //verificando se já existe algum medico cadastrado com o mesmo crm para evitar repetições
                if(DB::table('medicos')->where('crm_medico','=', $request->input('crm_medico'))->count()<=0){
                    Medico::create($request->all());
                    return DB::table('medicos')->where('crm_medico','=', $request->input('crm_medico'))->select('medicos.id_medico')->get();
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
        
    }

    
    public function show($id)
    {
        return DB::table('medicos')->where('id_medico','=', $id)->get();
    }

    
    public function update(Request $request, $id)
    {
        
        //o tamanho de um crm começa com 4 numeros até 10, e possui o estado no final, ex: 0000000000/XX
        //somando os 4 numeros obrigatorios e os 3 digitos do estado, são no minimo 7 digitos
        //o maximo é 13 seguindo a mesma logica
        //wk
        if(strlen($request->input('crm_medico'))>= 7 && strlen($request->input('crm_medico'))<= 13){
            //tamanho ok
            //removendo o /XX do estado para obter apenas os numeros
            $numeros = substr($request->input('crm_medico'), 0,-3); 

            if(ctype_digit($numeros)){
                
                //verificando se já existe algum medico cadastrado com o mesmo crm para evitar repetições
                if(DB::table('medicos')->where('crm_medico','=', $request->input('crm_medico'))->count()<=0){
                    DB::table('medicos')->where('id_medico','=', $id)->update($request->all());
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            //falhou no tamanho
            return 0;
        }
    }

    
    public function destroy($id)
    {
        //apagando registros que dependem do id_medico
        DB::table('esp_meds')->where('id_medico','=',$id)->delete();
        DB::table('telefones')->where('id_medico','=',$id)->delete();
        DB::table('medicos')->where('id_medico','=', $id)->delete();
        
    }
}
