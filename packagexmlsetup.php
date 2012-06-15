<?php
/**
 * Extra package.xml settings such as dependencies.
 * More information: http://pear.php.net/manual/en/pyrus.commands.make.php#pyrus.commands.make.packagexmlsetup
 */
$package->channel = $compatible->channel 
    = 'pear.diggin.musicrider.com';
$package->rawlead = $compatible->rawlead
    = array(
    'name' => 'sasezaki',
    'user' => 'sasezaki',
    'email' => 'sasezaki@gmail.com',
    'active' => 'yes'
);
$package->license = $compatible->license
    = 'New BSD License';
$package->dependencies['required']->php = $compatible->dependencies['required']->php
    = '5.3.3';


