<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
$wp_query = new WP_Query(array('post_status'=>'private','pagename'=>'home'));
?>

<div id="primary" class="full-content-area clear">
	<?php if ( have_posts() ) : the_post();  ?>
		<section class="section section-one clear wrapper">
			<?php
				$section1_title = get_field('section1_title');
				$advantages = get_field('advantages');
			?>
			<?php if($section1_title) { ?>
			<h2 class="section-title"><span><?php echo $section1_title;?></span></h2>
			<?php } ?>

			<?php if($advantages) { ?>
			<div class="featured-items clear">
				<div class="row clear flex-container">
					<?php foreach($advantages as $ad) { 
						$icon = $ad['adv_icon'];
						$title = $ad['adv_title'];
						$desc = $ad['adv_description'];
					?>
					<div class="column">
						<div class="inside clear">
							<?php if($icon) { ?>
							<div class="icon">
								<span><img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['title'];?>" /></span>
							</div>
							<?php } ?>
							<div class="desc-wrap">
								<?php if($title) { ?>
								<p class="title"><?php echo $title;?></p>
								<?php } ?>
								<?php if($desc) { ?>
								<div class="desc"><?php echo $desc;?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</section>

		<section class="section section-two clear">
			<?php
				$section2_title = get_field('section2_title');
				$section2_description = get_field('section2_description');
				$section2_image = get_field('section2_image');
				$section2_button_text = get_field('section2_button_text');
				$section2_button_link = get_field('section2_button_link');
			?>

			<?php if($section2_image) { ?>
			<div class="section2-image" style="background-image:url('<?php echo $section2_image['url'];?>');">
				<img src="<?php echo $section2_image['url'];?>" alt="<?php echo $section2_image['title'];?>" />
			</div>
			<?php } ?>

			<?php if($section2_description) { ?>
			<div class="section2-description <?php echo ($section2_image) ? 'has-image':'no-image';?>">
				<div class="inner clear">
					<div class="textwrap clear">
						<?php if($section2_title) { ?>
							<h2 class="title"><?php echo $section2_title; ?></h2>
						<?php } ?>
						<div class="text"><?php echo $section2_description; ?></div>

						<?php if($section2_button_text && $section2_button_link) { ?>
						<div class="buttondiv">
							<a href="<?php echo $section2_button_link; ?>"><?php echo $section2_button_text; ?></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</section>


		<section class="section section-three clear wrapper">
			<?php
				$section3_title = get_field('section3_title');
				$args = array(
					'posts_per_page'   => -1,
					'post_type'        => 'services',
					'post_status'      => 'publish'
					);
				$services = get_posts($args); ?>
			<?php if($services) { ?>
				<?php if($section1_title) { ?>
					<h2 class="section-title"><span><?php echo $section3_title;?></span></h2>
				<?php } ?>

				<div class="services-items clear">
					<div class="row clear flex-container">
						<?php foreach($services as $sv) { 
							$id = $sv->ID;
							$pagelink = get_permalink($id);
							$thumbnail_id = get_post_thumbnail_id($id);
							$img = wp_get_attachment_image_src($thumbnail_id,'medium');
							$basename = '';
							if($img) { ?>
							<div class="item">
								<div class="inside clear">
									<a href="<?php echo $pagelink;?>">
										<img src="<?php echo $img[0];?>" alt="<?php echo $sv->post_title;?>" />
										<span class="caption">
											<span class="name"><?php echo $sv->post_title;?></span>
										</span>
									</a>
								</div>
							</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>

			<?php } ?>
		</section>

	<?php endif; ?>

</div><!-- #primary -->

<?php
get_footer();
