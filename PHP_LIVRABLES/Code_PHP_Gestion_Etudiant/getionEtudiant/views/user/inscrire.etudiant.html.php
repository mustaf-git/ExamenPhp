<h1>Page inscription etudiant</h1>

<?php
use ism\lib\Role;
?>
<?php if(Role::estAC()):?>

<div class="container mt-5">
      <h1>Inscription</h1>
      <form action="<?php path('user/registerEtu/')?>" method="POST">


            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nomEtu" value="<?php
                            echo !isset($array_error["nomEtu"]) && isset($array_post["nomEtu"])?trim($array_post["nom"]):'';?>
                        ">
                        <?php if(isset($array_error["nomEtu"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["nomEtu"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomEtu">
                        <?php if(isset($array_error["prenomEtu"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["prenomEtu"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            
            </div>


            <div class="mb-3">
                <label  class="form-label">date de naissance</label>
                <input type="date" class="form-control" name="dateNaisEtu">
                <?php if(isset($array_error["dateNaisEtu"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["dateNaisEtu"]; ?></div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label  class="form-label">sexe</label>
                <input type="text" class="form-control" name="sexeEtu">
                <?php if(isset($array_error["sexeEtu"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["sexeEtu"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Role</label>
              <select class="form-control" name="roleEtu" id="">

                    <option value="ROLE_ETUDIANT">Etudiant</option>

              </select>
            </div>

            <div class="mb-3">
                <label  class="form-label">Avatar</label>
                <input type="text" class="form-control" name="avatarEtu">
                <?php if(isset($array_error["avatarEtu"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["avatarEtu"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Classe</label>
                <input type="text" class="form-control" name="libelleCl">
                <?php if(isset($array_error["libelleCl"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["libelleCl"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Compétences</label>
                <input type="text" class="form-control" name="competenceEtu">
                <?php if(isset($array_error["competenceEtu"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["competenceEtu"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">parcours</label>
                <input type="text" class="form-control" name="parcoursEtu">
                <?php if(isset($array_error["parcoursEtu"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["parcoursEtu"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">id etudiant </label>
                <input type="number" class="form-control" name="id">
                <?php if(isset($array_error["id"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["id"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Inscrire Etudiant</button>
            </div>
            
        </form>

      </div>

    <?php endif ?>






