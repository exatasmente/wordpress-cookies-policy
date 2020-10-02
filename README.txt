=== Cookies Policy ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: github.com/exatasmente
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Domain Cookies Policy plugin

== Description ==

This plugin is used to handle subdomain cookies policy.
Once the user accept the cookies policy in one website the plugin will handle the access in others.

the helper method allow_cookies() handles the cookies policy consent

Settings are in :  Settings -> Cookies

== Changelog ==

= 3.0 =
* Update Cookies Policy to handle cookies via JavaScript
* JsCookies dependency removed
* Plugin now handles when the cookies policy policy message injection fails via wp_footer
* Using Lax samesite policy -> CORS behavior not handled by the plugin
* Cookies policy now set cookies to domain, lp.sub.example.com, sub.example.com -> .example.com
* Cookies policy now set cookies path value as "/"


= 2.0.1 =
* Fix styles
* Added target _blank to cookies policy link


= 2.0.0 =
* Custom message content added
* Custom cookies link policy added
* Jquery html id tag error fixed


= 1.1.2 =
* Fix admin hooks load
* Remove unnecessary files and methods
* Fix allow cookies flow
* Fix cookie set after accept cookies policy

= 1.1.1 =
* Improve hooks load
* Remove unnecessary files and methods

= 1.0.1 =
* Fix js-cookie dependency

= 1.0.0 =
* First version
* Cookies domain field.
