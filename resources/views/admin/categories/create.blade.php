@extends('layouts.app')

@section('content')

    <h1>Criar Produto</h1>
    <form action="{{ route('admin.categories.store')  }}" method="POST">
        @csrf <!--cria token para formularios do laravel -->
        <div class="form-group">
            <label>Nome produto</label>
            <input type="text" name="name" class="form-control  @error('name')is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>  
        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control  @error('description')is-invalid @enderror" value="{{ old('description') }}">
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div> 
        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar loja</button>
        </div>
    </form>

@endsection