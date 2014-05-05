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
    }

}

$objupdaterRunonce = new updaterRunonce();
$objupdaterRunonce->run();
?>
