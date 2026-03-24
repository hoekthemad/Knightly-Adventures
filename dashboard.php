<?php
require_once 'src/php/config.php';
require_once 'src/utils/general.php';
require_once 'src/utils/actions/dashboard.php';
doLoginCheck();
getUserLevel();

require_once 'src/html/static/dashboard.header.php';

$pageName = getPageName();
if (empty($pageName)) {
    require_once 'src/html/actions/dashboard.php';
}
else {
    require_once 'src/html/actions/'.$pageName.'.php';
}


require_once 'src/html/static/dashboard.footer.php';