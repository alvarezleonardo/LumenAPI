<?php namespace App\Http\Controllers;

use App\Profesor;
use Illuminate\Http\Request;


class ProfesorController extends Controller
{
  
   public function index(){
        $profesor = Profesor::all();
        return $this->crearRespuesta($profesor, 200);
    }

    public function show($id){
        $profesor = Profesor::find($id);

        if($profesor)
        {
            return $this->crearRespuesta($profesor, 200);
        }

        return $this->crearRespuestaError("Profesor no encontrado", 404);

    }

    public function store(Request $request)
    {
		$this->validacion($request);

        Profesor::create($request->all());

        return $this->crearRespuesta('El profesor fue creado correctamente', 201);
    }



    public function update(Request $request, $profesor_id){

        $profesor = Profesor::find($profesor_id);
        if($profesor)
        {
            $this->validacion($request);

            $profesor->nombre = $request->get('nombre');
            $profesor->direccion = $request->get('direccion');
            $profesor->telefono = $request->get('telefono');
            $profesor->profesion = $request->get('profesion');

            $profesor->save();
            
            return $this->crearRespuesta('El profesor '. $profesor->nombre .' fue actualizado correctamente', 201);                

        }    


        return $this->crearRespuesta('El profesor no se encuentra', 404);
    }

 
    public function destroy($profesor_id){
        $profesor = Profesor::find($profesor_id);
        if($profesor)
        {
            if(sizeof($profesor->cursos) > 0)
            {
                return $this->crearRespuestaError('El profesor tiene cursos asociados', 409);                               
            }    
            $profesor->delete();
            return $this->crearRespuesta('El profesor fue borrado correctamente', 201);               
        }

        return $this->crearRespuestaError('El profesor no se encuentra', 404);
    }

    public function validacion(Request $request)
    {
        $reglas = 
        [   
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric',  
            'profesion' => 'required|in:ingenieria,matematica,fisica'
        ];
        $this->validate($request, $reglas); 
    }
}
