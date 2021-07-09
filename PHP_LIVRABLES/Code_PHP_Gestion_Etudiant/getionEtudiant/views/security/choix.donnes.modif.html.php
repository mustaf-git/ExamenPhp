<?php
use ism\lib\Session;
?>
      <div class="container mt-5">
      <h1>Inscription</h1>
      <form action="<?php path("security/modifConnection/".Session::getSession("user_connect")['id']) ?>" method="POST">

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
           
            <div class="row float-right">
             <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
            
        </form>

      </div>