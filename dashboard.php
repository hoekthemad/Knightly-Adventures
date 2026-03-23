<?php
require_once 'src/php/config.php';
require_once 'src/utils/general.php';
require_once 'src/utils/actions/dashboard.php';
doLoginCheck();

require_once 'src/html/static/dashboard.header.php';

require_once 'src/html/actions/dashboard.php';

require_once 'src/html/static/dashboard.footer.php';