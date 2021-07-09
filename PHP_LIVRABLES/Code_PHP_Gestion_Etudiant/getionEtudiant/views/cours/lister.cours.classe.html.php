<h1>Liste des cours pour cette classe</h1>



<table class="table table-hover"">
  <thead>
    <tr>

    <th scope="col">id Cours</th>
      <th scope="col">Module</th>
      <th scope="col">Prof</th>
      <th scope="col">classe</th>
      <th scope="col">Semestre</th>
      <th scope="col">Date Cours</th>
      <th scope="col">Heure debut</th>
      <th scope="col">Heure fin</th>
      
    </tr>
  </thead>

  <tbody>

  <?php foreach($cours as $cour): ?>
      <tr>
      <th scope="row"><?= $cour["idCours"];?></th>
      <td><?= $cour["libelleMod"];?></td>
      <td><?= $cour["prenomProf"]." ".$cour["nomProf"];?></td>
      <td><?= $cour["libelleCl"];?></td>
      <td><?= $cour["semestre"];?></td>
      <td><?= $cour["dateCours"];?></td>
      <td><?= $cour["heureDeb"];?></td>
      <td><?= $cour["heureFin"];?></td>

    </tr>
    <?php endforeach ?>

  </tbody>
  
</table>