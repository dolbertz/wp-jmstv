<div class="wrap">
    <h2>JMStV - Einstellungen</h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <?php settings_fields('blockGroup'); ?>
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
                <th scope="row">Nach IP-Adresse filtern</th>
                <td>
                    <input type="hidden" name="jmstvBlockByIp" value="0" />
                    <input type="checkbox" name="jmstvBlockByIp" value="1" 
                        <?php if (get_option('jmstvBlockByIp')) { ?>
                            checked="checked"
                        <?php } ?>
                    />
                </td>
            </tr>
            <tr valign="top">
                <td></td><td></td>
            </tr>
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
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>