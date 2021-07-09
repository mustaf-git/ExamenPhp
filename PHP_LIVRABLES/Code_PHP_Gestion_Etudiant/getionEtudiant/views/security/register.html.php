<?php
use ism\lib\Role;
?>
<h1>Formulaire de creation de compte</h1>

<div class="container mt-5">
      <h1>Inscription</h1>
      <form action="<?php path('security/register/')?>" method="POST">


            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" value="<?php
                            echo !isset($array_error["nom"]) && isset($array_post["nom"])?trim($array_post["nom"]):'';?>
                        ">
                        <?php if(isset($array_error["nom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["nom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label  class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom">
                        <?php if(isset($array_error["prenom"])):?>
                            <div  class="form-text text-danger ">
                            <?= $array_error["prenom"]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            
            </div>


            <div class="mb-3">
                <label  class="form-label">Email address</label>
                <input type="text" class="form-control" name="login">
                <?php if(isset($array_error["login"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["login"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Password</label>
                <input type="password" class="form-control"name="password" >
                <?php if(isset($array_error["password"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["password"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Confirm password</label>
                <input type="password" class="form-control"name="confirm_password" >
                <?php if(isset($array_error["confirm_password"])):?>
                    <div  class="form-text text-danger ">
                    <?= $array_error["confirm_password"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label  class="form-label">Avatar</label>
                <input type="text" class="form-control" name="avatar">
                <?php if(isset($array_error["avatar"])):?>
                    <div id="emailHelp" class="form-text text-danger ">
                    <?= $array_error["avatar"]; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Role</label>
              <select class="form-control" name="role" id="">
                <?php if(Role::estAdmin()):?>
                    <option value="ROLE_ADMIN">Administrateur</option>
                    <option value="ROLE_RP">RP</option>
                    <option value="ROLE_AC">AC</option>
                <?php endif; ?>

                <?php if(Role::estRP()):?>
                    <option value="ROLE_PROF">Prof</option>
                <?php endif; ?>
                
                <?php if(Role::estAC()):?>
                    <option value="ROLE_ETUDIANT">Etudiant</option>
                <?php endif; ?>
                
              </select>
            </div>

            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Inscription</button></button>
            </div>
            
        </form>

      </div>
