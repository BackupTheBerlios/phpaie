<?php
/**
* @package	copix
* @subpackage copixtools
* @version	$Id: CopixFileLocker.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/


/**
 * pseudo-système de verrou de fichier.
 *
 * Principe de fonctionnement
 *
 * Lors du lock, création d'un fichier vide ".lock" du même nom du fichier locké.
 * Test du lock = test de l'existance du fichier.
 * Ecriture protégée = test du lock. Si lock, attente de X delais Y fois pour Y tentatives supplémentaires.
 * Lecture protégée = même principe.
 * Libération du lock = suppression du fichier ".lock"
 *
 * @package	copix
 * @subpackage generaltools
 * @author Gérald Croës.
 */
class CopixFileLocker {
   /**
    * @var string l'extension des fichiers de lock.
	*/
   var $lockExt;

   /**
   * constructeur
	* @param string $lockExt		l'extension du fichier de lock.
	* @param CopixDebug	$ptrObjectDebug	objet de debuggage
   */
   function CopixFileLocker ($lockExt='.lock'){
      $this->lockExt = $lockExt;
   }

   /**
   * Création du fichier verrou.
   * @param string  $fileName	Le nom du fichier a locker.
	* @return boolean	indique si il y a eu creation ou pas du fichier de lock
   */
   function lockFile ($fileName){
      if ($this->isLocked ($fileName)){
         return false;
      }else{
         $fp = fopen ($fileName.$this->lockExt, 'w');
         fclose ($fp);
         return file_exists ($fileName.$this->lockExt);
      }
   }

   /**
    * Indique si le fichier verrou est présent sur le système.
    * @param string	$fileName	le nom du fichier a tester.
   */
   function isLocked ($fileName){
      return file_exists($fileName.$this->lockExt);
   }

   /**
   * Supprime le fichier indicateur du verrou.
   * @param  string $fileName 	le nom du fichier a libérer.
	* @return boolean	indique si le fichier a été libéré
   */
   function unlockFile ($fileName){
      if ($this->isLocked($fileName)){
         return unlink($fileName.$this->lockExt);
      }else{
         return false;
      }
   }

   /**
   * Demande d'écriture dans un fichier avec système de verrou.
   * @param	string	$File			nom du fichier
   * @param string	$DataToWrite	données à ecrire dans le fichier
   * @param string	$Mode			mode d'ouverture du fichier
   * @param integer	$CycleDelais 	delais d'attente entre chaque tentative d'ouverture du fichier
   * @param	integer	$CycleCount		nombre de tentative
   * @return boolean	indique si l'ecriture dans le fichier a reussie
   */
   function write ($file, $dataToWrite, $mode="aw", $cycleDelais=200, $cycleCount=15){
         $waitingCycle = 0;//Nombre de cycle écoulé = 0.
         $writedDats = false;//Les données n'ont pas encore été écrites.

         while ($writedDats == false && ($waitingCycle <= $cycleCount) ){
            //tant que nombre de délais d'attente pas dépassé.
   			if (!$this->lockFile ($file)){
               //impossible de locker le fichier, pause et incrémente le cycle.
               $waitingCycle++;
               usleep ($cycleDelais);
            }else{
               //écriture des données dans le fichier.
               $filePtr = fopen ($file, $mode);
               if ($filePtr){
                  fwrite ($filePtr, $dataToWrite);
               }
               fclose ($filePtr);
               $this->unlockFile ($file);
               $writedDats=true;
            }
         }
         
         //Sortie de la boucle. (impossible d'écrire, traitement de l'erreur)
         return false;
   }

   /**
   * Demande de lecture du fichier avec système de verrou (ne pas lire lors de l'écriture)
   * @param	string	$file			nom du fichier
   * @param integer	$cycleDelais 	delais d'attente entre chaque tentative d'ouverture du fichier
   * @param	integer	$cycleCount		nombre de tentative
   * @return boolean / String	retourne le contenu du fichier ou false si echec.
   */
   function read ($file, $cycleDelais=200, $cycleCount=15){
	  if (is_readable ($file)){
         $waitingCycle = 0;		//Nombre de cycle écoulé = 0.
         $readedDats = false;	//Les données n'ont pas encore été lues.
         while ($readedDats == false && ($waitingCycle <= $cycleCount) ){
         	//tant que nombre de délais d'attente pas dépassé.
            if (!$this->lockFile ($file)){
               //impossible de locker le fichier, pause et incrémente le cycle.
               $waitingCycle++;
               usleep ($cycleDelais);
            }else{
               //lecture des données depuis le fichier.
               $toReturn = implode('', file ($file));
               $this->unlockFile ($file);
               return $toReturn;
            }
         }
         //Sortie de la boucle. (impossible d'écrire, traitement de l'erreur)
         return null;
      }else{
        return null;//fichier non trouvé.
      }
   }
}
?>
