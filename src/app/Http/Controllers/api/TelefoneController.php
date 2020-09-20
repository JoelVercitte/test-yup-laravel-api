<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Telefone;
class TelefoneController extends Controller
{
    
    public function index()
    {
        return Telefone::all();
    }

    
    public function store(Request $request)
    {
        //verificando se já existe um numero igual registrado para evitar repetições
        if(DB::table('telefones')->where('numero', '=', $request->input('numero'))->count()<=0){
            
            //verificando se existe um medico com o id informado
            if(!DB::table('medicos')->where('id_medico', '=', $request->input('id_medico'))->count()<=0){
                Telefone::create($request->all());
            }else{
                return 0;
            }

        }else{
            return 0;
        }
        
    }

    
    public function show($id)
    {
        return DB::table('telefones')->where('id_medico', '=', $id)->get();
    }

    
    public function update(Request $request, $id)
    {
        
        //verificando se já existe um numero igual registrado para evitar repetições
        if(DB::table('telefones')->where('numero', '=', $request->input('numero'))->count()<=0){
            
                DB::table('telefones')->where('id_telefone','=',$id)->update($request->all());
            
        }else{
            return 0;
        }
    }

    
    public function destroy($id)
    {
        DB::table('telefones')->where('id_telefone','=',$id)->delete();
    }
}
