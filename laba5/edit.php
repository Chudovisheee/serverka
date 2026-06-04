<?php
function renderEditForm($conn) {
    $message = '';
    $message_type = '';
    $current_id = isset($_GET['edit_id']) ? (int)$_GET['edit_id'] : null;
    $row = null;
  
    $all_records = [];
    $result = $conn->query("SELECT id, surname, name, lastname FROM contacts ORDER BY surname ASC, name ASC");
    while ($record = $result->fetch_assoc()) {
        $all_records[] = $record;
    }

    if ($current_id === null && count($all_records) > 0) {
        $current_id = $all_records[0]['id'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && $_POST['button'] === 'Сохранить') {
        $id = (int)$_POST['record_id'];
        $surname = trim($_POST['surname'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $gender = $_POST['gender'] ?? '';
        $birth_date = $_POST['date'] ?? '';
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['location'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $comment = trim($_POST['comment'] ?? '');
        
        if (empty($surname) || empty($name) || empty($gender) || empty($birth_date)) {
            $message = 'Ошибка: запись не обновлена. Заполните обязательные поля.';
            $message_type = 'error';
        } else {
            $stmt = $conn->prepare("UPDATE contacts SET surname=?, name=?, lastname=?, gender=?, birth_date=?, phone=?, address=?, email=?, comment=? WHERE id=?");
            $stmt->bind_param("sssssssssi", $surname, $name, $lastname, $gender, $birth_date, $phone, $address, $email, $comment, $id);
            
            if ($stmt->execute()) {
                $message = 'Запись обновлена';
                $message_type = 'success';
                $current_id = $id;
            } else {
                $message = 'Ошибка: запись не обновлена. ' . $conn->error;
                $message_type = 'error';
            }
            $stmt->close();
        }
    }

    if ($current_id) {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $current_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    }
   
    $html = '<div class="record-list">';
    $menu = $_GET['menu'] ?? 'edit';
    foreach ($all_records as $record) {
        $full_name = htmlspecialchars($record['surname'] . ' ' . $record['name'] . ' ' . $record['lastname']);
        $active_class = ($current_id == $record['id']) ? 'class="current-record"' : '';
        $html .= "<a href='?menu={$menu}&edit_id={$record['id']}' {$active_class}>{$full_name}</a>";
    }
    $html .= '</div>';
 
    if ($message) {
        $html .= "<div class='{$message_type}'>{$message}</div>";
    }
   
    if ($row) {
        $html .= '<form name="form_edit" method="post">
                    <input type="hidden" name="record_id" value="' . $row['id'] . '">
                    <div class="column">
                        <div class="add">
                            <label>Фамилия *</label> 
                            <input type="text" name="surname" placeholder="Фамилия" value="' . htmlspecialchars($row['surname']) . '">
                        </div>
                        <div class="add">
                            <label>Имя *</label> 
                            <input type="text" name="name" placeholder="Имя" value="' . htmlspecialchars($row['name']) . '">
                        </div>
                        <div class="add">
                            <label>Отчество</label> 
                            <input type="text" name="lastname" placeholder="Отчество" value="' . htmlspecialchars($row['lastname']) . '">
                        </div>
                        <div class="add">
                            <label>Пол *</label> 
                            <select name="gender">
                                <option value="мужской" ' . ($row['gender'] == 'мужской' ? 'selected' : '') . '>мужской</option>
                                <option value="женский" ' . ($row['gender'] == 'женский' ? 'selected' : '') . '>женский</option>
                            </select>
                        </div>
                        <div class="add">
                            <label>Дата рождения *</label> 
                            <input type="date" name="date" value="' . $row['birth_date'] . '">
                        </div>
                        <div class="add">
                            <label>Телефон</label> 
                            <input type="text" name="phone" placeholder="Телефон" value="' . htmlspecialchars($row['phone']) . '">
                        </div>
                        <div class="add">
                            <label>Адрес</label> 
                            <input type="text" name="location" placeholder="Адрес" value="' . htmlspecialchars($row['address']) . '">
                        </div>
                        <div class="add">
                            <label>Email</label> 
                            <input type="email" name="email" placeholder="Email" value="' . htmlspecialchars($row['email']) . '">
                        </div>
                        <div class="add">
                            <label>Комментарий</label> 
                            <textarea name="comment" placeholder="Краткий комментарий">' . htmlspecialchars($row['comment']) . '</textarea>
                        </div>
                        <button type="submit" value="Сохранить" name="button" class="form-btn">Сохранить</button>
                    </div>
                </form>';
    } else {
        $html .= '<p>Нет записей для редактирования.</p>';
    }
    
    return $html;
}
?>