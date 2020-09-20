<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Especialidade;
use Illuminate\Support\Facades\DB;

class EspecialidadeController extends Controller
{
    public function index()
    {
        //Especialidade::all();
        return 
        DB::table('especialidades')->join('esp_meds', 'especialidades.id_especialidade', '=','esp_meds.id_especialidade')->get();
    }

    
    public function store(Request $request)
    {

        //verificando se já existe algum cadastro com a mesma especialidade
        if (DB::table('especialidades')->where('nome_especialidade', '=', $request->input('nome_especialidade'))->count() <= 0) {
            Especialidade::create($request->all());
        } else {
            return 0;
        }
        

        
    }

    
    public function show($id)
    {
        return DB::table('especialidades')->get();
        //where('id_especialidade', '=', $id)->
    }

    
    public function update(Request $request, $id)
    {
        //verificando se já existe algum cadastro com a mesma especialidade
        if (DB::table('especialidades')->where('nome_especialidade', '=', $request->input('nome_especialidade'))->count() <= 0) {
            DB::table('especialidades')->where('id_especialidade','=',$id)->update($request->all());
        } else {
            return 0;
        }
        
    }

    
    public function destroy($id)
    {
        //deletando algumas tabelas que dependem dessa
        DB::table('esp_meds')->where('id_especialidade','=',$id)->delete();
        $deleted = DB::table('especialidades')->where('id_especialidade','=',$id)->delete();
    }
}
