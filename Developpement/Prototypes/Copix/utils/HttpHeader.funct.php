<?php
// contient les fonctions d'envoi d'en-tête HTTP

// spécifier une destination

// Nota  : le paramètre "path_" ne doit pas comporter de "/" final.
//         le paramètre "page_" ne doit pas comporter de "/" initial.

// Nota : méthode n° 2 ci-dessous retenue pour l'instant
/*  1ère méthode : HTTP_HOST + PHP_SELF : OK mais
//  Nota : la réserve ici porte sur la garantie de toujours 
//         disposer de HTTP_HOST
    $temp .= 'http://' ;
    $temp .= .$_SERVER['HTTP_HOST'] ;
    $temp .= '/' .dirname( $_SERVER['PHP_SELF'] ) ;
    $temp .= '/' .'registration.php' ;
*/    
/*  2e méthode : SCRIPT_NAME : OK
//  Nota : le chemin qui apparaît dans le navigateur est celui 
//         à partir du "host" (!) alors que SCRIPT_NAME est un 
//         chemin absolu (cad commençant par "/")...
//         => a priori pas d'objection ...
    $temp .= dirname( $_SERVER['SCRIPT_NAME'] ) ;
    $temp .= '/' .'registration.php' ;
*/    
/*  3e méthode : REQUEST_URI : OK mais 
//  Nota : le chemin qui apparaît dans le navigateur est l'adresse "physique" 
//         internet du "host" (!) : suivant le chemin, le logiciel finit par 
//         se perdre ...
// :TODO: essayez de comprendre exactement ce qu'il en est !!!
    $temp .= 'http://' ;
    $temp .= $_SERVER['SERVER_NAME'] ;
    $temp .= '/' .dirname( $_SERVER['REQUEST_URI'] ) ;
    $temp .= '/' .'registration.php' ;
*/    

// @todo : 
// - filtrer les "/" éventuels indiqués ci-dessus.
// - vérifier si présence d'un suffixe à $page_ et ajouter ".php" si nécessaire
// - véfifier que $type_ est conforme (http, ftp, ...) et ajouter ce qu'il
//   faut en conséquence (par ex. "://" )

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
    
    // on va directement à la page d'inscription
}


?>
