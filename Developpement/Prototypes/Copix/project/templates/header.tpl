{* Smarty template file : project/templates/header.tpl 
   Input:
   - $LOGOS_FILE_PATH
   - $PAGE_TITLE
 *}

    {* Gestion du haut de page, avec la raison social, le logo et un éventuel titre.. *}
<!-- HEADER START ------------------------------------------------------ -->
    
      <img src="{$LOGOS_FILE_PATH|default:"logos/"}{messagei18n key="website.files.logo"}"
         alt="{messagei18n key="website.legal.data.firm_name"}" 
         border="" 
         style="height: 3cm; float: right; vertical-align: top" 
         />
      <h2 style="height: 2.5cm">      
       {messagei18n key="website.legal.data.trade_name"}
      </h2>
      <hr />
      
      {if $PAGE_TITLE != ""}
      <div id="pageTitle">
          {$PAGE_TITLE}
      </div>
      <hr />
      {/if}
        
<!-- HEADER END ------------------------------------------------------ -->
    {* Fin du haut de pages *}  