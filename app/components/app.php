<?php

[ $success, $data ] = get_ow1_data( APP_GSHEET_URL );

if ( !$success )
{
    echo '<p class="error">'.$data.'</p>';
    return;
}

?>

<ul class="game-version-buttons">
    <li><a class="js-activate-game-version" data-game-version="1" href="#">OW1</a></li>
    <li><a class="js-activate-game-version" data-game-version="2" href="#">OW2</a></li>
</ul>

<div class="game-versions">

<?php

include 'ow1.php';
include 'ow2.php';

?>

</div><!-- game-versions -->

