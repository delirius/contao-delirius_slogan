<?php
if ($this->css) {
    $GLOBALS['TL_CSS'][] = 'system/modules/delirius_slogan/html/'.$this->css.'.css';
}
?>

<?php
$width  = "200";  /** * new width */
$height = "190";  /** * new height */
$mode   = 'proportional'; /** * modes available: crop, proportional, box */
$target = null;   /** * target for new images default = null (system/html/) */
?>

<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>

    <div class="list_slogan_wrapper">
        <?php
        foreach ($this->slogan as $val):

            echo '<div class="list_slogan">';
	        if ($val['title'] != '') {
				echo '<span id="slogan-' . $val['id'] . '" class="list_slogan_title">' . $val['title'] . '</span>';
	        }

            if ($val['image']) {
                echo '<div class="list_slogan_image">';
                echo '<img src="' . $this->getImage($val['image'], $width, $height, $mode, $target) . '" />';
                echo '</div>';
            }
            if ($val['slogan'] != '') {
                echo '<br /><span class="list_slogan_text">';
                echo '' . nl2br($val['slogan']) . '';
                echo '</span>';
            }

            if ($val['author'] != '') {
                echo '<br /><span class="list_slogan_author">';
                echo $val['author'];
                echo '</span>';
            }

            echo '</div>';
            echo '<div class="clear"></div>';
            ?>

            <?php
        endforeach;
        ?>

    </div>
</div>
