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
 * Class fe_list_slogan
 *
 * @copyright  2010
 * @author     delirius
 * @package    Controller
 */
class fe_list_slogan extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'tpl_list_slogan';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['slogan_liste'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile()
    {

        $objParams = \Database::getInstance()->prepare("SELECT * FROM tl_module WHERE id=?")
                ->limit(1)
                ->execute($this->id);

        // template
        if ($objParams->delirius_slogan_template === '')
        {
            $objParams->delirius_slogan_template = 'slogan_list_tableless';
        }
        $this->Template = new FrontendTemplate($objParams->delirius_slogan_template);

        // load css
        if ($objParams->delirius_slogan_css !== '')
        {
            $this->Template->css = $objParams->delirius_slogan_css;
        }


        $imageSize = deserialize($objParams->delirius_slogan_imagesize);

        if ($objParams->delirius_slogan_fields != '')
        {
            $arrFields = deserialize($objParams->delirius_slogan_fields);
        }

        if ($objParams->delirius_slogan_number > 0)
        {

            $strLimit = ' LIMIT ' . $objParams->delirius_slogan_number;
        }
        else
        {
            $strLimit = '';
        }

        if ($objParams->delirius_slogan_order === 'random')
        {
            $strOrder = ' RAND()';
        }
        else
        {
            $strOrder = ' b.sorting,a.sorting';
        }

        if ($objParams->delirius_slogan_category != '')
        {
            $arrCat = deserialize($objParams->delirius_slogan_category);
            $strAnd = ' AND b.id IN (' . implode(',', $arrCat) . ') ';
        }



        $arrSlogan = array();

        $query = ' SELECT ' . implode(',', $arrFields) . ' FROM tl_slogan_data a, tl_slogan_category b WHERE a.pid=b.id ' . $strAnd . ' AND a.published = ? ORDER BY ' . $strOrder . $strLimit;

        $objData = \Database::getInstance()->prepare($query)->execute(1);
        while ($objData->next())
        {
            $imageSrc = '';
            if ($objData->image)
            {
                $objFile = \FilesModel::findById($objData->image);
                if ($imageSize)
                {
                    $imageSrc = $this->getImage($objFile->path, $imageSize[0], $imageSize[1], $imageSize[2]);
                    $imagesize = ' width="' . $imageSize[0] . '" height="' . $imageSize[1] . '"';
                }
                else
                {
                    $imageSrc = $objFile->path;
                    $imagesize = '';
                }
            }

            $arrNew = array
                (
                'id' => trim($objData->id),
                'categorytitle' => trim($objData->categorytitle),
                'title' => trim($objData->title),
                'teaser' => trim($objData->teaser),
                'slogan' => trim($objData->slogan),
                'image' => $imageSrc,
                'imageSize' => $imagesize,
                'author' => trim($objData->author)
            );

            $arrSlogan[] = $arrNew;
        }
        $this->Template->slogan = $arrSlogan;
    }

}

?>