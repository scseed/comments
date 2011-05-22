<?php defined('SYSPATH') or die('No direct access allowed.');?>
<h3><a name="comments"><?php echo __('Комментарии:')?></a></h3>
<?php echo $comments?>

<?php if(isset($_user)):?>
<?php echo StaticJs::instance()->addJsInline(
"
$(document).ready(function(){
	$('.add_comment').click(function(){
		var form = '<div id=\"comment\">'
				 + '<form action=\"" . Route::url('comments', array('action' => 'add', 'type' => $comment_type)) . "/' + $(this).attr('prev_id') + '/' + $(this).attr('place') + '\" method=\"post\" accept-charset=\"utf-8\">'
				 + '<input type=\"hidden\" name=\"blog\" value=\"" . $object_id . "\" />'
				 + '<div class=\"form-item\">'
				 + '" . Form::textarea('text') . "'
				 + '</div><div class=\"form-item\">'
				 + '<div class=\"button button-lc\"><div class=\"button-rc\"><div class=\"button-fill\">" . Form::button(NULL, 'Прокомментировать') . "</div></div></div>'
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
"
)?>
<div id="comment">
<?php echo Form::open(Route::url('comments', array('action' => 'add', 'type' => $comment_type, 'object_id' => $last_comment_id, 'place' => $place)))?>
	<div class="form-item"><?php echo Form::textarea('text')?></div>
	<div class="form-item"><?php echo Form::button(NULL, __('Прокомментировать'))?></div>
<?php echo Form::close()?>
</div>
<?php endif;?>