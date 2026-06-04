<?php
function renderDeletePage($conn) {
    $message = '';
    $message_type = '';
    $delete_id = isset($_GET['delete_id']) ? (int)$_GET['delete_id'] : null;

    if ($delete_id) {
        $stmt = $conn->prepare("SELECT surname, name, lastname FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $record = $result->fetch_assoc();
        $stmt->close();
        
        if ($record) {
            $full_name = $record['surname'] . ' ' . $record['name'];
            $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
            $stmt->bind_param("i", $delete_id);
            
            if ($stmt->execute()) {
                $message = "Запись с фамилией {$full_name} удалена";
                $message_type = 'success';
            } else {
                $message = "Ошибка: запись не удалена";
                $message_type = 'error';
            }
            $stmt->close();
        }
    }
  
    $all_records = [];
    $result = $conn->query("SELECT id, surname, name, lastname FROM contacts ORDER BY surname ASC, name ASC");
    while ($record = $result->fetch_assoc()) {
        $all_records[] = $record;
    }

    $html = '';
    
    if ($message) {
        $html .= "<div class='{$message_type}'>{$message}</div>";
    }
    
    if (count($all_records) == 0) {
        $html .= '<p>Нет записей для удаления.</p>';
    } else {
        $html .= '<div class="record-list">';
        $menu = $_GET['menu'] ?? 'delete';
        foreach ($all_records as $record) {
            $initials = mb_substr($record['name'], 0, 1) . '.' . mb_substr($record['lastname'], 0, 1) . '.';
            $display_name = htmlspecialchars($record['surname'] . ' ' . $initials);
            $html .= "<a href='?menu={$menu}&delete_id={$record['id']}' class='delete-item' 
                      onclick=\"return confirm('Вы уверены, что хотите удалить запись \\\"{$record['surname']} {$record['name']}\\\"?');\">
                      {$display_name}</a>";
        }
        $html .= '</div>';
    }
    
    return $html;
}
?>