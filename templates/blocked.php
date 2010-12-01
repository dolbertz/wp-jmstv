<?php

$realPath = dirname(realpath(__FILE__));
$folder = substr($realPath, strpos($realPath, '/plugins/') + strlen('plugins/'));
$baseUrl = plugins_url() . $folder;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="de-DE">
<head>
<style>
body {font-size:75%; color:#222; background:#000; font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;}
h1,h2,h3,h4,h5,h6 { font-weight:normal; color:#111; }
.container {background: #fff;padding:40px 40px;margin:20px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?> - JMStV Edition</title>
</head>
<body>
    <div class="container">
        <img src="<?php echo $baseUrl; ?>/kindernet.jpg" />
        <p>
            Dies ist eine Protestseite gegen den Jugendmedienschutzstaatsvertrag (JMStV).
        </p>
        <p>
            <?php if ($this->blockedByTime) { ?>
                Du rufst diese Seite während der Sendepause (Serverzeit: <?php echo $this->blockStartTime; ?> - 
                <?php echo $this->blockEndTime; ?>) auf. Es ist jetzt <?php echo date('H:i:s'); ?> Uhr 
                (ebenfalls Uhrzeit auf dem Server)!
            <?php } ?>
            <?php if ($this->blockedByUserAgent) { ?>
                Dein Zugriff wurde wegen Deiner Browsersprache gesperrt.
            <?php } ?>
            <?php if ($this->blockedByIp) { ?>
                Dein Zugriff wurde wegen Deiner IP gesperrt.
            <?php } ?>
        </p>
        <h2>Warum ich protestiere</h2>
        <p>
            Zitat nach <a href="http://www.lawblog.de/index.php/archives/2010/12/01/warum-blogger-gelassen-bleiben-konnen/">Udo Vetter</a>:
            <blockquote>
                Was uns mit dem JMStV nach derzeitigem Stand droht, ist ein Regelwirrwarr und jede Menge Bürokratie. Das damit 
                geplante Label-System in Verbindung mit standardisierter und somit zentral lenkbarer Filtersoftware ist zweifellos 
                ein solides Fundament für eine spätere Zensurinfrastruktur, ebenso wie die schon in ein Gesetz gegossene 
                "Zugangserschwerung" in Form von Stoppschildern.
            </blockquote>
            <blockquote>
                Das gesamte Projekt blendet außerdem aus, dass das Internet ein globales Medium ist und der weitaus größte Rest 
                der Welt sicher keinen Bedarf sieht, ausgerechnet am deutschen Wesen zu genesen. Insofern ist der JMStV ein 
                praxisuntaugliches Monstrum.
            </blockquote>
        </p>
        <h2>Weiterführende Links</h2>
        <ul>
            <li><a href="http://www.netzpolitik.org/?s=jmstv">Übersicht bei Netzpolitik.org zum Thema JMStV</a></li>
            <li><a href="http://ak-zensur.de/mt/mt-search.cgi?search=jmstv&IncludeBlogs=14&limit=20">Übersicht beim AK Zensur zum Thema JMStV</a></li>
            <li><a href="http://yuccatree.de/2010/11/jugendmedienschutz-staatsvertrag-bundeslander-beschliesen-juristisches-chaos-fur-blogger/">JMStV: Bundesländer beschließen juristisches Minenfeld für Blogger</a> (yuccatree.de)</li>
            <li><a href="http://t3n.de/news/neuer-jmstv-286977/">Lesepflicht für alle: 17 Fragen zum neuen JMStV</a> (t3n.de)
        </ul>
        <p>
            Grafik mit freundlicher Genehmigung von <a href="http://twitter.com/marax_de">@marax_de</a>.
        </p>
        
    </div>
<body>
</html>