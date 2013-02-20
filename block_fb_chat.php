<?php

class block_fb_chat extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_fb_chat');
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->footer = '';

        if (empty($this->instance)) {
            $this->content->text   = '';
            return $this->content;
        }

        $advancedsearch = get_string('advancedsearch', 'block_fb_chat');

        $strsearch  = get_string('search');
        $strgo      = get_string('go');

        $this->content->text  = '<div id="fb-root"></div>';
        $this->content->text .= '<script>(function(d, s, id) {';
        $this->content->text .= 'var js, fjs = d.getElementsByTagName(s)[0];';
        $this->content->text .= 'if (d.getElementById(id)) return;';
        $this->content->text .= 'js = d.createElement(s); js.id = id;';
        $this->content->text .= 'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";';
        $this->content->text .= 'fjs.parentNode.insertBefore(js, fjs);';
        $this->content->text .= '}(document, "script", "facebook-jssdk"));</script>';
        $this->content->text .= '<div class="fb-comments" data-href="' . $this->curPageURL() . '" data-width="275" data-num-posts="10"></div>';

        echo $OUTPUT->notification($this->curPageURL());

        return $this->content;
    }
    function curPageURL() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
    function applicable_formats() {
        return array('site' => true, 'course' => true);
    }
}


