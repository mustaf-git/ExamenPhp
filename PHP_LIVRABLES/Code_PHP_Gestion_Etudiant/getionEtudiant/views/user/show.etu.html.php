<h1>Lister les etudiants</h1>


<table class="table table-hover"">
  <thead>
    <tr>
      <th scope="col">matricule Etudiant</th>
      <th scope="col">prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Date Naissance</th>
      <th scope="col">sexe</th>
      <th scope="col">Classe</th>
      <th scope="col">id</th>
      
    </tr>
  </thead>

  <tbody>

  <?php foreach($etudiants as $etudiant): ?>
      <tr>
      <th scope="row"><?= $etudiant["matriculeEtu"];?></th>
      <td><?= $etudiant["prenomEtu"];?></td>
      <td><?= $etudiant["nomEtu"];?></td>
      <td><?= $etudiant["dateNaisEtu"];?></td>
      <td><?= $etudiant["sexeEtu"];?></td>
      <td><?= $etudiant["libelleCl"];?></td>
      <td><?= $etudiant["id"];?></td>
    </tr>
    <?php endforeach ?>

  </tbody>
  
</table>