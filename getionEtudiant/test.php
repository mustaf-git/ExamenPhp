<?php

// function genererChaineAleatoire($longueur = 10)
// {
//  $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//  $longueurMax = strlen($caracteres);
//  $chaineAleatoire = '';
//  for ($i = 0; $i < $longueur; $i++)
//  {
//  $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
//  }
//  return $chaineAleatoire;
// }
// //Utilisation de la fonction
// echo genererChaineAleatoire(10);

function generate_matricule(){

    $tab = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    $matricule = $tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)];
    return $matricule;

}

echo(generate_matricule());