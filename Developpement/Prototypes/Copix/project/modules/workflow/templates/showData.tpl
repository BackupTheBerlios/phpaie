{* PhPaie project : showData.tpl (Smarty template file) *}
{* Will be splitted in specific view for each type of data

Input(s):
 - DATA_LIST
 - ENTITY
 - REQUEST
 
Output(s):
 - ENTITY

 *}
 
<br />
     
<form action="{$REQUEST->getUrl()}" method="post">
 <table class="tableList">
 <tfoot>
  <tr valign=bottom>
   <td align="right">
        <input type="submit" 
               name="accept" 
               value="{messagei18n key="|views.common.s0001"}" /> {* Accept *}
        <input type="submit" 
               name="cancel" 
               value="{messagei18n key="|views.common.s0003"}" /> {* Cancel *}
   </td>
  </tr>
 </tfoot>
 <tbody>
  <tr>
   <td>

    <table border="0"
           cellspacing="3"
           cellpadding="3"
           >
      
       {foreach names=titles item=title from=$DATA_LIST}
        <tr class="">
          <th align="left">{$title.label} :</th>
          {assign var=name value=$title.var}
          <td align="left">
           <input type="{$title.type}" 
                  name="ENTITY[{$title.var}]" 
                  value="{$ENTITY->$name}"
                  {if $title.mutabled == 'no'}disabled="disabled"{/if}
                  />
            {if $title.mutabled == 'no'}
             <input type="hidden" 
                    name="ENTITY[{$title.var}]" 
                    value="{$ENTITY->$name}"
                    />
            {/if}
          </td>
         </tr>
       {/foreach}
     
    </table>
    
    
   </td>
  </tr>
 </tbody>
 </table>
</form>

