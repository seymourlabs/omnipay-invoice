<?php

echo('PREFIX' . date('Ymd', time()) . '-' . substr((string)microtime(), 2, 6) . date('His', time())  . '-' . str_pad(rand(0, 9999), 4, 0, STR_PAD_LEFT));