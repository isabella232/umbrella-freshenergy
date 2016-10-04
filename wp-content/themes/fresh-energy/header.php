<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Blog" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Blog" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Blog" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Blog" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Blog" lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(' | ', true, 'right') ?> <?php bloginfo('name') ?></title>
	<meta charset="utf-8" />
	<meta name="author" content="electricpulp.com" />
	<link rel="alternate" href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed" type="application/rss+xml" />
	<link rel="stylesheet" href="/css/screen.css?v=4">
	<script src="/js/modernizr-1.7.min.js"></script>
	<script src="/js/jquery-1.5.1.min.js"></script>
	<script src="/js/jquery.carouFredSel-4.1.0-packed.js" type="text/javascript"></script>
	<script src="/js/jquery.tweet.js" type="text/javascript"></script>
	<script src="/js/site.js" type="text/javascript"></script>
	<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST'] ?>/img/fb-logo.png"/>
	<?php
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	wp_head(); ?>
	<script type="text/javascript">
	//<![CDATA[
		$(function() {
			$('#twitter').tweet({
				username: ['Complete_StsMN', 'CleanEnergyErin', 'NobleIdeas', 'FreshEnergy', 'MWEnergyNews'],
				avatar_size: false,
				count: 4
			});
		});
	//]]>
	</script>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-852723-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
</head>
<body>
	<div id="container">
		<header id="header">
			<?php if(is_front_page()) { ?>
				<h1 id="logo">Fresh Energy, Leading the Transition to Clean Energy</h1>
			<?php } else { ?>
				<a href="/" id="logo">Fresh Energy, Leading the Transition to Clean Energy</a>
			<?php } ?>
				<div class="tagline">Practical policy. Brighter future.</div>
				<div class="search">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" >
						<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="keywords" placeholder="keyword search" />
					</form>
				</div>
		</header>

		<div id="main" role="main" class="clearfix">
			<nav id="primary-nav">
				<ul>
					<?php
						$page = get_page_by_path('about');
						$current_page = false;
						if(is_page('about')||in_array($page->ID, get_post_ancestors($post->ID))) {
							$current_page = true;
						}
					?>
					<li>
						<a href="/about" class="<?php echo ($current_page)?'here':'' ?>"><span>About<span class="pointer">&nbsp;</span></span></a>
						<ul><?php
						$args = array(
							'child_of' => $page->ID,
							'depth' => 1,
							'title_li' => false,
						);
						wp_list_pages($args);
						?></ul>
					</li>
					<?php
						$page = get_page_by_path('subscribe');
						$current_page = false;
						if(is_page('contact')||in_array($page->ID, get_post_ancestors($post->ID))) {
							$current_page = true;
						}
					?>
					<li>
						<a href="https://secure.fresh-energy.org/np/clients/freshenergy/account.jsp" class="<?php echo ($current_page)?'here':'' ?>"><span>Subscribe<span class="pointer">&nbsp;</span></span></a>
						<?php /*<ul><?php
						$args = array(
							'child_of' => $page->ID,
							'depth' => 1,
							'title_li' => false,
						);
						wp_list_pages($args);
						?></ul>*/ ?>
					</li>
					<li><a href="/category/take-action" class="<?php echo (is_category('take-action'))?'here':'' ?>"><span>Take Action<span class="pointer">&nbsp;</span></span></a></li>
					<?php
						$cat_ID = get_query_var('cat');
						$current_cat = false;
						if(is_category('issues')||cat_is_ancestor_of(get_category_by_slug('issues'), $cat_ID )) {
							$current_cat = true;
						}
					?>
					<li>
						<a href="/category/issues" class="<?php echo ($current_cat)?'here':'' ?>"><span>Issues<span class="pointer">&nbsp;</span></span></a>
						<ul><?php
						$cat = get_category_by_slug('issues');
						$args = array(
							'child_of' => $cat->term_id,
							'depth' => 1,
							'title_li' => false,
							'show_option_none' => false
						);
						wp_list_categories($args);
						?></ul>
					</li>
					<?php
						$page = get_page_by_path('media-relations');
						$current_page = false;
						if(is_page('media-relations')||in_array($page->ID, get_post_ancestors($post->ID))) {
							$current_page = true;
						}
					?>
					<li>
						<a href="/media-relations" class="<?php echo ($current_page)?'here':'' ?>"><span>Media<span class="pointer">&nbsp;</span></span></a>
						<ul><?php
						$args = array(
							'child_of' => $page->ID,
							'depth' => 1,
							'title_li' => false,
						);
						wp_list_pages($args);
						?></ul>
					</li>
					<?php
						$page = get_page_by_path('join-donate');
						$current_page = false;
						if(is_page('join-donate')||in_array($page->ID, get_post_ancestors($post->ID))) {
							$current_page = true;
						}
					?>
					<li>
						<a href="/join-donate" class="<?php echo ($current_page)?'here':'' ?>"><span>JOIN/DONATE<span class="pointer">&nbsp;</span></span></a>
						<ul><?php
						$args = array(
							'child_of' => $page->ID,
							'depth' => 1,
							'title_li' => false,
						);
						wp_list_pages($args);
						?></ul>
					</li>
					<li class="last">
						<a href="/category/publications" class="<?php echo (is_category('publications'))?'here':'' ?>"><span>Publications<span class="pointer">&nbsp;</span></span></a>
						<?php
						/*<ul><?php
						$cat = get_category_by_slug('publications');
						$args = array(
							'child_of' => $cat->term_id,
							'hide_empty' => false,
							'depth' => 1,
							'title_li' => false,
							'show_option_none' => false
						);
						wp_list_categories($args);
						?></ul>
						*/
						?>
					</li>
				</ul>

				<ul class="social">
					<li><a href="http://www.facebook.com/freshenergytoday" class="facebook" target="_blank">Facebook</a></li>
					<li><a href="http://twitter.com/#!/freshenergy" class="twitter" target="_blank">Twitter</a></li>
					<li><a href="http://pinterest.com/freshenergy/" class="pinterest" target="_blank">Pinterest</a></li>
				</ul>
			</nav>
			<?php


			?>
			<?php if(!is_front_page()) { ?>
				<?php
				if(is_category()) {
					$cat_ID = get_query_var('cat');
					if(cat_is_ancestor_of(get_category_by_slug('energy-matters'),$cat_ID) || is_category('energy-matters')) {
						$pub_content = '
						<h2>ENERGY MATTERS</h2>
						<h3>A QUARTERLY PUBLICATION OF FRESH ENERGY</h3>
						';
						$pub_content .= '<div class="issue-meta">
							<div class="date">'.single_cat_title('',false).'</div>
						</div>';
						$class = 'publication-header energy-matters';
					}
					if(cat_is_ancestor_of(get_category_by_slug('powering-progress'),$cat_ID) || is_category('powering-progress')) {
						if (function_exists('get_terms_meta')) {
						    $issue_number = get_terms_meta($cat_ID, 'category-volume-number');
						$issue_text = get_terms_meta($cat_ID, 'category-issue-text');
						}
						$pub_content = '
						<h2>Powering Progress</h2>
						<h3>A MONTHLY PUBLICATION OF FRESH ENERGY</h3>
						';
						$pub_content .= '<div class="issue-meta">
							<div class="date">'.single_cat_title('',false).'</div>
						</div>';
						$class = 'publication-header powering-progress';
					}
				}
				?>

				<?php
				if(empty($class)) {
					$headers = array();
					if ($handle = opendir($_SERVER['DOCUMENT_ROOT'].'/img/headers/')) {
						/* This is the correct way to loop over the directory. */
						while (false !== ($file = readdir($handle))) {
							if (preg_match('/\.jpg/',$file)) {
								$headers[] = $file;
							}
						}
						closedir($handle);
					}

					$pick = mt_rand(0,count($headers)-1);
					$headerimg = 'background-image:url(/img/headers/'.$headers[$pick].');';

				}
				?>

				<section id="heading" class="<?php echo $class ?>" style="<?php echo (empty($class))?$headerimg:'' ?>">
					<?php if(!empty($pub_content)) { ?>
						<?php echo $pub_content; ?>
					<?php } else { ?>
						<?php if(is_page()) { ?>
							<h2><?php the_title() ?></h2>
						<?php } elseif (cat_is_ancestor_of(get_category_by_slug('issues'),$cat_ID)) { ?>
							<h2>Issues</h2>
						<?php } elseif(is_category()) { ?>
							<h2><?php echo single_cat_title(); ?></h2>
						<?php } elseif(is_single() && in_category('issues')) { ?>
							<h2>Issues</h2>
						<?php } elseif(is_single() && in_category('take-action')) { ?>
							<h2>Take Action</h2>
						<?php } elseif(is_tag()) { ?>
							<h2><?php echo single_tag_title() ?></h2>
						<?php } ?>
					<?php } ?>
				</section>
			<?php } ?>

