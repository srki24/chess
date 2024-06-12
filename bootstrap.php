<?php

require_once __DIR__ . '/vendor/autoload.php';

use Chess\Game\Board;



$b = new Board();

echo $b->getField('a1');
echo 1;