<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeRequest;
use App\Models\Cidade;
use Illuminate\Http\Request;


class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subTitulo = 'Lista de Cidades';

        $cidades = Cidade::orderBy('nome', 'asc')->get();
        return view('admin.cidades.index', compact('cidades', 'subTitulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CidadeRequest $request)
    {

        $cidade = Cidade::create($request->all());

        $request->session()->flash('sucesso', "Cidade $request->nome cadastrada com sucesso!");
        return redirect()->route('cidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidade = Cidade::findOrFail($id);
        return view('admin.cidades.edit', compact('cidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CidadeRequest $request, $id)
    {
        $cidade = Cidade::findOrFail($id);
        $nomeCidade = $cidade->getRawOriginal('nome');
        $cidade->update($request->all());
        $request->session()->flash('sucesso', "Cidade $nomeCidade alterada com sucesso!");
        return redirect()->route('cidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cidade = Cidade::findOrFail($id);
        $nomeCidadeOld = $cidade->nome;
        $totalCount = $cidade->imoveis->count();
        try {
            $cidade->delete();
            $request->session()->flash('sucesso', "Cidade $nomeCidadeOld excluida com sucesso!");
            return redirect()->route('cidades.index');

        } catch (\Exception $e) {
            $request->session()->flash('erro', "Cidade $nomeCidadeOld n??o poder?? ser excluida!");
            return redirect()->route('cidades.index');
        }

    }
}
