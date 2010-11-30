<?php

$realPath = dirname(realpath(__FILE__));
$folder = substr($realPath, strpos($realPath, '/plugins/') + strlen('plugins/'));
$baseUrl = plugins_url() . $folder;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="de-DE">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php bloginfo('name'); ?> <?php wp_title(); ?> - JMStV Edition</title>
</head>
<body>
<img src="<?php echo $baseUrl; ?>/kindernet.jpg" />
<p>
    Dies ist eine Protestseite gegen das <a href="http://www.netzpolitik.org/?s=jmstv">JMStV</a>.
</p>
<p>
    <?php if ($this->blockedByTime) { ?>
        Du rufst diese Seite während der Sendepause (<?php echo $this->blockStartTime; ?> - <?php echo $this->blockEndTime; ?>) auf. Es ist jetzt <?php echo date('H:i:s'); ?> Uhr!
    <?php } ?>
    <?php if ($this->blockedByUserAgent) { ?>
        Dein Zugriff wurde wegen Deiner Browsersprache gesperrt.
    <?php } ?>
    <?php if ($this->blockedByIp) { ?>
        Dein Zugriff wurde wegen Deiner IP gesperrt.
    <?php } ?>
</p>
<body>
</html>