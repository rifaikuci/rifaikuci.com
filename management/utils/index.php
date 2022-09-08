<?php

$lang = 'tr';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (file_exists("utils/forms/index.php")) {
    require_once "utils/forms/index.php";
} else if (file_exists("../utils/forms/index.php")) {
    require_once "../utils/forms/index.php";
} else if (file_exists("../../utils/forms/index.php")) {
    require_once "../../utils/forms/index.php";

} else if (file_exists("../../../utils/forms/index.php")) {
    require_once "../../../utils/forms/index.php";
}

if(file_exists("../common/db/index.php")) {
    require_once "../common/db/index.php";
    require_once "../common/methods/index.php";
    require_once "../common/data/index.php";
}

else if(file_exists("../../common/db/index.php")) {
    require_once "../../common/db/index.php";
    require_once "../../common/methods/index.php";
    require_once "../../common/data/index.php";
}

else if(file_exists("../../../common/db/index.php")) {
    require_once "../../../common/db/index.php";
    require_once "../../../common/methods/index.php";
    require_once "../../../common/data/index.php";
}

else if(file_exists("../../../../common/db/index.php")) {
    require_once "../../../../common/db/index.php";
    require_once "../../../../common/methods/index.php";
    require_once "../../../../common/data/index.php";
}



?>
