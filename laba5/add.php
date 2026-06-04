<?php
function renderAddForm($conn) {
    $message = '';
    $message_type = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && $_POST['button'] === 'Добавить') {
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
            $message = 'Ошибка: запись не добавлена. Заполните обязательные поля (Фамилия, Имя, Пол, Дата рождения).';
            $message_type = 'error';
        } else {
            $stmt = $conn->prepare("INSERT INTO contacts (surname, name, lastname, gender, birth_date, phone, address, email, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $surname, $name, $lastname, $gender, $birth_date, $phone, $address, $email, $comment);
            
            if ($stmt->execute()) {
                $message = 'Запись добавлена';
                $message_type = 'success';
                
                $_POST = array();
            } else {
                $message = 'Ошибка: запись не добавлена. ' . $conn->error;
                $message_type = 'error';
            }
            $stmt->close();
        }
    }

    $html = '';
    
    if ($message) {
        $html .= "<div class='{$message_type}'>{$message}</div>";
    }
    
    $surname_val = htmlspecialchars($_POST['surname'] ?? '');
    $name_val = htmlspecialchars($_POST['name'] ?? '');
    $lastname_val = htmlspecialchars($_POST['lastname'] ?? '');
    $gender_val = $_POST['gender'] ?? 'мужской';
    $date_val = $_POST['date'] ?? '';
    $phone_val = htmlspecialchars($_POST['phone'] ?? '');
    $address_val = htmlspecialchars($_POST['location'] ?? '');
    $email_val = htmlspecialchars($_POST['email'] ?? '');
    $comment_val = htmlspecialchars($_POST['comment'] ?? '');
    
    $html .= '<form name="form_add" method="post">
                <div class="column">
                    <div class="add">
                        <label>Фамилия *</label> 
                        <input type="text" name="surname" placeholder="Фамилия" value="' . $surname_val . '">
                    </div>
                    <div class="add">
                        <label>Имя *</label> 
                        <input type="text" name="name" placeholder="Имя" value="' . $name_val . '">
                    </div>
                    <div class="add">
                        <label>Отчество</label> 
                        <input type="text" name="lastname" placeholder="Отчество" value="' . $lastname_val . '">
                    </div>
                    <div class="add">
                        <label>Пол *</label> 
                        <select name="gender">
                            <option value="мужской" ' . ($gender_val == 'мужской' ? 'selected' : '') . '>мужской</option>
                            <option value="женский" ' . ($gender_val == 'женский' ? 'selected' : '') . '>женский</option>
                        </select>
                    </div>
                    <div class="add">
                        <label>Дата рождения *</label> 
                        <input type="date" name="date" value="' . $date_val . '">
                    </div>
                    <div class="add">
                        <label>Телефон</label> 
                        <input type="text" name="phone" placeholder="Телефон" value="' . $phone_val . '">
                    </div>
                    <div class="add">
                        <label>Адрес</label> 
                        <input type="text" name="location" placeholder="Адрес" value="' . $address_val . '">
                    </div>
                    <div class="add">
                        <label>Email</label> 
                        <input type="email" name="email" placeholder="Email" value="' . $email_val . '">
                    </div>
                    <div class="add">
                        <label>Комментарий</label> 
                        <textarea name="comment" placeholder="Краткий комментарий">' . $comment_val . '</textarea>
                    </div>
                    <button type="submit" value="Добавить" name="button" class="form-btn">Добавить</button>
                </div>
            </form>';
    
    return $html;
}
?>