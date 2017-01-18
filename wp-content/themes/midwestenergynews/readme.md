# Midwest Energy News

## Blockquotes

- Using a <cite>- First Lastname</cite> within a blockquote will add a source.

## Embed a newsletter sign up form in a post or page

Use the following shortcode to place a newsletter sign up form in the body of a post or page:

    [newsletter_signup]

If you want it to have a dark backround, add 'reverse' to the shortcode:

    [newsletter_signup reverse]

# Developer notes

This theme defines a custom action hook, `mwen_pre_largo_entry_content`, which is used to add the Mailchimp signup widget just before the content of the story. There is not an equivalent filter in largo, so if you choose to remove this theme's `partials/content-single-classic.php`, please add a filter in an equivalent location to Largo.

The 'reverse' tag in the shortcode applies the 'rev' class.

After Largo version 0.5.5 ships, remove partials/nav-main.php and this notice.

## Version history

- 0.1: initial build
- Cleanup for Largo 0.5.3
- Cleanup for Largo 0.5.4
- 0.1.1: Cleanup for compatibility with Southeast Energy News
