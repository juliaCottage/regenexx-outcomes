<?php

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/juliaCottage/regenexx-outcomes',
	__FILE__,
	'regenexx-outcomes'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('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');