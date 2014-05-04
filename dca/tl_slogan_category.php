<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2010
 * @author     delirius
 * @package    RandomSlogan
 * @license    GNU/LGPL
 * @filesource
 */
/**
 * Table tl_slogan_category
 */
$GLOBALS['TL_DCA']['tl_slogan_category'] = array
    (
// Config
    'config' => array
        (
        'dataContainer' => 'Table',
        'ctable' => array('tl_slogan_data'),
        'label' => &$GLOBALS['TL_LANG']['tl_slogan_category']['category'],
        'sql' => array
            (
            'keys' => array
                (
                'id' => 'primary',
                'pid' => 'index'
            )
        )
    ),
// List
    'list' => array
        (
        'sorting' => array
            (
            'mode' => 0,
            'fields' => array('sorting'),
            'flag' => 1
        ),
        'label' => array
            (
            'fields' => array('title'),
            'format' => '<strong>%s</strong>'
        ),
        'global_operations' => array
            (
            'all' => array
                (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
            (
            'edit' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_slogan_category']['edit'],
                'href' => 'table=tl_slogan_data',
                'icon' => 'edit.gif',
                'attributes' => 'class="contextmenu"'
            ),
            'copy' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_slogan_category']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ),
            'cut' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_link_data']['cut'],
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.gif'
            ),
            'delete' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_slogan_category']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_slogan_category']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),
// Palettes
    'palettes' => array
        (
        '__selector__' => array(''),
        'default' => '{slogan_label},title;'
    ),
// Subpalettes
    'subpalettes' => array
        (
        '' => ''
    ),
// Fields
    'fields' => array
        (
        'id' => array
            (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
            (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
            (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
            (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_slogan_category']['title'],
            'exclude' => true,
            'inputType' => 'text',
            'search' => true,
            'sorting' => true,
            'filter' => true,
            'eval' => array('mandatory' => true, 'maxlength' => 255),
            'sql' => "varchar(128) NOT NULL default ''"
        )
    )
);
?>