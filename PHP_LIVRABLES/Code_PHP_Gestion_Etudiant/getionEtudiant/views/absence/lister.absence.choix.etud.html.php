<?php
use ism\lib\Session;
?>
<h1>Lister absences par etudiant</h1>

<div class="container">

    <form method="POST" action="<?php path('absence/showAbsenceByEtu/')?>">


        <div class="form-group row">
            <label for="inputName" class="col-sm-1-12 col-form-label">Merci de mettre l'id de l'etudiant'</label>
            <div class="col-sm-1-12">
                <input type="text" class="form-control" name="idEtu" id="inputName" placeholder="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Afficher absences</button>

    </form>

</div>