<?php

if (!defined('TL_ROOT'))
    die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005
 * @author     Leo Feyer <leo@typolight.org>
 * @package    News
 * @license    LGPL
 * @filesource
 */
/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['slogan_random'] = '{title_legend},name,type;{slogan_legend},delirius_slogan_number,delirius_slogan_category,delirius_slogan_site;{design_legend},delirius_slogan_template,delirius_slogan_css;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['slogan_liste'] = '{title_legend},name,type;{slogan_legend},delirius_slogan_category;{design_legend},delirius_slogan_template,delirius_slogan_css;';




/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_category'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_category'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'foreignKey' => 'tl_slogan_category.title',
    'eval' => array('multiple' => true, 'mandatory' => false)
);


$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_number'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_number'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 10)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_site'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_site'],
    'exclude' => true,
    'inputType' => 'pageTree',
    'eval' => array('fieldType' => 'radio', 'tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_css'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_css'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => array('slogan-default', 'slogan-tableless-default'),
    'default' => '1',
    'eval' => array('mandatory' => false, 'includeBlankOption' => true)
);
$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_template'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_template'],
    'default' => 'slogan_standard',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array('tl_module_slogan', 'getTemplates'),
);

class tl_module_slogan extends Backend {

    /**
     * Return all event templates as array
     * @param object
     * @return array
     */
    public function getTemplates(DataContainer $dc) {
        return $this->getTemplateGroup('slogan_', $dc->activeRecord->pid);
    }

}

?>