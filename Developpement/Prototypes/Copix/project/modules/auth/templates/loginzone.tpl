{* Smarty : auth/templates/loginzone.tpl *}
{* Input(s):
 - ENTRY_POINT
 - ACTION_PARAM
 - MODULE_PARAM
 - URL_RETURN
 - USER

 *}

<div id="auth_login_zone">
{if $USER eq null}
  {if $FAILED}
    <p class="auth_error">{messagei18n key="views.login.s0004"}{* Identification incorrecte *}</p>
  {/if}
  <form action="{$ENTRY_POINT}?{$MODULE_PARAM}=auth&amp;{$ACTION_PARAM}=in" method="post">
    <fieldset>
      <legend>{messagei18n key="views.login.s0001"}{* Identifiez-vous *}</legend>
      <input type="hidden" name="auth_url_return" value="{$URL_RETURN}" />

      <p>
        <label for="auth_login">{messagei18n key="views.login.s0002"}{* Utilisateur  : *}</label>
        <input type="text" name="auth_login" id="auth_login" size="9" />
      </p>
      <p>
        <label for="auth_password">{messagei18n key="views.login.s0003"}{* Mot de passe : *}</label>
        <input type="password" name="auth_password" id="auth_password" size="9" />
      </p>
      <input type="submit" name="auth_connect" value={messagei18n key="views.login.s0006"}{* Se connecter *} />
    </fieldset>
  </form>
{else}
	<p>{$USER->login} (<a href="{$ENTRY_POINT}?{$MODULE_PARAM}=auth&amp;{$ACTION_PARAM}=out&amp;auth_url_return={$URL_RETURN|escape:'url'}">{messagei18n key="views.login.s0005}{* Déconnexion *}</a>)</p>
{/if}
</div>
