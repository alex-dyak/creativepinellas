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
					<!--    Post title  -->
					<h1 class="postPage-title">H1 Contact Page</h1>

					<!--    Post Content    -->
					<div class="postPage-content">

						<div class="intro">
							<p>Intro p is 1.5em/1.25em and is colored using #04b4c3 to help it stand out.&nbsp;Intro p is 1.5em/1.25em and is colored using #04b4c3 to help it stand out.</p>
						</div>

						<div class="contactForm">
							<form action="#">
								<!-- TODO: default wp Contact7 form error and success message, replase only text -->
								<div class="wpcf7-response-output wpcf7-display-none wpcf7-validation-errors" role="alert" style="display: block;">There was a problem with your submission. Errors are highlighter below</div>

								<div class="wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok" style="display: block;" role="alert">Thank you for your message. It has been sent.</div>
								<!-- TODO: end -->

								<div class="large-5">
									<label for="name_field">Name *</label>
									<!--    TODO: span will be generated automaticly with Form7-->
                                                    <span class="wpcf7-form-control-wrap">
                                    <input type="text" name="name_field" id="name_field" class="wpcf7-not-valid">
                                    <!--    TODO: error messages is default from Form7 -->
                                    <span role="alert" class="wpcf7-not-valid-tip">The field is required.</span>
                                                    </span>
								</div>
								<div class="large-5">
									<label for="email_field">Email *</label>
                                                    <span class="wpcf7-form-control-wrap">
                                    <input type="email" name="email_field" id="email_field">
                                </span>
								</div>
								<div class="large-5">
									<label for="org_field">Organization</label>
                                                    <span class="wpcf7-form-control-wrap">
                                    <input type="text" name="org_field" id="org_field">
                                </span>
								</div>
								<div class="large-5">
									<label for="person_select">I am a(n)</label>
                                                    <span class="wpcf7-form-control-wrap">
                                    <select id="person_select" name="person_select">
	                                    <option value="Artist">Artist</option>
	                                    <option value="Art Lover">Art Lover</option>
	                                    <option value="Member of Media">Member of Media</option>
	                                    <option value="Other">Other</option>
                                    </select>
                                </span>
								</div>
								<div class="small-12">
									<label for="org_field">Message *</label>
                                                    <span class="wpcf7-form-control-wrap">
                                    <textarea></textarea>
                                </span>
								</div>
								<div class="small-12">
									<div class="form-row">
										<input type="submit" value="Submit" class="btn btn-middleWidth btn--ocean">
									</div>
								</div>
							</form>
						</div>


					</div>
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
