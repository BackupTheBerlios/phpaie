<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Transfom a Pear::MDB schema
     in a schema for Copix Dao. We keep the elements and
     the attributes with their name, but we have to:
       - remove the "declaration" level, //OK
       - remove the "initialisation" element and all its descendants, 
       - same with the "sequence" element, 
       - same with the "index" element, 
         
  -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                version="1.0">
  
  <xsl:import href="copy.xsl" />

  <xsl:output method="xml" 
              version="1.0" 
              omit-xml-declaration="no" 
              encoding="ISO-8859-1" 
              indent="yes" />

  <xsl:template match="declaration">
      <xsl:apply-templates select="@*|node()"/>
  </xsl:template>

  <xsl:template match="initialization">
  </xsl:template>

  <xsl:template match="sequence">
  </xsl:template>

  <xsl:template match="index">
  </xsl:template>

  <xsl:template match="database/@*[  name() = 'create'
                                  or name() = 'overwrite'
                                  ]">
  </xsl:template>

  <xsl:template match="column/@*[  name() = 'notnull'
                                or name() = 'default'
                                ]">
  </xsl:template>

</xsl:stylesheet>
