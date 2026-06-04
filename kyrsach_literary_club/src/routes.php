<?php
return [
    '~^$~'                                    => [\LiteraryClub\Controllers\MainController::class, 'main'],
    '~^hello/(.*)$~'                          => [\LiteraryClub\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~'                            => [\LiteraryClub\Controllers\MainController::class, 'sayBye'],
    '~^stats$~'                               => [\LiteraryClub\Controllers\MainController::class, 'stats'],
    '~^feedback$~'                            => [\LiteraryClub\Controllers\MainController::class, 'feedback'],
    '~^books$~'                               => [\LiteraryClub\Controllers\BooksController::class, 'index'],
    '~^books/(\d+)$~'                         => [\LiteraryClub\Controllers\BooksController::class, 'view'],
    '~^profile/edit$~'                        => [\LiteraryClub\Controllers\ProfileController::class, 'edit'],
    '~^cart$~'                                => [\LiteraryClub\Controllers\CartController::class, 'index'],
    '~^cart/calculate$~'                      => [\LiteraryClub\Controllers\CartController::class, 'calculate'],
    '~^contacts$~'                            => [\LiteraryClub\Controllers\ContactsController::class, 'index'],
    '~^contacts/add$~'                        => [\LiteraryClub\Controllers\ContactsController::class, 'add'],
    '~^contacts/edit/(\d+)$~'                 => [\LiteraryClub\Controllers\ContactsController::class, 'edit'],
    '~^contacts/delete/(\d+)$~'               => [\LiteraryClub\Controllers\ContactsController::class, 'delete'],
];