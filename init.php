<?php defined('SYSPATH') or die('No direct script access.');

$langs = Controller_Page::langs();

Route::set('comments', '(<lang>/)comment(/<action>(/<type>)(/<object_id>(/<place>)(/<visibility>)))', array(
	'lang'       => $langs,
	'type'       => '\D+',
	'object_id'  => '\d+',
	'place'      => '(inside|next)',
	'visibility' => '(show|hide)'
))
	->defaults(array(
		'controller' => 'comment',
		'action'     => 'tree',
		'visibility' => 'show',
		'lang'       => I18n::lang(),
));