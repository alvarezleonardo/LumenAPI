<?php namespace App\Http\Controllers;

use App\Profesor;

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
		$reglas = 
        [   
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric',  
            'profesion' => 'required|in:ingenieria,matematica,fisica'
        ];
        $this->validate($request, $reglas);

        Profesor::create($request->all());


        return $this->crearRespuesta('El profesor fue creado correctamente', 201);
    }



    public function update(){
		return "desde ProfesorController update";

    }

 
    public function destroy(){
		return "desde ProfesorController destroy";
    }
}
