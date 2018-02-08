<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 1/31/18
 * Time: 1:28 PM
 */

namespace Esl\helpers;


class Constants
{
    const STATUS_OK = 200;
    const STATUS_ERROR = 401;
    const LEAD_CUSTOMER = 'lead';
    const EXISTING_CUSTOMER = 'customer';
    const TARIFF_KPA = 'kpa';
    const TARIFF_INTERNAL = 'internal';
    const TARIFF_UNIT_TYPE_LUMPSUM = 'Lumpsum';
    const TARIFF_UNIT_TYPE_GRT = 'grt';
    const TARIFF_UNIT_TYPE_LOA = 'loa';
    const TARIFF_UNIT_TYPE_PERDAY = 'per day';
    const LEAD_QUOTATION_PENDING = 'pending';
    const LEAD_QUOTATION_REQUEST = 'request';
    const LEAD_QUOTATION_APPROVED = 'approved';
    const LEAD_QUOTATION_REVISION = 'revision';
    const LEAD_QUOTATION_DECLINED = 'declined';
    const LEAD_QUOTATION_ACCEPTED = 'accepted';
    const CUSTOMER = 'customer';
}