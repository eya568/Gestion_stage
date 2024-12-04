@extends('layouts.crudStudent')

@section('title', 'Gestion des Étudiants')

@section('content')
@include('components.side-bar')
    <div class="panel">
        <div class="panel-heading">
            <h4 class="title">Liste des Étudiants</h4>
            <form action="{{ route('students.index') }}" method="GET" class="search-bar">
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
                        <th>CIN</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Classe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentList">
                    @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->cin }}</td>
                        <td>{{ $student->nom }}</td>
                        <td>{{ $student->prenom }}</td>
                        <td>{{ $student->classe->classe }}</td>
                        <td>
                            <ul class="action-list">
                                <li>

                                    <a href="#" class="editStudentBtn" data-id="{{ $student->id }}" title="Modifier" data-toggle="modal" data-target="#editStudentModal">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                </li>
                                <li>

                                    <a href="#" data-toggle="modal" data-target="#confirmDeleteModal" title="Supprimer" onclick="setDeleteStudentId('{{ $student->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun étudiant dans cette classe</td> <!-- Display message if no students -->
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col col-sm-6 col-xs-6">
                    Affichage <b>{{ $students->count() }}</b> sur <b>{{ $students->total() }}</b> entrées
                </div>
                <div class="col-sm-6 col-xs-6">
                    <ul class="pagination hidden-xs pull-right">
                        {{ $students->appends(['classe' => $selectedClasse])->links() }} <!-- Use $selectedClasse here -->
                    </ul>
                </div>
            </div>
        </div>

    </div>




<div class="fixed-buttons">
    <!-- Bouton pour ouvrir le modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
        Ajouter un étudiant
    </button>

    <button class="btn btn-green" title="Importer Excel" data-toggle="modal" data-target="#importExcelModal">
        <i class="fas fa-file-excel"></i> Importer XL
    </button>



</div>


@endsection

@section('modals')
@include('students.add')
@include('students.delete')
@include('students.edit')
@include('students.excelimport')
@endsection