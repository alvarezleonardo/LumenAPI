<?php namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;


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


    public function store(Request $request)
    {
        $this->validacion($request);

        Estudiante::create($request->all());

        return $this->crearRespuesta('El estudiante fue creado correctamente', 201);
    }


    public function update(Request $request, $estudiante_id){

        $estudiante = Estudiante::find($estudiante_id);
        if($estudiante)
        {
            $this->validacion($request);

            $estudiante->nombre = $request->get('nombre');
            $estudiante->direccion = $request->get('direccion');
            $estudiante->telefono = $request->get('telefono');
            $estudiante->profesion = $request->get('profesion');

            $estudiante->save();
            
            return $this->crearRespuesta('El estudiante '. $estudiante->nombre .' fue actualizado correctamente', 201);                

        }    


        return $this->crearRespuesta('El estudiante no se encuentra', 404);
    }

 
    public function destroy($estudiante_id){
		$estudiante = Estudiante::find($estudiante_id);
        if($estudiante)
        {
            $estudiante->cursos()->sync([]);
            $estudiante->delete();

            return $this->crearRespuesta('El estudiante fue borrado correctamente', 201);               
        }

        return $this->crearRespuesta('El estudiante no se encuentra', 404);
    }

    public function validacion(Request $request)
    {
        $reglas = 
        [   
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric',  
            'carrera' => 'required|in:ingenieria,matematica,fisica'
        ];
        $this->validate($request, $reglas); 
    }
}
