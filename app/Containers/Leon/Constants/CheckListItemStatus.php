<?php

namespace App\Containers\Leon\Constants;

final class CheckListItemStatus
{
    const STATUS_DESCRIPTIONS = [
        'UNT' => 'Untouched',
        'REJ' => 'Rejected',
        'NOO' => 'No',
        'OKI' => 'OK',
        'PFR' => 'Proforma requested',
        'PFS' => 'Proforma sent',
        'RQS' => 'Requested',
        'PRC' => 'Payment received',
        'SGN' => 'Signed',
        'YES' => 'Yes',
        'CNF' => 'Confirmed',
        'SN0' => 'Sent',
        'SN1' => 'Sent',
        'GRN' => 'Granted',
        'ACK' => 'Acknowledged',
        'CAG' => 'Credit Agreed',
        'UPN' => 'Upon arrival',
        'NAP' => 'Not Applicable',
        'QSM' => 'Pending',
    ];
}
