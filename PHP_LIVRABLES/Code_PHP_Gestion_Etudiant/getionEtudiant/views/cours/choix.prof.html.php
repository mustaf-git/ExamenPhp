<div class="container">
    <form method="POST" action="<?php path("cours/showAllCoursByProf");?>">
        <div class="form-group row">
            <label for="inputName" class="col-sm-1-12 col-form-label">Merci de mettre l'id du prof</label>
            <div class="col-sm-1-12">
                <input type="text" class="form-control" name="idProf" id="inputName" placeholder="">
            </div>
        </div>
       
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Afficher Cours</button>
            </div>
        </div>
    </form>
</div>