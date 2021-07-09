<?php

use ism\lib\Role;
use ism\lib\Session; ?>
<nav class="navbar navbar-expand-sm navbar-light bg-info mt-1 mb-4">

<?php  if(Role::estAdmin()): ?>
    <a class="navbar-brand" href="<?php path('user/acceuilAdmin') ?>">Esapce Admin</a>
<?php endif ?>

<?php  if(Role::estRP()): ?>
    <a class="navbar-brand" href="<?php path('user/acceuilRP') ?>">Espace Responsable Pedagogique</a>
<?php endif ?>

<?php  if(Role::estAC()): ?>
    <a class="navbar-brand" href="<?php path('user/acceuilAC') ?>">Espace Attaché Classe</a>
<?php endif ?>

<?php  if(Role::estProf()): ?>
    <a class="navbar-brand" href="<?php path('user/acceuilProf') ?>">Espace Professeur</a>
<?php endif ?>

<?php  if(Role::estEtudiant()): ?>
    <a class="navbar-brand" href="<?php path('user/acceuilEtu') ?>">Esapce Etudiant</a>
<?php endif ?>

    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            



            <?php  if(Role::estAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php path('security/register') ?>">ajouter AC OU RP</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php path('user/acceuilAdmin') ?>">modifier AC ou RP</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php path('user/choixAcRp') ?>">supprimer AC ou RP</a>
                </li>
            <?php endif ?>





            <?php if (Role::estRP()) : ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php path('security/register') ?>">ajouter prof</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="<?php path('cours/choixPlanifierCours') ?>">planifier cours</a>
                </li>

                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">lister etudiants</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="nav-link" href="<?php path('user/choixClasse/') ?>">par classe</a>
                            <a class="nav-link" href="<?php path('user/choixMatricule/') ?>">par matricule</a>
                            <a class="nav-link" href="<?php path('user/choixNiveau/') ?>">par niveau</a>
                        </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">lister cours</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="nav-link" href="<?php path('cours/choixProf/') ?>">d'un prof</a>
                        <a class="nav-link" href="<?php path('cours/choixClasse/') ?>">d'une classe</a>
                    </div>
                </li>

            
            <?php endif ?>





            <?php  if(Role::estAC()): ?>

                <li class="nav-item">
                        <a class="nav-link" href="<?php path('security/register') ?>">inscrire etudiant</a>
                </li>

                

                <li class="nav-item">
                        <a class="nav-link" href="<?php path('absence/enregistrerAbsence') ?>">marquer absence</a>
                </li>

                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">lister absences</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="nav-link" href="<?php path('absence/choixEtu/') ?>">d'un etudiant</a>
                            <a class="nav-link" href="<?php path('absence/choixCours/') ?>">d'un cours</a>
                        </div>
                </li>

                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">lister etudiants</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="nav-link" href="<?php path('user/choixClasse/') ?>">par classe</a>
                            <a class="nav-link" href="<?php path('user/choixMatricule/') ?>">par matricule</a>
                            <a class="nav-link" href="<?php path('user/choixNiveau/') ?>">par niveau</a>
                        </div>
                </li>


            <?php endif ?>




            <?php  if(Role::estProf()): ?>

                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">lister etudiants</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="nav-link" href="<?php path('user/choixClasse/') ?>">par classe</a>
                            <a class="nav-link" href="<?php path('user/choixMatricule/') ?>">par matricule</a>
                            <a class="nav-link" href="<?php path('user/choixNiveau/') ?>">par niveau</a>
                        </div>
                </li>

                <li class="nav-item">
                        <a class="nav-link" href="<?php path('absence/enregistrerAbsence') ?>">marquer absence</a>
                </li>

                <li class="nav-item">
                        <a class="nav-link" href="<?php path('cours/showCoursByProf/'.Session::getSession("user_connect")['id']) ?>">lister mes cours</a>
                </li>

            <?php endif ?>

            <?php  if(Role::estEtudiant() ): ?>

                <li class="nav-item">
                        <a class="nav-link" href="<?php path('cours/showCoursByClasse/'.Session::getSession("user_connect")['id']) ?>">lister mes cours</a>
                </li>

                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">lister absences</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="nav-link" href="<?php path('absence/choixSemestre/') ?>">par semestre</a>
                            <a class="nav-link" href="<?php path('absence/choixModule/') ?>">par Module</a>
                        </div>
                </li>

            <?php endif ?>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Parametre</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">

                    <?php if (!Role::estConnect()) : ?>
                        <a class="dropdown-item" href="<?php path('security/login') ?>">Connexion</a>
                    <?php endif ?>

                    <?php if (Role::estConnect()) : ?>
                        <a class="dropdown-item" href="<?php path('security/logout') ?>">Deconnexion</a>
                        <a class="dropdown-item" href="<?php path('security/choixDonesModif') ?>">Modifier mes données</a>
                    <?php endif ?>
                    
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <?php if (Role::estConnect()) : ?>

                <li class="nav-item">
                    <?= Session::getSession("user_connect")["nom_complet"];
                    ?>
                </li>

            <?php endif ?>

        </ul>

    </div>
</nav>