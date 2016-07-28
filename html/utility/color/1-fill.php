<?php /*
Title: Fill
Container: true
*/ ?>

<div class="grid g-gutter">
<?php
    $css_contents = file_get_contents('../build/css/styles.css', true);
    $lines = explode("\n", $css_contents);
    $hasHeading = false;
    $previous_group = 'x';
    foreach($lines as $line) {

        if(substr(trim($line), 0, 7) == '.u-fill') {
            $bits = explode(" ", substr($line, 1));
            $class_ = $bits[0];
            $bits = explode("-", $class_);
            $group = $bits[2];
            ?>
            <?php if($group != $previous_group) {
                ?><div class="g-col-xs-12"><h3><?php echo $group ?></h3></div><?php
                $previous_group = $group;
            }
            ?>
            <div class="g-col-xs-6 g-col-sm-4 g-col-md-3 g-col-xl-2">
                <div class="card cc-card--swatch">
                    <div class="u-block-xl <?php echo $class_ ?>">

                    </div>
                    <div class="card__footer">
                        <small><code>.<?php echo $class_ ?></code></small>
                    </div>
                </div>
            </div>
            <?php
        }
    }
?>
</div> <!-- close the last cc-vars div -->
