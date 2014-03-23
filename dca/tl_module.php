<?php

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
$GLOBALS['TL_DCA']['tl_module']['palettes']['slogan_random'] = '{title_legend},name,type;{slogan_legend},delirius_slogan_category,delirius_slogan_number,delirius_slogan_site;{design_legend},sloganImageSize,delirius_slogan_template,delirius_slogan_css;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['slogan_liste'] = '{title_legend},name,type;{slogan_legend},delirius_slogan_category,delirius_slogan_number,delirius_slogan_order,delirius_slogan_fields;{design_legend},sloganImageSize,delirius_slogan_template,delirius_slogan_css;';




/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_category'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_category'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'foreignKey' => 'tl_slogan_category.title',
    'eval' => array('multiple' => true, 'mandatory' => false, 'tl_class' => 'w50'),
    'sql' => "text NULL"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_fields'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_fields'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'options_callback' => array('tl_module_slogan', 'getFields'),
    'eval' => array('multiple' => true, 'mandatory' => false),
    'sql' => "text NULL"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_number'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_number'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'maxlength' => 10, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_order'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_order'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => array('sorting' => $GLOBALS['TL_LANG']['tl_module']['order_sorting'], 'random' => $GLOBALS['TL_LANG']['tl_module']['order_random']),
    'eval' => array('mandatory' => false),
    'sql' => "text NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_site'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_site'],
    'exclude' => true,
    'inputType' => 'pageTree',
    'eval' => array('fieldType' => 'radio', 'tl_class' => 'clr'),
    'sql' => "text NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sloganImageSize'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['sloganImageSize'],
    'exclude' => true,
    'inputType' => 'imageSize',
    'options' => $GLOBALS['TL_CROP'],
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval' => array('rgxp' => 'digit', 'nospace' => true, 'helpwizard' => true, 'tl_class' => 'long'),
    'sql' => "varchar(64) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_css'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_css'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => array('slogan-tableless-default'),
    'default' => '1',
    'eval' => array('mandatory' => false, 'includeBlankOption' => true),
    'sql' => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['delirius_slogan_template'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['delirius_slogan_template'],
    'default' => 'slogan_list_tableless',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array('tl_module_slogan', 'getTemplates'),
    'sql' => "varchar(255) NOT NULL default ''"
);

class tl_module_slogan extends Backend
{

    /**
     * Return all event templates as array
     * @param object
     * @return array
     */
    public function getTemplates(DataContainer $dc)
    {
        return $this->getTemplateGroup('slogan_', $dc->activeRecord->pid);
    }

    public function getFields()
    {
        $this->loadLanguageFile('tl_slogan_data');

        $arrFields = array();
        $arrFields['b.title as categorytitle'] = $GLOBALS['TL_LANG']['tl_slogan_data']['categorytitle'][0];
        $arrFields['a.title'] = $GLOBALS['TL_LANG']['tl_slogan_data']['title'][0];
        $arrFields['a.author'] = $GLOBALS['TL_LANG']['tl_slogan_data']['author'][0];
        $arrFields['a.teaser'] = $GLOBALS['TL_LANG']['tl_slogan_data']['teaser'][0];
        $arrFields['a.slogan'] = $GLOBALS['TL_LANG']['tl_slogan_data']['slogan'][0];
        $arrFields['a.image'] = $GLOBALS['TL_LANG']['tl_slogan_data']['image'][0];

        return $arrFields;
    }

}
