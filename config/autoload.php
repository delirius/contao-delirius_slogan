<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Contao-delirius_slogan
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'fe_random_slogan' => 'system/modules/contao-delirius_slogan/fe_random_slogan.php',
	'fe_list_slogan'   => 'system/modules/contao-delirius_slogan/fe_list_slogan.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'slogan_list'             => 'system/modules/contao-delirius_slogan/templates',
	'slogan_list_tableless'   => 'system/modules/contao-delirius_slogan/templates',
	'slogan_random'           => 'system/modules/contao-delirius_slogan/templates',
	'slogan_random_tableless' => 'system/modules/contao-delirius_slogan/templates',
));
