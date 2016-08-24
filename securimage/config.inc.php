<?php

/**
  Securimage sample config file (rename to config.inc.php to activate)

  Place your custom configuration in this file to make settings global so they
  are applied to the captcha image, audio playback, and validation.

  Using this file is optional but makes settings managing settings easier,
  especially when upgrading to a new version.

  When a new Securimage object is created, if config.inc.php is found in the
  Securimage directory, these settings will be applied *before* any settings
  passed to the constructor (so options passed in will override these).

  This file is especially useful if you use a custom database or session
  configuration and is easier than modifying securimage.php directly.
  Any class property from securimage.php can be used here.
*/

return array(
    // /**** CAPTCHA Appearance Options ****/

    'image_width'      => 153,       // width of captcha image in pixels
    'image_height'     => 59,        // height of captcha image in pixels
    // 'code_length'      => 6,         // # of characters for captcha code
    // 'image_bg_color'   => '#ffffff', // hex color for image background
    'text_color'       => '#FA7C20', // hex color for captcha text
    // 'line_color'       => '#707070', // hex color for lines over text
    'num_lines'        => rand(4,6),         // # of lines to draw over text

    // 'use_wordlist'     => false,             // true to use word list
);
