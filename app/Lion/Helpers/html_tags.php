<?php

function html_status_tag($statusObj) {
    if ($statusObj)
        return '<span class="label label-' . Config::get('cream.statuses.' . $statusObj->color) . '">' . $statusObj->name . '</span>';

    return 'Ninguno';
}