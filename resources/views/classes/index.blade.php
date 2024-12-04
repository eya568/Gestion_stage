@extends('layouts.crudStudent')

@section('title', 'Gestion des Étudiants')

@section('content')
@include('components.side-bar')

<div class="col-md-offset-1 col-md-10"> 
   
    <div class="panel">
        <div class="panel-heading">
            <h4 class="title">Liste des Classes</h4>
            <form action="{{ route('classes.index') }}" method="GET" class="search-bar">
                <input type="text" name="search" class="form-control" placeholder="Rechercher" value="{{ request()->input('search') }}" />
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i> Rechercher
                </button>
            </form>
        </div>

        <div class="panel-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Class</th>
                        <th>liste des etudiants</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>{{ $class->classe }}</td>
                        <td>
                            <a href="{{ route('students.index', ['classe' => $class->classe]) }}" class="btn btn-link text-info" title="Voir plus">
                                <i class="fa fa-eye"></i> Voir plus
                            </a>
                        </td>
                        
                        
                        <td>
                            <ul class="action-list">
                                <li>
                                    <a href="#" class="editClassBtn" data-id="{{ $class->id }}" data-name="{{ $class->classe }}" title="Modifier" data-toggle="modal" data-target="#editClassModal">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                </li>
                                <li>
                                   
                                        <a href="#" 
                                           data-toggle="modal" 
                                           data-target="#confirmDeleteModal" 
                                           onclick="setDeleteClassData('{{ $class->id }}', '{{ $class->classe }}')"
                                           title="Supprimer">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                  
                                </li>
                                
                                
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col col-sm-6 col-xs-6">
                    Affichage <b>{{ $classes->count() }}</b> sur <b>{{ $classes->total() }}</b> entrées
                </div>
                <div class="col-sm-6 col-xs-6">
                    <ul class="pagination hidden-xs pull-right">
                        {{ $classes->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fixed-buttons">
    <button 
    class="btn btn-default" 
    title="Ajouter Classe" 
    data-toggle="modal" 
    data-target="#addClassModal">
    <i class="fa fa-plus"></i> Ajouter Classe
</button>

    <button class="btn btn-green" title="Importer Excel" data-toggle="modal" data-target="#importExcelModal">
        <i class="fas fa-file-excel"></i> Importer XL
    </button>



</div>


@endsection


@section('modals')
@include('classes.add')
@include('classes.delete')
@include('classes.edit')
@endsection