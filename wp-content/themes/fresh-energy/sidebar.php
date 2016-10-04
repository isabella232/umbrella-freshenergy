<?php
// $consumer_key = 'sOsg7mUCsamwzbit15YEw';
// $consumer_secret = '0JL5gh6US8ZCnIkxOsP4bHGMo25XZT7xEKw0iqB8Bg';
// $access_token = '78075849-IZu17lDKA0DteCz1xTFjcl7bTqERklT2aJORGvter';
// $access_token_secret = '7Y5AU3MlwKlA3p3pvSOHDQq8f9sJjKAAnzuBgdEsqk';

// // setup the Twitter API connection
// Codebird::setConsumerKey($consumer_key, $consumer_secret);
// $cb = Codebird::getInstance();
// $cb->setToken($access_token, $access_token_secret);

// // can we pull from cache?
// if( get_transient('tweets') ){
//  	$tweets = get_transient('tweets');
// }else{
// 	$tweets = (array) $cb->statuses_userTimeline('&screen_name=council4econed&count=3&include_rts=false');
// 	set_transient('tweets', $tweets, 60*60*4 ); // Twitter's API has limits, let's cache results for a bit
// }
?>
				<aside id="sidebar">


					<?php if(is_single()) { ?>
					<section class="block related">
						<?php wp_related_posts(); ?>
					</section>
					<div class="divide">&nbsp;</div>
					<?php } ?>

					<section class="contribute">
						<?php
						$page = get_page_by_path('contribute');

						echo $page->post_content;
						?>
					</section>


					<?php if(!is_page('subscribe') && !is_page('thanks')) { ?>
					<div class="divide">&nbsp;</div>
					<section class="block newsletter">
						<h3>GET OUR EMAIL NEWSLETTER</h3>
						<p>Stay up to date with Fresh Energy, with news and info delivered directly to your inbox.</p>
							<a href="https://secure.fresh-energy.org/np/clients/freshenergy/account.jsp"><img src="/img/bttn-publication-signup.png" width="211" height="36" alt="" /></a>
					</section>
					<?php } ?>

					<div class="divide">&nbsp;</div>

					<section class="block events">
						<h3>UPCOMING EVENTS <a href="/tag/events">view all</a></h3>
						<?php
						query_posts("&tag=events&posts_per_page=1" );
						while (have_posts()) : the_post();
							$eventdate = get_post_meta($post->ID, 'event-date', true);
						?>
						<h4><a href="<?php the_permalink(); ?>" rel="permalink"><?php echo $eventdate ?></a></h4>
						<p><?php the_title(); ?></p>
						<?php endwhile; wp_reset_query(); ?>

					</section>

					<div class="divide">&nbsp;</div>

					<section id="twitter" class="block twitter">
						<h3>ON TWITTER  <a href="http://twitter.com/FreshEnergy">follow us</a></h3>
						<a class="twitter-timeline" href="https://twitter.com/freshenergy/fresh-energy" data-widget-id="432920891555450880" data-chrome="noheader noborders transparent">Tweets from https://twitter.com/freshenergy/fresh-energy</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php /*
						<ul class="tweets media-list">

							<?php foreach ($tweets as $tweet) {

								// the last item in the response is an HTTP status code
								// let's bypass it by only using tweet objects
								if( !is_object($tweet) ) continue;

								// human time, in lib/helper.php
								$ago = relative_time( $tweet->created_at );

								// makes stuff clickable, in lib/helper.php
								$text = add_links($tweet);
							?>
							<li class="tweet media">
								<a class="pull-left" href="http://twitter.com/<?php echo $tweet->user->screen_name?>" rel="nofollow"><img src="<?php echo $tweet->user->profile_image_url?>" alt="<?php echo $tweet->user->name?>" width="35" /></a>
								<div class="media-body">

									<div class="media-heading">
										<div class="pull-left tweet-author"><strong><?php echo $tweet->user->name ?></strong> <a href="http://twitter.com/<?php echo $tweet->user->screen_name?>" rel="nofollow">@<?php echo $tweet->user->screen_name?></a></div>
										<a href="https://twitter.com/<?php echo $tweet->user->screen_name ?>/status/<?php echo $tweet->id ?>" class="pull-right tweet-time"><?php echo $ago ?></a>
									</div>

									<?php echo $text ?>

									<div class="tweet-actions">
										<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
										<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id ?>"><i class="icon"></i>Reply</a>
										<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id ?>"><i class="icon"></i>Retweet</a>
										<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id ?>"><i class="icon"></i>Favorite</a>
									</div>

								</div>
							</li>

							<?php } ?>
						</ul>
*/ ?>
					</section>

					<div class="divide">&nbsp;</div>

					<section class="block partner">
						<img src="/img/logo-mwen.gif" width="277" height="35" alt="" />
						<p>Visit our partner site, <a href="http://www.midwestenergynews.com/" target="_blank">Midwest Energy News</a>.</p>
					</section>


				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

				<?php endif; ?>
				</aside>