<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     linkBar
 * Version:  1.0
 * Date:     06/02/2004
 * Author:	 yan bertrand <ybertrand@aston.fr>, gérald croes <gcroes@aston.fr>
 * Purpose:  LinkBar for navigation.
 *
 * Input:    pageNum  = (required)  the page number we wants to display
 *           nbLink = (obtional) number of link in the bar
 *           nbTotalPage = (required) total number of pages.
 *           url = (required) url which is called when you clic on a link
 *                 (for example url = 'index.php?pageNum='
 *                  if we click on the second page we'll go to :
 *                  index.php?pageNum=2)
 *
 *
 * Examples:
 * {linkBar url="index.php?showPage=" nbLink=2 pageNum=1 nbTotalPage=100}
 */
function smarty_function_linkBar($params, &$this) {
   extract($params);
   if (empty ($pageNum)){
     $smarty->_trigger_fatal_error("[smarty linkBar] Missing pageNum parameter");
     return;
   }
   if (empty ($nbTotalPage)){
     $smarty->_trigger_fatal_error("[smarty linkBar] Missing nbTotalPage parameter");
     return;
   }
   if (empty ($url)){
     $smarty->_trigger_fatal_error("[smarty linkBar] Missing url parameter");
     return;
   }
   if (empty ($nbLink)){
     $nbLink = 5;
   }
   

   if ($pageNum <> 1){
      $toReturn='<a href="' . $url . ($pageNum-1) . '">&lt;</a>';
   }
   $nbLinkShow = ($nbTotalPage)>$nbLink ? $nbLink : $nbTotalPage;

   $show = true;
   for ($i=0; $i<$nbLinkShow; $i++){
      $toReturn .= '&nbsp;';

      if (($pageNum+$nbLinkShow/2)>($nbTotalPage)){
         $nextpage =$nbTotalPage+$i-$nbLinkShow+1;
         if (($nextpage)<=($nbTotalPage)){
            if (($nextpage)==($pageNum)){
               $toReturn.=$nextpage;
               if (($nextpage)==($nbTotalPage)){
                  $show=false;
               }
            }else{
               $toReturn.='<a href="' . $url . $nextpage . '">' . $nextpage . '</a>';
            }
         }
      }else{
         if (($pageNum-$nbLinkShow/2)<=0){
            $nextpage=$i+1;
            if (($nextpage)<=($nbTotalPage)){
               if (($nextpage)==($pageNum)){
                  $toReturn.=$nextpage;
                  if (($nextpage)==($nbTotalPage)){
                     $show=false;
                  }
               }else{
                  $toReturn.='<a href="' .$url . $nextpage .'">' . $nextpage . '</a>';
               }
            }
         }else{
            $nextpage=round($i+$pageNum-$nbLinkShow/2);
            if (($nextpage)<=($nbTotalPage)){
               if (($nextpage)==($pageNum)){
                  $toReturn.=$nextpage;
                  if ($nextpage==($nbTotalPage)){
                     $show = false;
                  }
               }else{
                  $toReturn.='<a href="' . $url . $nextpage . '">' . $nextpage . '</a>';
               }
            }
         }
      }
   }

   if ($show){
      $toReturn .= '&nbsp;<a href="' . $url . ($pageNum+1) . '">&gt;</a>';
   }
   return $toReturn;
}
?>
