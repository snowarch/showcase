<?php if(comments_open()) { ?>
	<div class="edgtf-post-info-comments-holder">
		<a itemprop="url" class="edgtf-post-info-comments" href="<?php comments_link(); ?>">
			<i class="icon_comment_alt"></i>
            <?php comments_number('0', '1', '%'); ?>
		</a>
	</div>
<?php } ?>