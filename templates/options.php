<div class="wrap">
    <h2>JMStV - Einstellungen</h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <?php settings_fields('blockGroup'); ?>
        <h3>Deutsche User nach folgenden Kriterien bestimmen</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Nach Browsersprache filtern</th>
                <td>
                    <input type="hidden" name="jmstvBlockByUserAgent" value="0" />
                    <input type="checkbox" name="jmstvBlockByUserAgent" value="1" 
                        <?php if (get_option('jmstvBlockByUserAgent')) { ?>
                            checked="checked"
                        <?php } ?>
                    />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Nach IP-Adresse filtern<br />(Dynamisch mittels <a href="http://hostip.info" target="_blank">hostip.info</a>)</th>
                <td>
                    <input type="hidden" name="jmstvBlockByIp" value="0" />
                    <input type="checkbox" name="jmstvBlockByIp" value="1" 
                        <?php if (get_option('jmstvBlockByIp')) { ?>
                            checked="checked"
                        <?php } ?>
                    />
                </td>
            </tr>
        </table>
        <h3>Sendepause statt kompletter Sperrung</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Sendepause einrichten<br />(Serverzeit: <?php echo date('H:i:s'); ?>)</th>
                <td>
                    <input type="hidden" name="jmstvBlockByTime" value="0" />
                    <input type="checkbox" name="jmstvBlockByTime" value="1" 
                        <?php if (get_option('jmstvBlockByTime')) { ?>
                            checked="checked"
                        <?php } ?>
                    />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Start der Sendepause<br />(z.B. 06:00:00)</th>
                <td>
                    <input type="text" name="jmstvBlockStartTime" value="<?php echo get_option('jmstvBlockStartTime'); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Ende der Sendepause<br />(z.B. 22:00:00)</th>
                    <td>
                        <input type="text" name="jmstvBlockEndTime" value="<?php echo get_option('jmstvBlockEndTime'); ?>" />
                    </td>
                </tr>
        </table>
        <?php if (!get_option('jmstvBlockByUserAgent') && !get_option('jmstvBlockByIp')) { ?>
            <p style="color:#b00">
                Mit diesen Einstellungen wird die Protestseite <strong>nicht</strong> angezeigt. Erst wenn eine Auswahl 
                gemacht wurde, nach welchen Kriterien Deutsche User erkannt werden sollen, wird die Protestseite überhaupt,
                oder nur während der Sendepause angezeigt!
            </p>
        <?php } ?>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
    <p>
        Der RSS-Feed wird niemals gesperrt, außerdem ist im Moment der Googlebot whitelisted und bekommt deshalb auch immer
        die eigentliche Seite zu sehen. <a href="http://olbertz.de/blog/jmstv/" target="_blank">Wünsche zu Erweiterungen bitte hier stellen.</a>
    </p>
</div>