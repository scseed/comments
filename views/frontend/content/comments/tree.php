<?php defined('SYSPATH') or die('No direct access allowed.');?>
<h3><a name="comments"><?php echo __('Comments')?>:</a></h3>
<?php if(isset($_user)):?>
<?php StaticJs::instance()->add_inline("
	var comment_link = '".$comment_link."';
	var comment_button = '".__('to_comment')."';
")?>
<div id="comment_main">
<?php echo Form::open($main_comment_link)?>
	<div class="form-item"><?php echo Form::textarea('text')?></div>
	<div class="form-item"><?php echo Form::button(NULL, __('to_comment'))?></div>
<?php echo Form::close()?>
</div>
<?php endif;?>
<div id="comments"><?php echo $comments?></div>
