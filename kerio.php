<?php
require_once dirname(__FILE__) . "/config/config.php";

if(new DateTime() > (new DateTime(REGISTER_ENDDATE))->sub(new DateInterval('P3D')) &&   new DateTime() < (new DateTime(REGISTER_ENDDATE))->add(new DateInterval('P3D'))) {
    if(isset($_GET['token']) && $_GET['token'] == KERIO_TOKEN ) {
        require_once dirname(__FILE__) . '/backend/guestdb.php';

        $guestdb = new GuestDB();

        echo json_encode($guestdb->listGuests());
    }
}