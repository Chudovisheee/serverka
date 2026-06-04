<?php
function renderTableView($conn, $sort_type, $page) {
    $records_per_page = 10;
    $offset = ($page - 1) * $records_per_page;
    
    switch($sort_type) {
        case 'surname':
            $order_by = "ORDER BY surname ASC, name ASC";
            break;
        case 'birth_date':
            $order_by = "ORDER BY birth_date ASC";
            break;
        case 'date_added':
        default:
            $order_by = "ORDER BY created_at ASC, id ASC";
            break;
    }

    $count_result = $conn->query("SELECT COUNT(*) as total FROM contacts");
    $total_records = $count_result->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);
    
    $sql = "SELECT id, surname, name, lastname, gender, birth_date, phone, address, email, comment 
            FROM contacts 
            {$order_by} 
            LIMIT {$records_per_page} OFFSET {$offset}";
    
    $result = $conn->query($sql);
    
    if (!$result || $result->num_rows == 0) {
        return "<p>Нет записей в базе данных.</p>";
    }

    $html = '<table border="1" cellpadding="8" cellspacing="0">';
    $html .= '<tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Пол</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Email</th>
                <th>Комментарий</th>
              </tr>';
    
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['surname']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['lastname']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['birth_date']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['address']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['comment']) . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';

    if ($total_pages > 1) {
        $html .= '<div class="pagination">';
        $menu = $_GET['menu'] ?? 'view';
        $sort = $_GET['sort'] ?? 'date_added';
        
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? 'class="active-page"' : '';
            $html .= "<a href='?menu={$menu}&sort={$sort}&page={$i}' {$active_class}>{$i}</a>";
        }
        $html .= '</div>';
    }
    
    return $html;
}
?>