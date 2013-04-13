<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * Table tl_slogan_data
 */
$GLOBALS['TL_DCA']['tl_slogan_data'] = array
        (

// Config
        'config' => array
        (
                'dataContainer'               => 'Table',
                'ptable'                      => 'tl_slogan_category'
        ),

// List
        'list' => array
        (
                'sorting' => array
                (
                        'mode'                    => 4,
                        'fields'                  => array('sorting'),
                        'flag'                    => 1,
                        'panelLayout'                    => 'search,sort,filter',
                        'headerFields'                => array('title','published', 'teaser'),
                        'child_record_callback'  	=> array('class_listslogan', 'listSlogan')

                ),
                'label' => array
                (
                        'fields'                  => array('title'),
                        'format'                  => '%s'
                ),
                'global_operations' => array
                (
                        'all' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                                'href'                => 'act=select',
                                'class'               => 'header_edit_all',
                                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
                        )
                ),
                'operations' => array
                (
                        'edit' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['tl_slogan_data']['edit'],
                                'href'                => 'act=edit',
                                'icon'                => 'edit.gif'
                        ),
                        'copy' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['tl_slogan_data']['copy'],
                                'href'                => 'act=copy',
                                'icon'                => 'copy.gif'
                        ),
                        'delete' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['tl_slogan_data']['delete'],
                                'href'                => 'act=delete',
                                'icon'                => 'delete.gif',
                                'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                        ),
                        'show' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['tl_slogan_data']['show'],
                                'href'                => 'act=show',
                                'icon'                => 'show.gif'
                        )
                )
        ),

// Palettes
        'palettes' => array
        (
                '__selector__'                => array(''),
                'default'                     => '{slogan_label},published,title,author,teaser,slogan,image;'
        ),

// Subpalettes
        'subpalettes' => array
        (
                ''                            => ''
        ),

// Fields
        'fields' => array
        (
                'published' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_slogan_data']['published'],
                        'exclude'                 => true,
                        'filter'                  => true,
                        'inputType'               => 'checkbox',
                        'default'               => '1',
                        'eval'                    => array('mandatory'=>false, 'maxlength'=>255)
                ),


                'title' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_slogan_data']['title'],
                        'exclude'                 => true,
                        'inputType'               => 'text',
                        'search'                  => true,
                        'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50')
                ),
                'author' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_slogan_data']['author'],
                        'exclude'                 => true,
                        'inputType'               => 'text',
                        'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50')
                ),
                'teaser' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_slogan_data']['teaser'],
                        'exclude'                 => true,
                        'inputType'               => 'textarea',
                        'eval'                    => array('mandatory'=>false, 're'=>'tinyFlash', 'cols'=>3, 'rows'=>10)
                ),
                'slogan' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_slogan_data']['slogan'],
                        'exclude'                 => true,
                        'inputType'               => 'textarea',
                        'eval'                    => array('mandatory'=>false, 'rte'=>'tinyFlash', 'cols'=>3, 'rows'=>10)
                ),
                'image' => array
                (
                        'label'                   => $GLOBALS['TL_LANG']['tl_slogan_data']['image'],
                        'exclude'                 => true,
                        'inputType'               => 'fileTree',
                        'eval'                => array('files'=>true, 'fieldType'=>'radio', 'filesOnly' => true, 'extensions'=> 'jpg,jpeg,png,gif' )
                )
        )
);



class class_listslogan extends Backend
{

    public function listSlogan($arrRow)
    {



        $line = '';
        $line .= '<div class="cte_type ' . (($arrRow["published"] == 1) ? '' : 'un') . 'published">';
        $line .= $arrRow['title'];
        $line .= "</div>";
        if ($arrRow['image'] != '')
        {
            $line .= '<img src="'.$this->getImage($arrRow['image'], '36', '32', 'crop').'">';
        }

        $line .= "<div>";
        $line .= $arrRow['teaser'];
        $line .= "</div>";

        $line .= "\n";


        return($line);


    }

} // class



?>