<?php namespace App\Http\Controllers;

use App\Curso;
use App\Estudiante;
class CursoEstudianteController extends Controller
{
    
	public function index($curso_id){
    	$curso = Curso::find($curso_id);
        if($curso)
        {
            $estudiantes = $curso->estudiantes;
            return $this->crearRespuesta($estudiantes, 200);
        }
        else
        {
           return $this->crearRespuestaError("No se puede encontrar un curso con ese ID", 404);     
        }
        
    }


    public function store($curso_id, $estudiante_id){
		$curso = Curso::find($curso_id);
		if($curso)
		{
			$estudiante = Estudiante::find($estudiante_id);
			if($estudiante)
			{
				$estudiantes = $curso->estudiantes();
				$estudiante = $estudiantes->find($estudiante_id);
				if($estudiante)
				{
					return $this->crearRespuesta("El estudiante ya se encuentra en el curso", 409);
				}
				$curso->estudiantes()->attach($estudiante_id);
				return $this->crearRespuesta("El estudiante fue agregado perfectamente al curso", 200);
			}
			return $this->crearRespuesta("No se encuentra un estudiante con ese id", 404);
		}
		return $this->crearRespuesta("No se encuentra un curso con ese id", 404);

    }

     public function destroy($curso_id, $profesor_id){
		$curso = Curso::find($curso_id);
		if($curso)
		{
			$estudiantes = $curso->estudiantes();
			if($estudiantes->find($estudiante_id))
			{
				$estudiantes->detach($estudiante_id);
				return $this->crearRespuesta("El estudiante fue eliminado correctamente del curso", 200);
			}
			return $this->crearRespuesta("No se encuentra el estudiante con ese id", 404);
		}
		return $this->crearRespuesta("No se encuentra un curso con ese id", 404);
    }


}
