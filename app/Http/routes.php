<?php
Route::controller('datatables', 'DatatablesController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);

Route::controller('managers', 'managersController', [
    'anyData'  => 'managers.data',
    'getIndex' => 'managers',
]);