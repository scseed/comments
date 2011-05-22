<?php defined('SYSPATH') or die('No direct script access.');

Route::set('comments', 'comment(/<action>(/<type>)(/<object_id>(/<place>)(/<visibility>)))', array(
	'object_id'  => '\d+',
	'place'      => '(inside|next)',
	'visibility' => '(show|hide)'
))
	->defaults(array(
		'controller' => 'comment',
		'action' => 'tree',
		'visibility' => 'show',
));