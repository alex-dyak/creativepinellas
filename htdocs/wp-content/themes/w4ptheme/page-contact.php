<?php
/*
* Template Name: Contact Page
*/

get_header(); ?>

<section class="siteBody">

	<div class="row">
		<section class="medium-8 large-9 column siteContent siteContent--hasSidebar">
			<section class="row column">

				<article class="postPage">

					<!--    Post Content    -->
				</article>

			</section>

		</section>

		<aside class="medium-4 large-3 column siteSidebar">
			<div class="siteSidebar-inner">
				<!--    Sidebar widget  -->
				<div class="siteSidebar-item">
					<h3>Offices & Mailing Address</h3>
					<div class="siteSidebar-item-content">
						<p>
							Creative Pinellas <br> 8200 Bryan Dairy Road, Suite 200 <br> Largo, FL 33777
						</p>
						<p>
							<a href="tel:(727) 464-7261">(727) 464-7261</a>
						</p>
						<div class="siteSidebar-item-mapHolder">
							<!-- Map here width x height settings sets in plugin settings > formatting as width: 100%; height: 280px; -->
							<img src="images/map-thumb.jpg" alt="">
							<!-- TODO:remove this image when plugins map took it's place -->
						</div>
						<p><a href="#">Get Directions</a></p>
					</div>
				</div>

			</div>
		</aside>
	</div>

</section>

<?php get_footer(); ?>
