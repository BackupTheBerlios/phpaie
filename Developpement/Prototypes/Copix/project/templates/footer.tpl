{* Smarty template file : project/templates/footer.tpl  
   Loaded with page Main.tpl
   Input:
   - $ENTRY_POINT
   - $ACTION_PARAM
   - $MODULE_PARAM
//   - $FOOTER_LEGALE_NOTICE
//   - $FOOTER_COPYRIGHT  website.legal.data.copyright
   - $LOGOS_FILE_PATH
*}
<!-- FOOTER START ------------------------------------------------------ -->
    <br /><br /><br />
    <hr />

    <table border="0" 
           cellspacing="0"
           width="100%"
           >
      <td  style="text-align: center; width: 90" >
        <a href="http://www.php.net">
        <img src="{$LOGOS_FILE_PATH|default:"logos/"}powered_php.gif"
             border="0" 
             alt="Made with PHP"
             /></a>
      </td>
      <td  style="text-align: center; width: 90" >
        <a href="http://pear.php.net">
        <img src="{$LOGOS_FILE_PATH|default:"logos/"}pear-power.png"
             border="0" 
             alt="Powered by Pear"
             /></a>
      </td>
      <td  style="text-align: center; width: 90" >
        <a href="http://copix.aston.fr">
        <img src="{$LOGOS_FILE_PATH|default:"logos/"}logo_copix2.gif"
             border="1" 
             width="90"
             alt="Powered by Copix"
             /></a>
      </td>
      <td  style="text-align: center; width: 90" >
        <a href="http://smarty.php.net">
        <img src="{$LOGOS_FILE_PATH|default:"logos/"}smarty_icon.gif"
             border="0" 
             alt="Powered by Smarty"
             /></a>
      </td>
      <td  style="text-align: center; width: 90" >
        <a href="http://www.phpaie.net">
        <img src="{$LOGOS_FILE_PATH|default:"logos/"}phpaie4.png"
             border="0" 
             alt="Powered by Phpaie"
             /></a>
      </td>
      <!-- and also Phprame(LGPL) et Combine(LGPL) for some pieces of code -->

      <td style="text-align: center; vertical-align: middle">
        <a href="{$ENTRY_POINT}?{$ACTION_PARAM}=legalNotice&{$MODULE_PARAM}=welcome" onclick="javascript:openWindow(this.href); return false;"
           >
           {messagei18n key="views.common.s0007"} {* Informations légales *}
        </a><br />
        &copy;&nbsp;{messagei18n key="website.legal.data.copyright"}
      </td>

      <td 
          style="text-align: right
               ; vertical-align: middle
               ">
        <table border="1"
               style="text-align: center
                    ; vertical-align: middle
                    ; font-size: 150%
                    ; color:green
                    ; background:white
                    ">
          <td>
          {literal}
            <script type="text/javascript">  
            <!-- // --><![CDATA[ // ><!--
              document.write('&nbsp;JS&nbsp;') ;
            // --><!]]>
            </script>
          {/literal}
            <noscript style="color:red">&nbsp;no JS&nbsp;</noscript>
          </td>
        <table/>
      </td>
    </table>

<!-- FOOTER END ------------------------------------------------------ -->
