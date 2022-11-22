<?php
    get_header();
   
?>
		<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					<div id="content">
                        <?php
                            while(have_posts())
                            {
                                the_post();
								// echo the_date();
								// the_author_link(); die();
                            //  the_author_posts_link(); 
                            // echo the_permalink();
							// the_author();
                        ?>
						<div class="post">
							<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
							<p class="meta">Posted by <?php the_author_posts_link();  ?> on 
							<?php
							//  the_date(); 
							// the_time('M d, Y');
							// the_time('F j, Y');
							 ?>
							 <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" class="entry-date"><?php the_time('F j, Y') ?></a>
								&nbsp;&bull;&nbsp; <a href="<?php the_permalink(); ?>">Comments (<?php echo get_comments_number();  ?>)</a> &nbsp;&bull;&nbsp; <a href="#" class="permalink">Full article</a></p>
							<div class="entry">
								<!-- <p><?php  the_post_thumbnail(array(143,143,'class'=>'alignleft border')); ?></p> -->
								<p><?php   the_content(); ?></p>
								
							</div>
						</div>
						<?php
                            }
                        ?>
					</div>
					<!-- end #content -->
					<?php
                            get_sidebar();
                    ?>
					<div style="clear: both;">&nbsp;</div>
				</div>
			</div>
		</div>
		
<?php
    get_footer();
?>