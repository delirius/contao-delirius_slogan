<?php
if ($this->css) {
    $GLOBALS['TL_CSS'][] = 'system/modules/delirius_slogan/html/'.$this->css.'.css';
}
?>

<?php
$width  = "72";  /** * new width */
$height = "66";  /** * new height */
$mode   = 'crop'; /** * modes available: crop, proportional, box */
$target = null;   /** * target for new images default = null (system/html/) */
?>

<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>

    <div class="slogan_wrapper">
        <?php
        echo '<table cellspacing="0">';
        echo '<tr>';

        foreach ($this->slogan as $val):
            if ($this->redirect != '')
            {
                $strLinkStart = '<a href="'.$this->redirect.'#slogan-'.$val['id'].'">';
                $strLinkEnd = '</a>';
            }

            echo '<td>';
            echo '<div class="slogan">';

            if ($val['image'])
            {
                echo '<div class="slogan_image">';
                echo $strLinkStart;
                echo '<img src="'.$this->getImage($val['image'], $width, $height, $mode, $target).'" />';
                echo $strLinkEnd;
                echo '</div>';
            }

	        if ($val['title'] != '') {
	            echo '<span class="slogan_title">' . $val['title'] . '</span>';
	        }
            if ($val['teaser'] != '')
            {
                echo '<br /><span class="slogan_text">';
                echo ''.nl2br($val['teaser']).'';
                echo '</span>';
            }
            if ($this->redirect != '')
            {
                echo '&nbsp;';
                echo $strLinkStart;
                echo ' -> ';
                echo $strLinkEnd;
            }

            if ($val['author'] != '')
            {
                echo '<br /><span class="slogan_author">';
                echo $val['author'];
                echo '</span>';
            }

            echo '</div>';

            echo '</td>';



    ?>

        <?php endforeach;
        echo '</tr>';
        echo '</table>';

?>

    </div>
</div>
