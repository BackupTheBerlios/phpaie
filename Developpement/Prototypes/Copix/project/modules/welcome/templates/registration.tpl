{* Smarty template file : welcome/templates/registration.tpl *}
  
  <br /><br /><br /><br /><br />
  {messagei18n key="views.registration.s0151"}<br /> {* Il n'est pas encore possible de s'inscrire en ligne. *}
  {messagei18n key="views.registration.s0152"}<br /> {* Veuillez prendre contact avec l'administrateur du site. *}
  <address class="webmaster">
    <a class="welcomeLink" href="mailto:{messagei18n key="|website.legal.data.webmaster"}?subject={messagei18n key="|website.legal.data.trade_name"}{messagei18n key="views.registration.s0153"}">
      {messagei18n key="views.registration.s0154"} {* Contactez-nous *}
    </a><br />
      {messagei18n key="|website.legal.data.firm_name"} {messagei18n key="|website.legal.data.firm_status"}
      <br />
      {messagei18n key="|website.legal.data.office_town"} - {messagei18n key="|website.legal.data.office_country"}
      <br />
  </address>
  <br />

  {messagei18n key="views.registration.s0155"} {* Cliquer ici pour revenir à la page d'accueil : *}
  <a href="./">{messagei18n key="|views.common.s0005"}</a> {* Retour *}
  