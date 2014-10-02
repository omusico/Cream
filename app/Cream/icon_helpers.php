<?php

function icon_tag ($name)
{
    return '<i class="fa fa-fw fa-' . $name . '"></i>';
}

function app_icon_tag($name)
{
    return icon_tag(Config::get('cream.icons.' . $name));
}