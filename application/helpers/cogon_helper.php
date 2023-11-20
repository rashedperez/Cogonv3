<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function format_reservation_id($id) {
    return 'R' . str_pad($id, 7, '0', STR_PAD_LEFT);
}

function format_reference_number($id) {
    return 'CRBCP-' . str_pad($id, 7, '0', STR_PAD_LEFT);
}

function format_short_quantity($measurement, $amount) {
    switch ($measurement) {
        case HOUR: return $amount . 'hr/s'; break;
        case KILOMETER: return $amount . 'km'; break;
        case QUANTITY: return 'x' . $amount; break;
        default: return $amount . $measurement;
    }
}

function format_id_number($id) {
    return str_pad($id, 6, '0', STR_PAD_LEFT);
}