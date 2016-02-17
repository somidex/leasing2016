<?php

namespace Leasing\CoreBundle\Utilities;

class Constant
{
	// 2014-12-31
    const DATEFORMAT                    = "Y-m-d";
    // 23:59:59
    const TIMEFORMAT                    = "G:i:s";
     // 2014-12-31 23:59:59
    const DATETIMEFORMAT                = "Y-m-d G:i:s";
    const DAY                           = "day";
    const MONTH                         = "month";
    const YEAR                          = "year";

    //STATUS
    const ACTIVE                        = 1;
    const DELETE                        = 0;
    const INACTIVE                      = 2;
    const DRAFT                         = 3;
    const ARCHIVE                       = 4;

    //LEAD STATUS
    const PENDING                       = 1;
    const APPROVED                      = 2;
    const REJECTED                      = 3;
    const PAID                          = 4;
    const EXPIRED                       = 5;
    const ASSIGNED_AGENT                = 6;

    //LEAD STATUS - APPOINTMENT REQUESTS
    const DONE_UNIT_VIEWING             = 7;
    const CLIENT_NO_SHOW                = 8;
    const UNIT_VIEWING_POSTPONED        = 9;
    const LEASING_NEGOTIATE             = 10;
    const L_DOCUMENTS_SUBMITTED         = 11;
    const FINALIZING                    = 12;
    const SIGNED_CONTRACT               = 13;
    const MOVED_IN                      = 14;

    //LEAD STATUS - MISC
    const MOBILE_VERIFIED               = 15;
    const EMAIL_VERIFIED                = 16;

    //AGENT STATUS
    const VACANT                        = 0;
    const ASSIGNED                      = 1;

    //LEAD TYPE
    const PARKING                       = 1;
    const EVENT                         = 2;
    const APPOINTMENT                   = 3;
    const BOOKING                       = 4;

    //EVENT LEAD TYPE
    const EVENT_BOOKING                 = 1;
    const EVENT_INQUIRY                 = 2;

    //BADGE ICONS
    const ICON_MOBILE_VERIFIED          = "verified-sms.png";
    const ICON_EMAIL_VERIFIED           = "verified-mail.png";
}

?>