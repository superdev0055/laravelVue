<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sistema;
use App\Custom\KeyGenerator;

class SistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sistemas = Sistema::orderBy('nombreSiste')->paginate(4);

        return [
            'pagination' => [
                'total'         => $sistemas->total(),
                'current_page'  => $sistemas->currentPage(),
                'per_page'      => $sistemas->perPage(),
                'last_page'     => $sistemas->lastPage(),
                'from'          => $sistemas->firstItem(),
                'to'            => $sistemas->lastItem()
            ],
            'sistemas' => $sistemas
        ];
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//guarda los datos
    {
        $this->validate($request, [
            'nombreSiste'=> 'required',
            'nombreBreveSiste'=> 'required',
            'fechaCreaSiste'=> 'required',
            'estaSiste'=> 'required'
        ]);

        // Sistema::create($request->all());

        $pk = new KeyGenerator();

        $sistema = new Sistema();
        $sistema->codiSistema = $pk->pk_generator('S');
        $sistema->nombreSiste = $request->get('nombreSiste');
        $sistema->nombreBreveSiste = $request->get('nombreBreveSiste');
        $sistema->fechaCreaSiste = $request->get('fechaCreaSiste');
        $sistema->estaSiste = $request->get('estaSiste');

        $sistema->save();
        return;
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
        $this->validate($request, [
            'nombreSiste'=> 'required',
            'nombreBreveSiste'=> 'required',
            'fechaCreaSiste'=> 'required',
            'estaSiste'=> 'required'
        ]);
        // $sistema = Sistema::findOrFail($id);
        // $sistema->nombreSiste = $request->get('nombreSiste');
        // $sistema->nombreBreveSiste = $request->get('nombreBreveSiste');
        // $sistema->fechaCreaSiste = $request->get('fechaCreaSiste');
        // $sistema->estaSiste = $request->get('estaSiste');
        // $sistema->update();

        Sistema::find($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sistema = Sistema::findOrFail($id);
        $sistema->delete();
    }
}
