<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Crea el expediente asociado
      try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        $this->validate($request, [
                'idperfil'=>'required|min:9',
                'idfumado' => 'required|min:5',
                'idalcoholismo' => 'required|min:6'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e ) {
        return \response($e->errors(),422);
    }
    if (Gate::allows('solo_pacientedueno',$user )) {
    $expediente = new Expediente();
    $expediente->idperfil = $request->idperfil;
    $expediente->profiles()->associate($profiles->id);
    $expediente->alcohols()->associate($alcohols->id);
    $expediente->fumados()->associate($fumados->id);
    if( $expediente->save()){
        //array de Actividades
        $expediente->activities()->
        attach($request->input('actividades') === null ? [] :
        $request->input('actividades'));

          //array de enfermedades
          $expediente->deseases()->
          attach($request->input('enfermedades') === null ? [] :
          $request->input('enfermedades'));

            //array de alergias
        $expediente->alergias()->
        attach($request->input('alergias') === null ? [] :
        $request->input('alergias'));

        //expediente con características
        $expediente = $expediente->where('id',$expediente->id)->with('activities','deseases','alergias')->first();
        $response=[
            'msg'=>'Información del expediente incluyendo las listas de activities, enfermedades y alergias. ',
            'Lugar'=>$expediente
        ];
        return response()->json(['expediente' => $expediente]);
    }else{
        $response = ['Msg'=>'Error al registrar el expediente, por favor intentelo más tarde!'];
        return response()->json($response,404);
    }

}else {
    $response = ['Msg'=>'No Autorizado'];
    return response()->json($response,404);
}
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
