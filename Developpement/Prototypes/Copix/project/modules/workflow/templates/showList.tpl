{* PhPaie project : showList.tpl (Smarty template file) *}
{* Input(s):
 - DATA_LIST
 - OBJECT_LIST
 - REQUEST
 - TAGGED: array of tagged object's Id
 - MULTITAG: true if multi tags (true by default)
  
   Output(s):
 - TAGGED: array of tagged object's Ids   

 *}
 
<br />
     
<form action="{$REQUEST->getUrl()}" method="post">
 <table class="tableList">
 <tfoot>
  <tr valign=bottom>
   <td align="right">
        <input type="submit" 
               name="update" 
               value="{messagei18n key="|views.common.update"}" /> {* modifier *}
        <input type="submit" 
               name="create" 
               value="{messagei18n key="|views.common.create"}" /> {* créer *}
        <input type="submit" 
               name="delete" 
               value="{messagei18n key="|views.common.remove"}" /> {* supprimer *}
        <input type="submit" 
               name="quit" 
               value="{messagei18n key="|views.common.quit"}" /> {* quitter *}
   </td>
  </tr>
 </tfoot>
 <tbody>
  <tr>
   <td colspan=2>

    <table border="1"
           cellspacing="3"
           cellpadding="3"
           >
     
     {section name="item" loop=$OBJECT_LIST}
         
	  {if $smarty.section.item.first}
       <tr>
         <th>&nbsp;</th>
        {foreach names=titles item=title from=$DATA_LIST}
         <th>{$title.label}</th>
        {/foreach}
       </tr>
	  {/if}
      
      <tr class="">
      
       <td align=center>
        {assign var=name value=$DATA_LIST.id.var}
        <input type="{if $MULTITAG|default:"true"}checkbox{else}radio{/if}" 
               name="TAGGED[]" {* variable retournant le ou les Id des objets sélectionnés *}
               value="{$OBJECT_LIST[item]->$name}" 
               {checked id=$OBJECT_LIST[item]->$name list=$TAGGED}
               />
       </td>
       {foreach names=titles item=title from=$DATA_LIST}
        {assign var=name value=$title.var}
        <td>&nbsp;{$OBJECT_LIST[item]->$name}&nbsp;</td>
       {/foreach}
      </tr>
     {/section}
     
    </table>
    
    
   </td>
  </tr>
 </tbody>
 </table>
</form>

