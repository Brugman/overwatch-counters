<?php

[ $success, $data ] = get_ow1_data( APP_GSHEET_URL );

if ( !$success )
{
    echo '<p class="error">'.$data.'</p>';
    return;
}

?>

<div class="game-version-switch">
    <?=include_svg('game-version-switch');?>
</div>

<div class="game-versions">

<?php

include 'ow1.php';
include 'ow2.php';

?>

</div><!-- game-versions -->

