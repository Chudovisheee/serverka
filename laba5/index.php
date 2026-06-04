<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'contact_book');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$active_menu = $_GET['menu'] ?? 'view';
$sort_type = $_GET['sort'] ?? 'date_added';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

require_once 'menu.php';
require_once 'viewer.php';
require_once 'add.php';
require_once 'edit.php';
require_once 'delete.php';

$menu_html = renderMenu($active_menu);
$submenu_html = '';
$content_html = '';

switch($active_menu) {
    case 'view':
        $submenu_html = renderSubMenu($sort_type);
        $content_html = renderTableView($conn, $sort_type, $page);
        break;
    case 'add':
        $content_html = renderAddForm($conn);
        break;
    case 'edit':
        $content_html = renderEditForm($conn);
        break;
    case 'delete':
        $content_html = renderDeletePage($conn);
        break;
    default:
        $content_html = renderTableView($conn, $sort_type, $page);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php echo $menu_html; ?>
    </header>
    
    <main>
        <?php if ($submenu_html): ?>
            <div class="submenu">
                <?php echo $submenu_html; ?>
            </div>
        <?php endif; ?>
        
        <?php echo $content_html; ?>
    </main>
    
    <footer>
        Записная книжка
    </footer>
</body>
</html>