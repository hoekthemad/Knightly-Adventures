<?php
require_once 'src/php/config.php';
require_once 'src/utils/general.php';
require_once 'src/utils/actions/index.php';
if (!empty($_REQUEST['logout']) && $_REQUEST['logout'] == "true") {
    doLogout();
}
doLoginCheck();
require_once 'src/html/static/index.header.php';

require_once 'src/html/static/index.footer.php';