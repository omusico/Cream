<?php

function table_link_to_edit($namedRoute, $id)
{
    return link_to_route($namedRoute . '.edit', 'Editar', [$id], array('class' => 'btn btn-xs btn-primary'));
}

function table_link_to_delete($namedRoute, $id)
{
    return link_to_route($namedRoute . '.delete', 'Eliminar', [$id], array('class' => 'btn btn-xs btn-danger', 'onclick' => 'return confirm("¿Está serguro de que quiere eliminar este elemento?")'));
}

function table_link_to_restore($namedRoute, $id)
{
    return link_to_route($namedRoute . '.restore', 'Restaurar', [$id], array('class' => 'btn btn-xs btn-warning', 'onclick' => 'return confirm("¿Está serguro de que quiere restaurar este elemento?")'));
}

function table_links_to_edit_delete($namedRoute, $id)
{
    return table_link_to_edit($namedRoute, $id) . ' ' . table_link_to_delete($namedRoute, $id);
}

function link_to_entity($entityName, $entityObject)
{
    if ( ! is_null($entityObject))
        return link_to_route($entityName . '.show', $entityObject->name, [$entityObject->id]);

    return '';
}

function link_to_company($company = null)
{
    return link_to_entity('company', $company);
}

function link_to_deal($deal = null)
{
    return link_to_entity('deal', $deal);
}

function link_to_people($people = null)
{
    return link_to_entity('people', $people);
}

function sortable_table_heading($field, $order, $text)
{
    global $orderby;

    return link_to(Helpers\URLHelper::orderBy($field, $order), $text) . ' ' . (($field == $orderby && $order == 'desc' ) ? app_icon_tag('orderDesc') : app_icon_tag('orderAsc'));
}


function redirect_var()
{
    return 'fredirect=' . Crypt::encrypt(Request::fullUrl());
}

function form_redirect_var()
{
    return 'redirect=' . Crypt::encrypt(Request::fullUrl());
}

function is_redirect()
{
    return Input::has('fredirect') ? true : false;
}

function redirect_url()
{
    return Redirect::to(Crypt::decrypt(Input::get('fredirect')));
}