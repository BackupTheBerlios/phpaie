<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Transfom a Pear::MDB schema 
     in a schema for Copix DAO
     Here the point is to deal with MDB data types,
       - change all letters to lowercase for value in "type" element or attribute
       - change "text", "CHAR" and "VARCHAR" value in "string" for "type" element or attribute
       - change "integer" value in "int" for "type" element or attribute
       - change "field/size" in "field/maxlength"
       - change "field/description" in "field/caption"
       - change "table" in "fields"
       - change "database" in "daodefinition"
       - change boolean value in yes/no
  -->
<!DOCTYPE stylesheet [
  <!ENTITY UPPERCASE "ABCDEFGHIJKLMNOPQRSTUVWXYZ">
  <!ENTITY LOWERCASE "abcdefghijklmnopqrstuvwxyz">
  <!ENTITY UPPER_TO_LOWER " '&UPPERCASE;' , '&LOWERCASE;' ">
  <!ENTITY LOWER_TO_UPPER " '&LOWERCASE;' , '&UPPERCASE;' ">
]>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
                version="1.0">
  
  <xsl:import href="e2a-2.xsl" />

  <xsl:output method="xml" 
              version="1.0" 
              omit-xml-declaration="yes" 
              encoding="ISO-8859-1" 
              indent="no" />

  <!-- change "table" name of elements in "fields" -->
  <xsl:template match="table">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="fields"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:apply-templates select="node() | @*" />
    </xsl:element>
  </xsl:template>

  <!-- change "database" name of elements in "daodefinition" -->
  <xsl:template match="database">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="daodefinition"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:apply-templates select="node() | @*" />
    </xsl:element>
  </xsl:template>

  <!-- change "primarykey" name of elements and attributs in "PK" -->
  <xsl:template match="primarykey">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="PK"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:apply-templates select="node() | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="@primarykey">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="PK">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:value-of select="normalize-space(.)" />
    </xsl:element>  
  </xsl:template>

  <!-- change "description" name of elements and attributs in "caption" -->
  <xsl:template match="field/description">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="caption"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:apply-templates select="node() | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="field/@description">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="caption">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:value-of select="normalize-space(.)" />
    </xsl:element>  
  </xsl:template>

  <!-- change "length" name of elements and attributs in "maxlength" -->
  <xsl:template match="field/length">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="maxlength"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:apply-templates select="node() | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="field/@length">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="maxlength">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:value-of select="normalize-space(.)" />
    </xsl:element>  
  </xsl:template>

  <!-- change "integer" value in "int"  -->
  <xsl:template match="type[  normalize-space(text())='integer'
                           ]">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="type"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>
      <xsl:text>int</xsl:text>      
      <xsl:apply-templates select="* | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="@type[  normalize-space(.)='integer'
                            ]">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="type">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:text>int</xsl:text>      
    </xsl:element>  
  </xsl:template>

  <!-- change "VARCHAR" value in "string"  -->
  <xsl:template match="type[  normalize-space(text())='VARCHAR'
                           or normalize-space(text())='CHAR'
                           or normalize-space(text())='text'
                           ]">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="type"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>
      <xsl:text>string</xsl:text>      
      <xsl:apply-templates select="* | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="@type[  normalize-space(.)='VARCHAR'
                            or normalize-space(.)='CHAR'
                            or normalize-space(.)='text'
                            ]">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="type">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:text>string</xsl:text>      
    </xsl:element>  
  </xsl:template>

  <!-- change letters to lowercase in value of "type" element  -->
  <xsl:template match="type">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="type"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>
      <xsl:value-of
        select="translate( normalize-space(text())
                         , &UPPER_TO_LOWER;
                         )"
        />
      <xsl:apply-templates select="* | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="@type">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="type">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:value-of
        select="translate( normalize-space(.)
                         , &UPPER_TO_LOWER;
                         )"
        />
    </xsl:element>  
  </xsl:template>

  <!-- change boolean values in yes/no -->
  <xsl:template match="create|notnull|unique|overwrite|unsigned|required">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="{name()}"> 
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>
      <xsl:choose>
        <xsl:when test="  normalize-space(text()) = 'yes'
                       or normalize-space(text()) = 'true'
                       or normalize-space(text()) = '1'
                       ">
          <xsl:text>yes</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>no</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
      <xsl:apply-templates select="* | @*" />
    </xsl:element>
  </xsl:template>

  <xsl:template match="@create|@notnull|@unique|@overwrite|@unsigned|@required">
    <xsl:variable name="namespace">
      <xsl:call-template name="find_namespace" />
    </xsl:variable>
    <xsl:element name="{name()}">
      <xsl:call-template name="set_namespace">
        <xsl:with-param name="namespace">
          <xsl:value-of select="$namespace" />
        </xsl:with-param>
      </xsl:call-template>      
      <xsl:choose>
        <xsl:when test="  normalize-space(.) = 'yes'
                       or normalize-space(.) = 'true'
                       or normalize-space(.) = '1'
                       ">
          <xsl:text>yes</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>no</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:element>  
  </xsl:template>

</xsl:stylesheet>
