<?php

class block_fb_chat extends block_base {
    function init() {
        global $COURSE;
        $this->title = get_string('pluginname', 'block_fb_chat');
    }

    function get_content() {
        global $CFG, $OUTPUT, $COURSE;

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

        $url = $this->curPageURL();

        if ($url) {
            $this->content->text  = '<div id="fb-root"></div>';
            $this->content->text .= '<script>(function(d, s, id) {';
            $this->content->text .= 'var js, fjs = d.getElementsByTagName(s)[0];';
            $this->content->text .= 'if (d.getElementById(id)) return;';
            $this->content->text .= 'js = d.createElement(s); js.id = id;';
            $this->content->text .= 'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";';
            $this->content->text .= 'fjs.parentNode.insertBefore(js, fjs);';
            $this->content->text .= '}(document, "script", "facebook-jssdk"));</script>';
            $this->content->text .= '<div style="width:100%; background-color:#3b5998; height:40px; text-align:center; display:table;">';
            $this->content->text .= '<h1 style="display:table-cell; vertical-align:middle; font-family:\'lucida grande\',tahoma,verdana,arial,sans-serif; font-size:1.3em; font-weight:700; width:100%; color:#fff;">' . $COURSE->fullname . '</h1></div>';
            $this->content->text .= '<div class="fb-comments" data-href="' . $url . '" data-width="272" data-num-posts="10"></div>';
        } else {
            $this->content->text .= '<center><font color="red">(This plugin is inteded to be used inside of a course)</font></center>';
        }

//        echo $OUTPUT->notification($url);

        return $this->content;
    }

    function curPageURL() {
        global $COURSE;

        $pageURL = 'http';
        if (!empty($_SERVER["HTTPS"])) {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($COURSE->id != 1) {  // inside a course
            $pageURL .= $_SERVER["SERVER_NAME"] . '/course/view.php?id=' . $COURSE->id;
            return $pageURL;
        } else {  // outside of a course
/*            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }*/
           return FALSE;
        }
    }

    function applicable_formats() {
        return array('site' => true, 'course' => true);
    }
}


