<?php namespace App\Http\Controllers;

use App\Profesor;
use App\Curso;
use Illuminate\Http\Request;

class ProfesorCursoController extends Controller
{
   public function index($profesor_id){
    	$profesor = Profesor::find($profesor_id);
        if($profesor)
        {
            $cursos = $profesor->cursos;
            return $this->crearRespuesta($cursos, 200);
        }
        else
        {
           return $this->crearRespuestaError("No se puede encontrar un profesor con ese ID", 404);     
        }
        
    }

    public function store(Request $request, $profesor_id){
		$profesor = Profesor::find($profesor_id);
        if($profesor)
        {
            $this->validacion($request);

            $campos = $request->all();
            $campos["profesor_id"] = $profesor_id;

            Curso::create($campos);
            return $this->crearRespuesta("Curso creado satisfactoriamente", 200);
        }
        return $this->crearRespuestaError("Profesor no encontrado", 404);


    }

   
    public function update(){
		return "desde ProfesorCursoController update";

    }

 
    public function destroy(){
		return "desde ProfesorCursoController destroy";
    }


    public function validacion(Request $request)
    {
        $reglas = 
        [   
            'titulo' => 'required',
            'descripcion' => 'required',
            'valor' => 'required|numeric'
        ];
        $this->validate($request, $reglas); 
    }


}
