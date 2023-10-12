<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function format_reservation_id($id)
{
    return 'R' . str_pad($id, 7, '0', STR_PAD_LEFT);
}