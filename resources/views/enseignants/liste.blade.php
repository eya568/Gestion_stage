<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500&display=swap" />
  <title>Gestion des Enseignants</title>
  <style>
    body {
      font-family: 'Noto Sans', sans-serif;
      background-color: #f8f9fa;
      /* Couleur de fond plus claire */
    }

    .panel {
      background: #ffffff;
      /* Fond blanc pour le panneau */
      padding: 0;
      border-radius: 10px;
      border: 1px solid #dee2e6;
      /* Bordure grise légère */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      /* Ombre légère */
      margin: 60px auto;
      /* Centre le panneau horizontalement */
      max-width: 800px;
      /* Largeur maximale du panneau */
    }

    .panel .panel-heading {
      padding: 20px 15px;
      border-radius: 10px 10px 0 0;
      background-color: #0006ff7a;
      /* Couleur bleue */
      color: #ffffff;
      /* Texte blanc */
      display: flex;
      /* Utilise flexbox pour l'alignement */
      justify-content: space-between;
      /* Espace entre le titre et la barre de recherche */
      align-items: center;
      /* Aligne verticalement le contenu */
    }

    .panel .panel-heading .title {
      font-size: 28px;
      font-weight: 500;
      margin: 0;
    }

    .panel .panel-body {
      padding: 0;
    }

    .panel .panel-body .table thead tr th {
      background-color: #e9ecef;
      /* Couleur d'arrière-plan plus claire pour l'en-tête */
      color: #495057;
      /* Texte gris foncé */
      font-size: 16px;
      font-weight: 500;
      text-transform: uppercase;
      padding: 12px;
    }

    .panel .panel-body .table tbody tr {
      transition: background-color 0.3s ease, transform 0.3s ease;
      /* Animation pour le survol */
    }

    .panel .panel-body .table tbody tr:hover {
      background-color: #e2e6ea;
      /* Couleur d'arrière-plan au survol */
      transform: translateY(-2px);
      /* Léger mouvement vers le haut */
    }

    .panel .panel-body .table tbody tr td {
      color: #495057;
      /* Texte gris foncé */
      font-size: 15px;
      padding: 10px 12px;
      vertical-align: middle;
      /* Centre le contenu verticalement */
    }

    .panel .panel-body .table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
      /* Légère couleur d'arrière-plan pour les lignes paires */
    }

    .panel .panel-body .table tbody tr td .action-list {
      display: flex;
      /* Aligne les icônes horizontalement */
      justify-content: center;
      /* Centre les icônes horizontalement */
      gap: 10px;
      /* Espace entre les icônes */
      list-style: none;
      /* Retire les puces */
      padding: 0;
      /* Retire le padding */
    }

    .panel .panel-footer {
      background-color: #f8f9fa;
      /* Couleur de fond claire */
      padding: 15px;
    }

    .btn-default {
      background-color: rgba(255,
          166,
          0,
          0.893);
      /* Couleur orange pour le bouton Ajouter Étudiant */
      color: #fff;
      /* Texte blanc */
      border: none;
      /* Pas de bordure */
      transition: transform 0.3s ease;
      /* Animation de transition */
    }

    .btn-default:hover {
      background-color: rgb(255,
          213,
          0);
      /* Couleur bleue plus foncée au survol */
      transform: scale(1.05);
      /* Effet de zoom au survol */
    }

    .btn-green {
      background-color: rgba(0,
          128,
          0,
          0.749);
      /* Couleur verte pour le bouton Importer XL */
      color: #fff;
      /* Texte blanc */
      border: none;
      /* Pas de bordure */
      transition: transform 0.3s ease;
      /* Animation de transition */
    }

    .btn-green:hover {
      background-color: rgba(10,
          210,
          10,
          0.812);
      /* Couleur verte plus foncée au survol */
      transform: scale(1.05);
      /* Effet de zoom au survol */
    }

    .pagination li a {
      color: #007bff;
      /* Couleur bleue pour la pagination */
    }

    .pagination li.active a {
      background-color: #007bff;
      /* Couleur bleue pour l'élément actif */
      color: white;
      /* Texte blanc */
    }

    .fixed-buttons {
      position: fixed;
      /* Positionnement fixe */
      bottom: 20px;
      /* Espace du bas */
      right: 20px;
      /* Espace à droite */
      display: flex;
      /* Aligne les boutons horizontalement */
      gap: 10px;
      /* Espace entre les boutons */
      z-index: 1000;
      /* Au-dessus des autres composants */
    }

    .fa-trash {
      color: red;
    }

    .fa-trash:hover {
      color: rgba(179, 3, 3, 0.917);
      transform: scale(1.05);
      /* Couleur orange pour l'icône de modification */
    }

    .fa-pencil-alt:hover {
      transform: scale(1.05);
      /* Couleur orange pour l'icône de modification */
    }

    .search-bar {
      display: flex;
      align-items: center;
      /* Aligne verticalement l'icône avec le champ de texte */
      margin-left: 15px;
      /* Espacement à gauche */
    }

    .search-bar input {
      width: 150px;
      /* Taille de la barre de recherche */
      margin-right: 5px;
      /* Espace entre le champ de recherche et l'icône */
    }
  </style>
</head>

<body>
  <div class="col-md-offset-1 col-md-10" style="left: 85px">
    <div class="panel">
      <div class="panel-heading">
        <h4 class="title">Liste Des Enseignants</h4>
        <div class="search-bar">

          <form action="{{ route('searchEnseignant') }}" method="GET" style="display: flex; align-items: center;">
            <input type="text" name="query" placeholder="Rechercher" value="{{ request('query') }}">
            <button type="submit" style="background: none; border: none; cursor: pointer;">
              <i class="fa fa-search" style="font-size: 18px; color: white;"></i>
            </button>
          </form>




        </div>
      </div>
      <div class="panel-body table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>CIN</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Email</th>

              <th>Specialite</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @if (!is_null($enseignant) && count($enseignant) > 0)
            @foreach ($enseignant as $ens)
            <tr>
              <th>{{$ens->cin}}</th>
              <th>{{$ens->nom}}</th>
              <th>{{$ens->prenom}}</th>
              <th>{{$ens->email}}</th>
              <th>{{$ens->specialite}}</th>

              <th>
                <a href="{{route('editEnseignant',$ens->id)}}" class="fas fa-pencil-alt green-icon fa-lg" title="Modifier l'enseignant"></a>
                <span class="icon-space"></span>
                <a href="#" class="fas fa-trash-alt red-icon fa-lg" title="Supprimer l'enseignant" onclick="return confirmDelete('{{ $ens->id }}')"></a>
                <script>
                  function confirmDelete(id) {
                    // Affiche la boîte de confirmation
                    if (confirm("Êtes-vous sûr de vouloir supprimer cet enseignant ?")) {
                      // Si l'utilisateur confirme, on redirige vers la route de suppression
                      window.location.href = '/deleteEnseignant/' + id;
                    }
                    return false; // Empêche le comportement par défaut (évite de suivre le lien sans confirmation)
                  }
                </script>

              </th>
              @endforeach
              @else
            <tr>
              <th>no data</th>
            </tr>
            @endif

            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- Boutons fixes en bas à droite -->
  <div class="fixed-buttons">
    <button
      class="btn btn-default"
      title="Ajouter Enseignant"
      data-toggle="modal"
      data-target="#addStudentModal">
      <i class="fa fa-plus"></i> Ajouter Enseignant
    </button>
    <!-- Trigger Button -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcelModal">Importer Excel

    </button>
  </div>

  <!-- Modale pour ajouter un enseignant -->
  <div
    class="modal fade"
    id="addStudentModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addStudentModalLabel"
    aria-hidden="true">
    <form action="{{route('addEnseignant')}} " method="post">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addStudentModalLabel">
              Ajouter un Étudiant
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="studentCIN">CIN</label>
              <input
                type="text"
                name="cin"
                class="form-control"
                id="studentCIN"
                required />
            </div>
            <div class="form-group">
              <label for="studentCIN">Nom</label>
              <input
                type="text"
                name="nom"
                class="form-control"
                id="studentCIN"
                required />
            </div>
            <div class="form-group">
              <label for="studentFirstName">Prénom</label>
              <input
                type="text"
                name="prenom"
                class="form-control"
                id="studentFirstName"
                required />
            </div>
            <div class="form-group">
              <label for="studentClass">Email</label>
              <input
                type="text"
                name="email"
                class="form-control"
                id="studentClass"
                required />
            </div>
            <div class="form-group">
              <label for="studentClass">Specialite</label>
              <input
                type="text"
                name="specialite"
                class="form-control"
                id="studentClass"
                required />
            </div>

          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal">
              Annuler
            </button>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </div>
        </div>
      </div>
  </div>
  </form>

  <!-- Modale pour confirmer la suppression -->
  <div
    class="modal fade"
    id="confirmDeleteModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true"

    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">
          Confirmer la Suppression
        </h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cet étudiant ?
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-dismiss="modal">
          Annuler
        </button>
        <button type="button" class="btn btn-danger">Supprimer</button>
      </div>
    </div>
  </div>
  </div>

  <!-- Modale pour modifier Enseignant -->
  <div
    class="modal fade"
    id="editStudentModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editStudentModalLabel"
    aria-hidden="true">
    <form action="" method="POST">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addStudentModalLabel">
              Modifier Enseignant
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="studentCIN">CIN</label>
              <input
                type="text"
                name="cin"
                value=""
                class="form-control"
                id="studentCIN"
                required />
            </div>
            <div class="form-group">
              <label for="studentCIN">Nom</label>
              <input
                type="text"
                name="nom"
                value=""
                class="form-control"
                id="studentName"
                required />
            </div>
            <div class="form-group">
              <label for="studentFirstName">Prénom</label>
              <input
                type="text"
                name="prenom"
                value=""
                class="form-control"
                id="studentFirstName"
                required />
            </div>
            <div class="form-group">
              <label for="studentClass">Email</label>
              <input
                type="text"
                name="email"
                value=""
                class="form-control"
                id="studentEmail"
                required />
            </div>
            <div class="form-group">
              <label for="studentClass">Spécialité</label>
              <input
                type="text"
                name="specialite"
                value=""
                class="form-control"
                id="studentSpecialite"
                required />
            </div>

          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal">
              Annuler
            </button>
            <button type="button" class="btn btn-primary">Modifier</button>
          </div>
        </div>
      </div>
  </div>
  </form>
  </div>

  <!-- Import Excel Modal -->
  <div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importExcelModalLabel">Importer Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('enseignants.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="import_file">Sélectionnez un fichier Excel :</label>
              <input type="file" name="import_file" class="form-control" required />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Importer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery and Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>