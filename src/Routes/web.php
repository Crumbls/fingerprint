<?php
Route::group([
		'middleware' => 'web'
	], function() {
	Route::post('fingerprint', \Crumbls\Fingerprint\Controllers\FingerprintController::class)->name('fingerprint');
});