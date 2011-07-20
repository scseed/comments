<?php defined('SYSPATH') or die('No direct access allowed.');?>
<h3><a name="comments"><?php echo __('Comments')?>:</a></h3>
<?php if(isset($_user)):?>
<<<<<<< HEAD
<?php StaticJs::instance()->add("
	var comment_link = '".Route::url('comments', array('action' => 'add', 'type' => $comment_type, 'lang' => i18n::lang()))."';
	var comment_button = '".__('to_comment')."';
", NULL, 'inline')?>
<div id="comment_main">
<?php echo Form::open(Route::url('comments', array('action' => 'add', 'type' => $comment_type, 'object_id' => $last_comment_id, 'place' => $place, 'lang' => i18n::lang())))?>
=======
<script type="text/javascript">
$(document).ready(function(){
	$('.add_comment').click(function(){
		var form = '<div id="comment">'
				 + '<form action="' + <?php echo Route::url('comments', array('action' => 'add', 'type' => $comment_type)) ?> + '/' + $(this).attr('prev_id') + '/' + $(this).attr('place') + '" method="post" accept-charset="utf-8">'
				 + '<input type="hidden" name="blog" value="' + <?php echo $object_id ?> + '" />'
				 + '<div class="form-item">'
				 + <?php echo Form::textarea('text') ?>
				 + '</div><div class="form-item">'
				 + '<div class="button button-lc"><div class="button-rc"><div class="button-fill">' 
				 + <?php echo Form::button(NULL, 'Прокомментировать') ?> + '</div></div></div>'
				 + '</div></form></div>';
		$('#comment').remove();

		if($(this).hasClass('last'))
		{
			$(this).parent().parent().parent().after(form);
		}
		else
		{
			$(this).parent().parent().next().after(form);
		}
	})
})
</script>
<div id="comment">
<?php echo Form::open(Route::url('comments', array('action' => 'add', 'type' => $comment_type, 'object_id' => $last_comment_id, 'place' => $place)))?>
>>>>>>> a3c2d83
	<div class="form-item"><?php echo Form::textarea('text')?></div>
	<div class="form-item"><?php echo Form::button(NULL, __('to_comment'))?></div>
<?php echo Form::close()?>
</div>
<?php endif;?>
<div id="comments"><?php echo $comments?></div>
