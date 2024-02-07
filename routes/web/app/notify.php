<?php

Route::get('notify', function () {
    return view('notify.index');
})->name('notify');
