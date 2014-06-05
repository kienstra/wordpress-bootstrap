=== Bootstrap Instant Editor ===
Contributors: ryankienstra
Donate link: http://www.jdrf.com
Tags: bootstrap, wysiwyg, live editor, instant editor
Requires at least: 3.4
Tested up to: 3.9.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


See your full front page as you edit, with instant updates. Select any image, resize it, and enter text. 

== Description ==

Using Bootstrap, this generates a jumbotron and a row of 2, 3, or 4 columns. They're automatically added to your front page, but you can change the placement with shortcode.

You'll get instant feedback, but it won't be published until you click "Save Changes."

All images and text will be centered, and images can be resized.

Click "Customize Your Theme," and find the "Top Jumbotron" and "Panels" listed on the left. Edit them, and watch your front page update.

Requires Bootstrap 3. If you don't have it, indicate this on the plugin settings page. It will be added your front page. This will change your style completely, though.

Your "Reading Settings" must have "Front Page Displays" set to "Static Page."

Please report bugs or request features at ryankienstra.com/contact

A few notes about the sections above:

*   "Contributors" is a comma separated list of wp.org/wp-plugins.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.

== Installation ==

This section describes how to install the plugin and get it working.
1. Upload the bootstrap-instant-editor directory to your /wp-content/plugins directory
2. Activate it in the 'Plugins' menu
3. Use it by going to "Reading Settings" and clicking "Customize Your Theme." Or visit the settings in the plugin settings section.
5. If this doesn't work, be sure your "Reading Settings" have "Front Page Displays" set to "Static Page."

== Frequently Asked Questions ==

= Will this work if I don't have Bootstrap 3? =
Only if you have no stylesheets. Go to the settings page and indicate that you don't have Bootstrap. A stylesheet will be added for you.

= Can I keep my own front page content? =
Yes, go to this plugin's settings page and select "shortcodes." But this plugin generates a jumbotron and a row, which look best at top of the page. It won't interfere with your top navbar, though. If you would like more settings, please contact me.

= Does this work with .svg images? =
No, but I would like to add support for them.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* First version

== Upgrade Notice ==
N/A, this is version 1.0.0

== Arbitrary section ==

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
