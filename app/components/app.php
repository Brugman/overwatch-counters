<?php

[ $success, $data_ow1, $data_ow2 ] = get_data();

if ( !$success )
{
    echo '<p class="error">'.$data_ow1.'</p>';
    return;
}

?>

<div class="game-version-switch">
    <?=include_svg('game-version-switch');?>
</div>

<div class="game-versions">

<?php

include 'ow2.php';
include 'ow1.php';

?>

</div><!-- game-versions -->

