<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Transfom a schema with elemnt (for Combine)
     in a schema with elements (for Pear::MDB)
     Beyond the creation of elements from attributs,
       - remove level "declaration" under "table" level,
       - remove "initialization" element,
       - remove "index" element,
       - remove "database/create" element,
       - remove "database/overwrite" element,
       - ,
       - ,
  -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                version="1.0">
  
  <xsl:import href="e2a-1.xsl" />

  <xsl:output method="xml" 
              version="1.0" 
              omit-xml-declaration="no" 
              encoding="ISO-8859-1" 
              indent="no" 
              />

  <!-- remove "declaration" level between table and field levels  -->
  <xsl:template match="declaration">
      <xsl:apply-templates select="@*|node()"/>
  </xsl:template>

  <!-- remove "initialization" element  -->
  <xsl:template match="initialization">
  </xsl:template>

  <!-- remove "index" element  -->
  <xsl:template match="index">
  </xsl:template>

  <!-- remove "create" element  -->
  <xsl:template match="create">
  </xsl:template>

  <!-- remove "overwrite" element  -->
  <xsl:template match="overwrite">
  </xsl:template>
    

</xsl:stylesheet>
