<?php

/*
Plugin Name: wp-JMStV
Plugin URI: http://olbertz.de/blog/jmstv
Description: Zeit- und IP-Sperre im Sinne des Jugendmedienschutzstaatsvertrag (JMStV)
Version: 0.8
Author: Dirk Olbertz
Author URI: http://olbertz.de
License: GPL2
*/

include('includes/DeJmstvPlugIn.php');

$deJmstvPlugIn = new DeJmstvPlugIn();

add_action('wp', array($deJmstvPlugIn, 'checkConstraints'));

if (is_admin()) {
    add_option('jmstvBlockByIp', 0);
    add_option('jmstvBlockByUserAgent', 0);
    add_option('jmstvBlockByTime', 0);
    add_option('jmstvBlockStartTime', '06:00:00');
    add_option('jmstvBlockEndTime', '22:00:00');
    add_option('jmstvShowPage', 0);
    
    add_action('admin_menu', array($deJmstvPlugIn, 'setupSettingsMenu'));
    add_action('admin_init', array($deJmstvPlugIn, 'registerSettings'));    
}
