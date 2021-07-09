<h1>Page inscription Professeur</h1>

<?php
use ism\lib\Role;
?>
<?php if(Role::estRP()):?>

<div class="container mt-5">
      <h1>Inscription</h1>
      <form action="<?php path('user/registerProf/')?>" method="POST">


            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nomProf" value="<?php
                            echo !isset($array_error["nomProf"]) && isset($array_post["nomProf"])?trim($array_post["nom"]):'';?>
                        ">
                        <?php if(isset($array_error["nomProf"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["nomProf"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenomProf">
                        <?php if(isset($array_error["prenomProf"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["prenomProf"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            
            </div>


            <div class="mb-3">
                <label  class="form-label">date de naissance</label>
                <input type="date" class="form-control" name="dateNaisProf">
                <?php if(isset($array_error["dateNaisProf"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["dateNaisProf"]; ?></div>
                <?php endif; ?>
            </div>


            <div class="mb-3">
                <label  class="form-label">sexe</label>
                <input type="text" class="form-control" name="sexeProf">
                <?php if(isset($array_error["sexeProf"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["sexeProf"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">grade</label>
                <input type="text" class="form-control" name="gradeProf">
                <?php if(isset($array_error["gradeProf"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["gradeProf"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Role</label>
              <select class="form-control" name="roleProf" id="">

                    <option value="ROLE_PROF">Professeur</option>

              </select>
            </div>

            <div class="mb-3">
                <label  class="form-label">Avatar</label>
                <input type="text" class="form-control" name="avatarProf">
                <?php if(isset($array_error["avatarProf"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["avatarProf"]; ?></div>
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
                <label  class="form-label">Module</label>
                <input type="text" class="form-control" name="libelleMod">
                <?php if(isset($array_error["libelleMod"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["libelleMod"]; ?></div>
                <?php endif; ?>
            </div>

           

            <div class="mb-3">
                <label  class="form-label">id Profdiant </label>
                <input type="number" class="form-control" name="id">
                <?php if(isset($array_error["id"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["id"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Inscrire Prof</button>
            </div>
            
        </form>

      </div>

    <?php endif ?>






