@extends('layouts.principal')
@section('conteudo-principal')
    <section class="section">
        <table class="highlight centered text-wrap" id="datatable">
            <thead>
            <tr>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Título</th>
                <th>Preço R$</th>
                <th class="right-align">Opções</th>
            </tr>
            </thead>
            <tbody>
            @forelse($imoveis as $imovel)
                <tr style="word-break:break-all;">
                    <td>{{$imovel->cidade->nome}}</td>
                    {{--                    <td>Bairro</td>--}}
                    <td>{{$imovel->endereco->bairro}}</td>
                    <td>{{$imovel->titulo}}</td>
                    <td>R$ {{number_format($imovel->preco, 2, ',', '.')}}</td>


                    <td class="right-align">
                        <a href="{{route('imoveis.show',$imovel->id)}}">
                            <span>
                            <i class="material-icons green-text accent-2 ">visibility</i>
                            </span>
                        </a>
                        <a href="{{route('imoveis.edit',$imovel->id)}}" class="hide-on-med-and-down">
                        <span>
                            <i class="material-icons blue-text accent-2">edit</i>
                        </span>
                        </a>
                        <form action="{{route('imoveis.destroy',$imovel->id)}}" method="post" style="display: inline;"
                              class="hide-on-med-and-down">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: 0;background: transparent;">
                                <span style="cursor: pointer;">
                                    <i class="material-icons red-text accent-3">delete_forever</i>
                                </span>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Não existem Imóveis cadastradas.</td>
                </tr>

            @endforelse
            </tbody>
        </table>

        {{--        btn-floating btn-large waves-effect waves-light--}}
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large waves-effect waves-light" href="{{route('imoveis.create')}}">
                <i class="large material-icons">add</i>
            </a>
        </div>


    </section>
@endsection
