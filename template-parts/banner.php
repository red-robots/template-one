<?php
$post_id = 0;
if( is_home() ) {
	$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'home'));
	if($wp_query) {
		$obj = $wp_query->queried_object;
		$post_id = $obj->ID;
	}
} else {
	global $post;
	$post_id = $post->ID;
}
$banner_image = get_field('banner_image',$post_id);
$banner_title = get_field('banner_title',$post_id);
$banner_caption = get_field('banner_caption',$post_id);
$banner_button_label = get_field('banner_button_label',$post_id);
$banner_button_link = get_field('banner_button_link',$post_id);

if($banner_image) { ?>
<div class="banner-wrapper clear">
	<div class="banner-image">
		<img src="<?php echo $banner_image['url']; ?>" alt="<?php echo $banner_image['title']; ?>" />
	</div>
	<?php if($banner_title || $banner_caption) { ?>
	<div class="banner-caption">
		<div class="wrapper">
			<div class="inside clear">
				<?php if($banner_title) { ?>
				<h2 class="title"><?php echo $banner_title; ?></h2>
				<?php } ?>
				<div class="caption">
				<?php if($banner_caption) { ?>
					<div class="text"><?php echo $banner_caption; ?></div>
				<?php } ?>
				<?php if($banner_button_label && $banner_button_link) { ?>
					<div class="button"><a href="<?php echo $banner_button_link; ?>"><?php echo $banner_button_label; ?></a></div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php } ?>