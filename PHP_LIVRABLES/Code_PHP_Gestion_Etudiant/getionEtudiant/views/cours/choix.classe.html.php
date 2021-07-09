<div class="container">
    <form method="POST" action="<?php path("cours/showAllCoursByClasse");?>">
        <div class="form-group row">
            <label for="inputName" class="col-sm-1-12 col-form-label">Merci de mettre la classe</label>
            <div class="col-sm-1-12">
                <input type="text" class="form-control" name="libelleCl" id="inputName" placeholder="">
            </div>
        </div>
       
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Afficher Cours</button>
            </div>
        </div>
    </form>
</div>