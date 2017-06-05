<?php namespace App\Http\Controllers;

use App\Estudiante;

class EstudianteController extends Controller
{
   
    public function index(){
        $estudiante = Estudiante::all();
        return $this->crearRespuesta($estudiante, 200);
    }

    public function show($id){
        $estudiante = Estudiante::find($id);

        if($estudiante)
        {
            return $this->crearRespuesta($estudiante, 200);
        }

        return $this->crearRespuestaError("Estidiante no encontrado", 404);

    }



    public function store(){
		return "desde estudiantecontroller store";
    }


    public function update(){
		return "desde estudiantecontroller update";

    }

 
    public function destroy(){
		return "desde estudiantecontroller destroy";
    }
}
