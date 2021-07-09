<h1>Planifier Cours</h1>

<div class="container mt-5">
      <h1>Inscription</h1>
      <form action="<?php path("cours/planifierCours") ?>" method="POST">

            <div class="mb-3">
                <label  class="form-label">Date Cours</label>
                <input type="date" class="form-control" name="dateCours">
                <?php if(isset($array_error["dateCours"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["dateCours"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Classe</label>
                <input type="text" class="form-control"name="libelleCl" >
                <?php if(isset($array_error["libelleCl"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["libelleCl"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Matricule Prof</label>
                <input type="text" class="form-control"name="matriculeProf" >
                <?php if(isset($array_error["matriculeProf"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["matriculeProf"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Module</label>
                <input type="text" class="form-control"name="libelleMod" >
                <?php if(isset($array_error["libelleMod"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["libelleMod"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Semestre</label>
                <input type="number" class="form-control"name="semestre" >
                <?php if(isset($array_error["semestre"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["semestre"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Volume Horaire</label>
                <input type="number" class="form-control"name="volumeHoraire" >
                <?php if(isset($array_error["volumeHoraire"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["volumeHoraire"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Heure Debut</label>
                <input type="time" class="form-control" name="heureDeb">
                <?php if(isset($array_error["heureDeb"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["heureDeb"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Heure Fin</label>
                <input type="time" class="form-control" name="heureFin">
                <?php if(isset($array_error["heureFin"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["heureFin"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">id Prof</label>
                <input type="number" class="form-control" name="idProf">
                <?php if(isset($array_error["idProf"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["idProf"]; ?></div>
                <?php endif; ?>
            </div>

           
            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Planifier</button>
            </div>
            
        </form>

      </div>