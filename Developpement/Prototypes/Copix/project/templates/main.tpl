{* Smarty template file : project/templates/welcome.tpl 
   Input:
   - $ENTRY_POINT
   - $ACTION_PARAM
   - $MODULE_PARAM
   - $LOGIN_FORM
   - $TITLE_BAR
   - $SCRIPTS
   - $SCRIPTS_FILE_PATH
   - $MENU
   - $MAIN
   - $LOGOS_FILE_PATH
   - $PAGE_TITLE
   
*}

<html>
  <head>

    <title>
      {$TITLE_BAR|default:"Web Payroll"}
    </title>

    {* scripts directement définis dans la page *}
    {if $SCRIPTS != "" }
    <script type="text/javascript">
      <!-- // --><![CDATA[ // ><!--
      {$SCRIPTS}
      // --><!]]>
    </script>    
    {/if}
    
    {* script pour ouvrir une fenêtre flotante, en particulier
              pour la page des informations légales (cf. footer.tpl)
              *}  
    <script type="text/javascript" src="{$SCRIPTS_FILE_PATH}js/windows.funct.js"></script>

  </head> 

  <body bgcolor="peachpuff">

    <div id="all_site">
  
      <div id="header">
        {include file="header.tpl"}
      </div>
      {$LOGIN_FORM}
      <div id="menu">{$MENU}</div>
      <div id="content">{$MAIN}</div>

      <div id="footer">
        {include file="footer.tpl"}
      </div>
    
    </div>

  </body>  

</html>
