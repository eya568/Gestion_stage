<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des Soutenances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-bottom: 60px;
        }

        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hover-effect:hover {
            background-color: #f1f1f1;
        }

        .sidebar {
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            padding: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                @include('components.side-bar')
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-4">
                    <div class="table-container">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2>Liste des Soutenances D'initiation</h2>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus-circle"></i> Ajouter une Soutenance
                            </button>
                        </div>
                        <table class="table table-striped hover-effect mt-3">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Jury 1</th>
                                    <th>Jury 2</th>
                                    <th>Société de Stage</th>
                                    <th>Durée de Stage</th>
                                    <th>Classe</th>
                                    <th>Heure</th>
                                    <th>Date de Soutenance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($soutenances as $soutenance)
                                <tr>
                                    <td>{{ $soutenance->etudiant }}</td>
                                    <td>{{ $soutenance->jury1 }}</td>
                                    <td>{{ $soutenance->jury2 }}</td>
                                    <td>{{ $soutenance->societe }}</td>
                                    <td>{{ $soutenance->date_debut }} - {{ $soutenance->date_fin }}</td>
                                    <td>{{ $soutenance->classe }}</td>
                                    <td>{{ $soutenance->heure }}</td>
                                    <td>{{ $soutenance->date_soutenance }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Ajouter une Soutenance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('soutenances.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="initiation"> <!-- Set type -->
                        <div class="mb-3">
                            <label for="etudiant" class="form-label">Étudiant</label>
                            <input type="text" name="etudiant" id="etudiant" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="jury1" class="form-label">Jury 1</label>
                            <input type="text" name="jury1" id="jury1" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="jury2" class="form-label">Jury 2</label>
                            <input type="text" name="jury2" id="jury2" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="societe" class="form-label">Société de Stage</label>
                            <input type="text" name="societe" id="societe" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de Début</label>
                            <input type="date" name="date_debut" id="date_debut" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de Fin</label>
                            <input type="date" name="date_fin" id="date_fin" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="classe" class="form-label">Classe</label>
                            <input type="text" name="classe" id="classe" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="heure" class="form-label">Heure</label>
                            <input type="time" name="heure" id="heure" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="date_soutenance" class="form-label">Date de Soutenance</label>
                            <input type="date" name="date_soutenance" id="date_soutenance" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>