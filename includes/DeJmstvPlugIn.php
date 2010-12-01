<?php
class DeJmstvPlugIn
{
    protected $blockedByIp;
    protected $blockedByUserAgent;
    protected $blockedByTime;
    protected $blockedStartTime;
    protected $blockedEndTime;
    
    public function __construct()
    {
        $this->blockedByIp = false;
        $this->blockedByUserAgent = false;
        $this->blockedByTime = false;
        $this->showPage = get_option('jmstvShowPage');
        
    }
    
    public function checkConstraints()
    {
        if ($this->isWhitelisted()) {
            return;
        }
        
        if ($this->checkBlockByUserAgent() || $this->checkBlockByIp()) {
            if ($this->checkBlockByTime()) {
                include(dirname(realpath(__FILE__)) . '/../templates/blocked.php');
                exit;
            }
        }
    }
    
    public function setupSettingsMenu()
    {        
        add_options_page('JMStV Options', 'JMStV', 'manage_options', 'jmstv-settings', array($this, 'pluginOptions'));
    }

    public function pluginOptions()
    {

        if (!current_user_can('manage_options'))  {
            wp_die( __('You do not have sufficient permissions to access this page.') );
        }

        include(dirname(realpath(__FILE__)) . '/../templates/options.php');
    }
    
    public function registerSettings()
    {
        register_setting('blockGroup', 'jmstvBlockByUserAgent', 'intval');
        register_setting('blockGroup', 'jmstvBlockByIp', 'intval');
        
        register_setting('blockGroup', 'jmstvBlockByTime', 'intval');
        register_setting('blockGroup', 'jmstvBlockStartTime', array($this, 'sanitizeTime'));
        register_setting('blockGroup', 'jmstvBlockEndTime', array($this, 'sanitizeTime'));
        
        register_setting('blockGroup', 'jmstvShowPage', 'intval');
        
    }
    
    public function sanitizeTime($value)
    {
        $today = date('Y-m-d', current_time('timestamp'));
        
        return date('H:i:s', strtotime($today . ' ' . $value));
    }
    
    protected function isWhitelisted()
    {
        if (is_admin()) {
	        // never block admin pages
	        return true;
	    }

        if (is_feed()) {
            // always deliver the feed
            return true;
        }
        
        if ($this->showPage && is_page($this->showPage)) {
            // don't block the chosen protest page
            return true;
        }
        
        $userAgentWhitelist = array(
            'googlebot'
        );
        $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        
        foreach ($userAgentWhitelist as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                return true;
            }
        }

        return false;
    }
    
    protected function checkBlockByTime()
    {
        if (!get_option('jmstvBlockByTime')) {
            // Always block for german users
            return true;
        }
        
        $this->blockStartTime = get_option('jmstvBlockStartTime');
        $this->blockEndTime = get_option('jmstvBlockEndTime');
        $now = date('H:i:s');
        if ($this->blockStartTime == $this->blockEndTime) {
            $this->blockedByTime = true;
            
            return true;
        } else if ($this->blockStartTime > $this->blockEndTime) {
            // eg. 22:00:00 - 06:00:00
            if (($now >= $this->blockStartTime && $now <= '23:59:59') 
               || ($now >= '00:00:00' && $now <= $this->blockEndTime) 
            ) {
                $this->blockedByTime = true;
                
                return true;
            }
        } else {
            // eg. 06:00:00 - 22:00:00
            if ($now >= $this->blockStartTime && $now <= $this->blockEndTime) {
                $this->blockedByTime = true;
                
                return true;
            }
        }
        
        return false;
    }
    
    protected function checkBlockByUserAgent()
    {
        if (!get_option('jmstvBlockByUserAgent')) {
            return false;
        }
        $acceptLanguage = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
        $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        
        if (stripos($acceptLanguage, 'de-de') !== false || stripos($userAgent, 'de-de') !== false) {
            $this->blockedByUserAgent = true;
            
            return true;
        }
        
        return false;
    }
    
    protected function checkBlockByIp()
    {
        if (!get_option('jmstvBlockByIp')) {
            return false;
        }
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = $this->makeGetRequest('http://api.hostip.info/get_html.php?ip=' . $ip);
        
        if (stripos($response, 'germany') !== false) {
            $this->blockedByIp = true;
            
            return true;
        }
        
        return false;
    }
    
    protected function makeGetRequest($url)
    {
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
        } else {
            $response = file_get_contents($url);
        }
        
        return $response;
    }
}
