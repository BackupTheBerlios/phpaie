<?php
// contient les fonctions d'envoi d'en-t�te HTTP

// sp�cifier une destination

// Nota  : le param�tre "path_" ne doit pas comporter de "/" final.
//         le param�tre "page_" ne doit pas comporter de "/" initial.

// Nota : m�thode n� 2 ci-dessous retenue pour l'instant
/*  1�re m�thode : HTTP_HOST + PHP_SELF : OK mais
//  Nota : la r�serve ici porte sur la garantie de toujours 
//         disposer de HTTP_HOST
    $temp .= 'http://' ;
    $temp .= .$_SERVER['HTTP_HOST'] ;
    $temp .= '/' .dirname( $_SERVER['PHP_SELF'] ) ;
    $temp .= '/' .'registration.php' ;
*/    
/*  2e m�thode : SCRIPT_NAME : OK
//  Nota : le chemin qui appara�t dans le navigateur est celui 
//         � partir du "host" (!) alors que SCRIPT_NAME est un 
//         chemin absolu (cad commen�ant par "/")...
//         => a priori pas d'objection ...
    $temp .= dirname( $_SERVER['SCRIPT_NAME'] ) ;
    $temp .= '/' .'registration.php' ;
*/    
/*  3e m�thode : REQUEST_URI : OK mais 
//  Nota : le chemin qui appara�t dans le navigateur est l'adresse "physique" 
//         internet du "host" (!) : suivant le chemin, le logiciel finit par 
//         se perdre ...
// :TODO: essayez de comprendre exactement ce qu'il en est !!!
    $temp .= 'http://' ;
    $temp .= $_SERVER['SERVER_NAME'] ;
    $temp .= '/' .dirname( $_SERVER['REQUEST_URI'] ) ;
    $temp .= '/' .'registration.php' ;
*/    

// @todo : 
// - filtrer les "/" �ventuels indiqu�s ci-dessus.
// - v�rifier si pr�sence d'un suffixe � $page_ et ajouter ".php" si n�cessaire
// - v�fifier que $type_ est conforme (http, ftp, ...) et ajouter ce qu'il
//   faut en cons�quence (par ex. "://" )

function http_location( $page_ = '', $path_ = '', $type_ = '', $toString = false )
{
    $temp  = 'Location: ' ;
    if ( $type_ != '' )
    {
        $temp .= $type_ .'://' ;
    }
    if ( $path_ == '' )
    {
        $temp .= dirname( $_SERVER['SCRIPT_NAME'] ) ;
    }
    else
    {
        $temp .= $path_ ;        
    }
    if ( $page_ == '' )
    {
        $temp .= '/' .basename( $_SERVER['REQUEST_URI'] ) ;
    }
    else
    {
        $temp .= '/' .$page_ ;
    }

    if ($toString) return $temp;
    else header( $temp ) ;
    
    // on va directement � la page d'inscription
}


?>
