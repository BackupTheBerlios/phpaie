<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Transfom a generic Pear::MDB schema 
     in a schema for Copix DAO
     Here: templates find_namespace & set_namespace
  -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                version="1.0">

  <xsl:import href="copy.xsl" />

  <xsl:output method="xml" 
              version="1.0" 
              omit-xml-declaration="yes" 
              encoding="ISO-8859-1" 
              indent="yes" />

  <xsl:param name="with-namespace">yes</xsl:param >

  <xsl:template name="find_namespace">
      <xsl:choose>
        <!-- use attribut's namespace if it exists -->
        <xsl:when test="namespace-uri()">
          <xsl:value-of select="namespace-uri()" />
        </xsl:when>
        <!-- otherwise use parent's namespace -->
        <xsl:otherwise>
          <xsl:value-of select="namespace-uri()" />
        </xsl:otherwise>
      </xsl:choose>
  </xsl:template>

  <xsl:template name="set_namespace">
    <xsl:param name="namespace" />
    <xsl:if test="$with-namespace = 'yes'">
      <xsl:attribute name="namespace">
        <xsl:value-of select="$namespace" />
      </xsl:attribute>
    </xsl:if>
  </xsl:template>

</xsl:stylesheet>
