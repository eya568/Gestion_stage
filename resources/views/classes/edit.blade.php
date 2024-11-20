@extends('layouts.crudStudent')

@section('title', 'Modifier Classe')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h4 class="title">Modifier la Classe</h4>
    </div>
    <div class="panel-body">
        <form action="{{ route('classes.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="classe">Classe</label>
                <input type="text" class="form-control" id="classe" name="classe" value="{{ old('classe', $class->classe) }}" required />
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
