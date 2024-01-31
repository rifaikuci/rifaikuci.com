<?php


if (file_exists("../common/db/index.php")) {

    require_once "../common/db/index.php";
    require_once "../common/methods/index.php";
} else if (file_exists("../../common/db/index.php")) {
    require_once "../../common/db/index.php";
    require_once "../../common/methods/index.php";
} else if (file_exists("../../../common/db/index.php")) {
    require_once "../../../common/db/index.php";
    require_once "../../../common/methods/index.php";
} else if (file_exists("../../../../common/db/index.php")) {
    require_once "../../../../common/db/index.php";
    require_once "../../../../common/methods/index.php";
}

require_once "devices/index.php";
require_once "routines/index.php";

?>