<?php
namespace LiteraryClub\Controllers;

use LiteraryClub\Models\Contact;
use LiteraryClub\View\View;

class ContactsController
{
    private $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../public');
    }
    
    public function index()
    {
        $contacts = Contact::findAll();
        
        $this->view->renderHtml('contacts/index.php', [
            'contacts' => $contacts,
            'title' => 'Участники клуба'
        ]);
    }
    
    public function add()
    {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = new Contact();
            $contact->setSurname($_POST['surname'] ?? '');
            $contact->setName($_POST['name'] ?? '');
            $contact->setLastname($_POST['lastname'] ?? '');
            $contact->setGender($_POST['gender'] ?? 'мужской');
            $contact->setBirthDate($_POST['birth_date'] ?? '');
            $contact->setPhone($_POST['phone'] ?? '');
            $contact->setAddress($_POST['address'] ?? '');
            $contact->setEmail($_POST['email'] ?? '');
            $contact->setComment($_POST['comment'] ?? '');
            
            if (empty($contact->getSurname()) || empty($contact->getName()) || empty($contact->getBirthDate())) {
                $message = 'Заполните обязательные поля!';
            } else {
                $contact->save();
                header('Location: /kyrsach_literary_club/public/contacts?added=1');
                return;
            }
        }
        
        $this->view->renderHtml('contacts/add.php', [
            'message' => $message,
            'title' => 'Добавление участника'
        ]);
    }
    
    public function edit(int $id)
    {
        $contact = Contact::getById($id);
        if (!$contact) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact->setSurname($_POST['surname'] ?? '');
            $contact->setName($_POST['name'] ?? '');
            $contact->setLastname($_POST['lastname'] ?? '');
            $contact->setGender($_POST['gender'] ?? 'мужской');
            $contact->setBirthDate($_POST['birth_date'] ?? '');
            $contact->setPhone($_POST['phone'] ?? '');
            $contact->setAddress($_POST['address'] ?? '');
            $contact->setEmail($_POST['email'] ?? '');
            $contact->setComment($_POST['comment'] ?? '');
            $contact->save();
            header('Location: /kyrsach_literary_club/public/contacts?updated=1');
            return;
        }
        
        $this->view->renderHtml('contacts/edit.php', [
            'contact' => $contact,
            'title' => 'Редактирование участника'
        ]);
    }
    
    public function delete(int $id)
    {
        $contact = Contact::getById($id);
        if ($contact) {
            $contact->delete();
        }
        header('Location: /kyrsach_literary_club/public/contacts?deleted=1');
    }
}