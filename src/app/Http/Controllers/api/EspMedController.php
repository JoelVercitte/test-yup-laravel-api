<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Especialidade;
use App\Models\Models\espMed;
use App\Models\Models\Medico;
use Illuminate\Support\Facades\DB;
class EspMedController extends Controller
{
    public function index()
    {
        return espMed::all();
    }

    
    

    
    public function store(Request $request)
    {   
        //procurando por cadastros repetidos
        $numCases =
        DB::table('esp_meds')
            ->where([
                ['id_especialidade','=', $request->input('id_especialidade')],
                    ['id_medico','=',$request->input('id_medico')],
                    ])
                    ->count();

        if($numCases<=0){
            //verificando se o medico existe
            if(!DB::table('medicos')->where('id_medico', '=', $request->input('id_medico'))->count()<=0){
                
                //verificando se a especialidade existe
                if(!DB::table('especialidades')->where('id_especialidade', '=', $request->input('id_especialidade'))->count()<=0){
                    espMed::create($request->all());
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
        return DB::table('esp_meds')->where('id_esp_med','=', $id)->get();
    }

    
    public function update(Request $request, $id)
    {
        
        //procurando por cadastros repetidos
        $numCases =
        DB::table('esp_meds')
            ->where([
                ['id_especialidade','=', $request->input('id_especialidade')],
                    ['id_medico','=',$request->input('id_medico')],
                    ])
                    ->count();

        if($numCases<=0){
            //verificando se o medico existe
            if(!DB::table('medicos')->where('id_medico', '=', $request->input('id_medico'))->count()<=0){
                
                //verificando se a especialidade existe
                if(!DB::table('especialidades')->where('id_especialidade', '=', $request->input('id_especialidade'))->count()<=0){
                    DB::table('esp_meds')->where('id_esp_med','=', $id)->update($request->all());
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

    
    public function destroy($id)
    {
        DB::table('esp_meds')->where('id_esp_med','=', $id)->delete();
        
    }
}
