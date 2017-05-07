<?php
require_once __DIR__.'/../src/nazarpc/BananaHTML.php';
class h extends nazarpc\BananaHTML {
	protected static function form_csrf () {
		return static::input(
			[
				'name'  => 'secret',
				'type'  => 'hidden',
				'value' => 'CSRF token'
			]
		);
	}
}
