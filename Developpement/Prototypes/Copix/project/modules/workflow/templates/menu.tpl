{* Smarty template file : workflow - menu.tpl *}

{assign var="vert_sep" value="&#124"} {* barre verticale de séparation *}
<!-- MENU START ------------------------------------------------------ -->
<table border="0"
       cellspacing="3"
       cellpadding="3"
       style="background: lightgrey"
       >
{section loop=$MENU_LIST name="item"}
{if not $smarty.section.item.first}
  <td>
    {$vert_sep}
  </td>
{/if}
  <td  style="background-color: white 
            ; border-style: groove
            ; border-color: blue 
            ; border-width: 1 
            "
            >
    <a href="{$MENU_LIST[item].action}">
      &nbsp;{$MENU_LIST[item].label}&nbsp;
    </a>
  </td>
{/section}
</table>
<!-- MENU END ------------------------------------------------------- -->

