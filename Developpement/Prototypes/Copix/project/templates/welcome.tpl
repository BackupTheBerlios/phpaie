{* Smarty template file : project/templates/welcome.tpl 
   Loaded with page Main.tpl
   Input:
   - $ENTRY_POINT
   - $ACTION_PARAM
   - $MODULE_PARAM
*}


{tooltipinit}
  <h4 {tooltip} title="{messagei18n key="views.welcome.s0101"}"> {messagei18n key="views.welcome.s0101"} </h4> {* Bienvenue ! *}
  <ul>
    <li><a href="{$ENTRY_POINT}?{$ACTION_PARAM}=information&{$MODULE_PARAM}=welcome">
       {messagei18n key="views.welcome.s0102"}</a> {* Pour en savoir plus. *}
       <br /></li>

    <li><a href="{$ENTRY_POINT}?{$ACTION_PARAM}=workspace&{$MODULE_PARAM}=workflow">
       {messagei18n key="views.welcome.s0103"}</a> {* Pour commencer à travailler. *}
       <br /></li>

    <br /><br /><br />
    
    <p class="registration">{messagei18n key="views.welcome.s0104"}</p>
    <li><a href="{$ENTRY_POINT}?{$ACTION_PARAM}=registration&{$MODULE_PARAM}=welcome">
        {messagei18n key="views.welcome.s0105"}</a>{* Pour s'inscrire. *}
       <br /></li>

  </ul>
