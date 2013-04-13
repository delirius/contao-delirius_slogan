<?php

if (!defined('TL_ROOT'))
    die('You can not access this file directly!');

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
 * Class fe_list_slogan
 *
 * @copyright  2010
 * @author     delirius
 * @package    Controller
 */
class fe_list_slogan extends Module {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'tpl_list_slogan';

    /**
     * Generate module
     */
    protected function compile() {

        $objParams = $this->Database->prepare("SELECT * FROM tl_module WHERE id=?")
                ->limit(1)
                ->execute($this->id);


        //delirius_slogan_category
        if ($objParams->delirius_slogan_category != '') {
            $arrCat = deserialize($objParams->delirius_slogan_category);
            $strAnd = ' AND b.id IN (' . implode(',', $arrCat) . ') ';
        }

        // template
        if ($objParams->delirius_slogan_template == '') {
            $objParams->delirius_slogan_template = 'slogan_random';
        }
        $this->Template = new FrontendTemplate($objParams->delirius_slogan_template);

        // load css
        if ($objParams->delirius_slogan_css != '') {
            $this->Template->css = $objParams->delirius_slogan_css;
        }



        $arrSlogan = array();

        // $query = ' SELECT * FROM tl_slogan_data WHERE published = "1" ORDER BY sorting';
        $query = ' SELECT a.* FROM tl_slogan_data a, tl_slogan_category b WHERE a.pid=b.id ' . $strAnd . ' AND b.published = "1" AND a.published = "1" ORDER BY b.sorting,a.sorting';

        $objData = $this->Database->execute($query);
        while ($objData->next()) {
            if (is_numeric($objData->image)) {
                $objFile = \FilesModel::findByPk($objData->image);
                $objData->image = $objFile->path;
            }

            $arrNew = array
                (
                'id' => trim($objData->id),
                'title' => trim($objData->title),
                'teaser' => trim($objData->teaser),
                'slogan' => trim($objData->slogan),
                'image' => trim($objData->image),
                'author' => trim($objData->author)
            );

            $arrSlogan[] = $arrNew;
        }
        $this->Template->slogan = $arrSlogan;
    }

}

?>