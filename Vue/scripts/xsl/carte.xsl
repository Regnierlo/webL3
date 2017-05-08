<!--convertit un fichier xml composé d’éléments elt en une carte heuristique, l’affichage est pas génial mais bon -->

<!--<?xml version="1.0" encoding="ISO-8859-1"?>-->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <div id="contenu-carte">
            <xsl:apply-templates select="element"/>
        </div>
    </xsl:template>

    <xsl:template match="element">
        <div id="{@id}" class="element-carte">
            <xsl:value-of select="@valeur"/>
            <xsl:apply-templates select="element"/>
        </div>
    </xsl:template>

</xsl:stylesheet>