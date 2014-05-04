<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Delirius_slogan
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'fe_list_slogan' => 'system/modules/delirius_slogan/modules/fe_list_slogan.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'slogan_list_tableless' => 'system/modules/delirius_slogan/templates/modules',
));
