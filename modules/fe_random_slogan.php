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
 * Class fe_random_slogan
 *
 * @copyright  2010
 * @author     delirius
 * @package    Controller
 */
class fe_random_slogan extends Module {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'tpl_random_slogan';

    /**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['slogan_random'][0]) . ' ###';
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
    protected function compile() {

        $objParams = \Database::getInstance()->prepare("SELECT * FROM tl_module WHERE id=?")
                ->limit(1)
                ->execute($this->id);


        //delirius_slogan_number
        if ($objParams->delirius_slogan_number < 1) {
            $intNumber = 1;
        } else {
            $intNumber = intval($objParams->delirius_slogan_number);
        }

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

        //delirius_slogan_site
        if ($objParams->delirius_slogan_site != '') {
            $objTargetPage = \Database::getInstance()->prepare("SELECT id, alias FROM tl_page WHERE id=?")
                    ->limit(1)
                    ->execute($objParams->delirius_slogan_site);
            $this->Template->redirect = $this->generateFrontendUrl($objTargetPage->row());
        }

        $arrSlogan = array();

        //  $query = ' SELECT * FROM tl_slogan_data WHERE published = "1" ORDER BY RAND() LIMIT '.$intNumber;
        $query = ' SELECT a.* FROM tl_slogan_data a, tl_slogan_category b WHERE a.pid=b.id ' . $strAnd . ' AND b.published = "1" AND a.published = "1" ORDER BY RAND() LIMIT ' . $intNumber;


        $objData = $this->Database->execute($query);
        while ($objData->next()) {

            $objFile = \FilesModel::findById($objData->image);




            /*
            	$strCover = '';
			$objCover = \FilesModel::findByPk($objCds->cover);

			// Add cover image
			if ($objCover !== null)
			{
				$strCover = \Image::getHtml(\Image::get($objCover->path, '100', '100', 'center_center'));
			}


                        */

            $arrNew = array
                (
                'id' => trim($objData->id),
                'title' => trim($objData->title),
                'teaser' => trim($objData->teaser),
                'image' => trim($objFile->path),
                'author' => trim($objData->author)
            );

            $arrSlogan[] = $arrNew;
        }
        $this->Template->slogan = $arrSlogan;
    }

}

?>