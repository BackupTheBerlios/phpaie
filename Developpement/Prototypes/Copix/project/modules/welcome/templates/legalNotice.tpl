{* Smarty template file : welcome/templates/legalnotice.tpl *}

  <h3>{messagei18n key="views.legal.notice.s0161"}</h3><br /> {* Mentions légales *}
  
  <br /><br />
  {messagei18n key="views.legal.notice.s0162"}<br /> {* Pour toute information légale, contacter : *}
  <address class="webmaster">
    <a class="welcomeLink" href="mailto:{messagei18n key="|website.legal.data.webmaster"}?subject={messagei18n key="|website.legal.data.trade_name"}{messagei18n key="views.legal.notice.s0164"}">
      {messagei18n key="views.legal.notice.s0163"} {* Contactez-nous *}
    </a><br />
      {messagei18n key="|website.legal.data.firm_name"} {messagei18n key="|website.legal.data.firm_status"}
      <br />
      {messagei18n key="|website.legal.data.office_town"} - {messagei18n key="|website.legal.data.office_country"}
      <br />
  </address>
  <br />

  <br />
  <a href="javascript:window.close()">{messagei18n key="|views.common.s0002"}</a> {* Quitter *}   
