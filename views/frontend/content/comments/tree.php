<?php defined('SYSPATH') or die('No direct access allowed.');?>
<h3><a name="comments"><?php echo __('Comments')?>:</a></h3>
<?php if(isset($_user)):?>
<?php StaticJs::instance()->add("
	var comment_link = '".Route::url('comments', array('action' => 'add', 'type' => $comment_type, 'lang' => i18n::lang()))."';
	var comment_button = '".__('to_comment')."';
", NULL, 'inline')?>
<div id="comment_main">
<?php echo Form::open(Route::url('comments', array('action' => 'add', 'type' => $comment_type, 'object_id' => $last_comment_id, 'place' => $place, 'lang' => i18n::lang())))?>
	<div class="form-item"><?php echo Form::textarea('text')?></div>
	<div class="form-item"><?php echo Form::button(NULL, __('to_comment'))?></div>
<?php echo Form::close()?>
</div>
<?php endif;?>
<div id="comments"><?php echo $comments?></div>
