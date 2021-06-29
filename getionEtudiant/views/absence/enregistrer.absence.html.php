    <div class="container mt-5">
      <h1>Marquer un etudiant absent</h1>
      <form action="<?php path('absence/saveAbsence/')?>" method="POST">
           
               
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">id Etudiant</label>
                        <input type="number" class="form-control" name="idEtu">
                        <?php if(isset($array_error["idEtu"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["idEtu"]; ?></div>
                        <?php endif; ?>
                    </div>
                
            


            </div>
            <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">id Cours</label>
                        <input type="number" class="form-control" name="idCours">
                        <?php if(isset($array_error["idCours"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["idCours"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
           
            
            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Marquer absent</button>
            </div>
            
        </form>

      </div>
