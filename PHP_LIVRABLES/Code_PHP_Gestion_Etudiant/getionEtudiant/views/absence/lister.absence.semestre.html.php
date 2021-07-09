<h1>Lister absence par semestre</h1>


<table class="table table-hover"">
  <thead>
    <tr>
      <th scope="col">matricule Etudiant</th>
      <th scope="col">prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Date Cours</th>
      <th scope="col">Heure debut</th>
      <th scope="col">Heure fin</th>
      <th scope="col">Module</th>
      
    </tr>
  </thead>

  <tbody>

  <?php foreach($absences as $absence): ?>
      <tr>
      <th scope="row"><?= $absence["matriculeEtu"];?></th>
      <td><?= $absence["prenomEtu"];?></td>
      <td><?= $absence["nomEtu"];?></td>
      <td><?= $absence["dateCours"];?></td>
      <td><?= $absence["heureDeb"];?></td>
      <td><?= $absence["heureFin"];?></td>
      <td><?= $absence["libelleMod"];?></td>
    </tr>
    <?php endforeach ?>

  </tbody>
  
</table>