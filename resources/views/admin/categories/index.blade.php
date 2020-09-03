@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-success">Criar Categoria</a>
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($categories as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->name}}</td>
                <td>{{$c->description}}</td>
                <td>
                    <div class=btn-group>
                        <a href="{{ route('admin.categories.edit', ['category'=> $c->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.categories.destroy', ['category'=> $c->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
                        </form>
                    </div>
                </td>
            </tr>   
            @endforeach
        </tbody>
    </table>
    {{$categories->links()}} <!-- Exibe paginação. Jamais esquecer! -->
@endsection