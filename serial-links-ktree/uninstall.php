<?php
/* This file is part of the SERIAL LINKS Wordpress Plugin Version 1.0
*********************************************************************
Copyright 2009  Ramana Raju.S KTree (email : info@ktree.com)

Check that we are using 2.7+ before running
deleting options */
if ( !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}
delete_option('selp_plugin_settings');
?>