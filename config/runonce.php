<?php

/*
 * $this->Database->tableExists('tl_galerie_pictures')
 * $this->Database->fieldExists('banner_template', 'tl_banner_category')
 *
 * $this->Database->listFields('tl_module')
 *
 * Database\Updater::convertSingleField('tl_galerie_pictures', 'fullscreenSingleSRC');
 * Database\Updater::convertMultiField('tl_content', 'imagesFolder');
 *
 */

class updaterRunonce extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
        $this->import('Files');
    }

    public function run()
    {
        if (version_compare(VERSION, '3.2', '>=') && $this->Database->tableExists('tl_slogan_data'))
        {
            $arrFields = $this->Database->listFields('tl_slogan_data');

            foreach ($arrFields as $arrField)
            {
                if ($arrField['name'] == 'image' && $arrField['type'] != 'binary')
                {
                    Database\Updater::convertSingleField('tl_slogan_data', 'image');
                }
            }
        }
        if (version_compare(VERSION, '3.2', '>=') )
        {
            $strFile = 'system/modules/delirius_slogan/config/database.sql';
            if (\Files::getInstance()->is_writeable($strFile))
            {
                \Files::getInstance()->delete($strFile);
            }
        }
    }

}

$objupdaterRunonce = new updaterRunonce();
$objupdaterRunonce->run();
?>
