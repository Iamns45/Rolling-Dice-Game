<?php

if (isset($player_being_configured)): ?>
    <h1 id="names">
        <?php
        if (isset($players)) {
            echo $players[$player_being_configured - 1]["name"];
            echo ": ";
            echo $players[$player_being_configured - 1]["score"];
        } ?>
    </h1>

    <input type="submit" id="submit" class="button" name="user_guess" class="user_guess"
        <?php if ($win || $player_turn != $player_being_configured): ?>
            disabled

        <?php endif ?>
           value="ROLL">

<?php endif ?>
