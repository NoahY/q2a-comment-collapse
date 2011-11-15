<?php

/*
        Plugin Name: Collapsed Comments
        Plugin URI: 
        Plugin Description: Truncates comment list, opens with jQuery
        Plugin Version: 1.0b1
        Plugin Date: 2011-11-15
        Plugin Author: NoahY
        Plugin Author URI: 
        Plugin License: GPLv2
        Plugin Minimum Question2Answer Version: 1.3
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
			header('Location: ../../');
			exit;
	}
	
	qa_register_plugin_layer('qa-collapse-layer.php', 'Collapse Layer');	
	
	qa_register_plugin_module('module', 'qa-collapse-admin.php', 'qa_collapse_admin', 'Comment Collapse Admin');

/*
	Omit PHP closing tag to help avoid accidental output
*/
