<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Transfom a Pear::MDB schema 
     in a schema for Copix DAO
     Here the point is to transform elements in attributes
  -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
                
  <xsl:import href="copy.xsl" />

  <xsl:output method="xml"
              version="1.0"
              omit-xml-declaration="no"
              encoding="ISO-8859-1"
              indent="no"
              />

<!-- Match elements that are parents -->
<xsl:template match="field[*]">
  <xsl:choose>
    <!-- Only convert children if this element has no attributes -->
    <!-- of its own -->
    <xsl:when test="not(@*)">
      <xsl:copy>
        <!-- Convert children to attributes if the child has -->
        <!-- no children or attributes and has a -->
        <!-- unique name amoung its siblings -->
        <xsl:for-each select="*">
          <xsl:choose>
            <xsl:when test="not(*) and not(@*) and
                            not(preceding-sibling::*[name() =
                                                     name(current())]) 
                            and 
                            not(following-sibling::*[name() = 
                                                     name(current())])">
              <xsl:attribute name="{local-name(.)}">
                <xsl:value-of select="."/>
              </xsl:attribute>  
            </xsl:when>
            <xsl:otherwise>
              <xsl:apply-templates select="."/>
            </xsl:otherwise>
          </xsl:choose>
        </xsl:for-each>
      </xsl:copy>
    </xsl:when>
    <xsl:otherwise>
      <xsl:copy>
        <xsl:apply-templates/>
      </xsl:copy>
    </xsl:otherwise>
  </xsl:choose>
</xsl:template>

</xsl:stylesheet>
