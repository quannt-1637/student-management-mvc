<?php

    Route::set(
        'index.php', function () {
            Index::CreateView('Index');
        }
    );

    Route::set(
        'about-us', function () {
            AboutUs::CreateView('AboutUs');
        }
    );

    Route::set(
        'contact-us', function () {
            ContactUs::CreateView('ContactUs');
        }
    );

    Route::set(
        'admin', function () {
            AdminController::getAllStudents();
        }
    );

    Route::set(
        'create', function () {
            AdminController::createStudent();
        }
    );

    Route::set(
        'store', function () {
            AdminController::store();
        }
    );

    Route::set(
        'delete', function () {
            AdminController::destroy();
        }
    );
