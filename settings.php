<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configcheckbox('block_fb_chat_allowcssclasses', get_string('allowadditionalcssclasses', 'block_fb_chat'),
                       get_string('configallowadditionalcssclasses', 'block_fb_chat'), 0));
}


