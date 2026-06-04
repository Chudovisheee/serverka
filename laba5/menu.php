<?php
function renderMenu($active) {
    $menu_items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];
    
    $html = '';
    foreach ($menu_items as $key => $label) {
        $active_class = ($active === $key) ? 'class="active-menu"' : '';
        $html .= "<a href='?menu={$key}' {$active_class}>{$label}</a>";
    }
    
    return $html;
}

function renderSubMenu($active_sort) {
    $sort_items = [
        'date_added' => 'По порядку добавления',
        'surname' => 'По фамилии',
        'birth_date' => 'По дате рождения'
    ];
    
    $html = '';
    $menu = $_GET['menu'] ?? 'view';
    foreach ($sort_items as $key => $label) {
        $active_class = ($active_sort === $key) ? 'class="active-submenu"' : '';
        $html .= "<a href='?menu={$menu}&sort={$key}&page=1' {$active_class}>{$label}</a>";
    }
    
    return $html;
}
?>