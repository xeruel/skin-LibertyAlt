# Liberty MediaWiki Skin

Default skin of [LibreWiki](https://librewiki.net)'s alternative form.

## Development

Our canonical source is [GitLab.com](https://gitlab.com/librewiki/Liberty-MW-Skin), and we receive bug reports via [GitLab.com](https://gitlab.com/librewiki/Liberty-MW-Skin/-/issues) and patches via GitLab.com only. Any source code found elsewhere is mirrored there, and developers do not guarantee about the code found elsewhere to work.

Security vulnerability should be reported using email (dev (골뱅이!) librewiki.net) (replace (Korean text) with @).

## Configurations
Please set these variables in the LocalSettings.php file.

| Name | Description | Example Variable | Default Variable |
| ---- | ---- | ---- | ---- |
| `$wgLibertyAltMainColor` | `theme-color` configurations, main color of site | `#4188F1` | `#4188F1` |
| `$wgLibertyAltSecondColor` | Configure of second color of site | `#2774DC` | The value of `$wgLibertyAltMainColor` subtracted by `1A1415` |
| `$wgAltTwitterAccount` | Default Twitter account to set a mention | `librewiki` | (none) |
| `$wgLibertyAltOgLogo` | OpenGraph Image Logo | `https://librewiki.net/images/6/6a/Libre_favicon.png` | (Value of `$wgLogo`) |
| `$wgAltNaverVerification` | Naver Webmater Tool Verification Code | (Value supplied by Naver.com) | (none) |
| `$wgLibertyAltAdSetting` | Google Adsense Settings | `array( 'client' => '(Value supplied by Google)', 'header' => '1234567890', 'right' => '0987654321' )` | (none) |
| `$wgLibertyAltEnableLiveRC` | Enables 'Recent Cahnges' on the right side | `true` | `true` |
| `$wgLibertyAltMaxRecent` | Recent X edits appearing in 'Recent Changes' | `10` | `10` |
| `$wgLibertyAltLiveRCArticleNamespaces` | Namespaces for the first tab in 'Recent Changes' | `[NS_MAIN, NS_PROJECT, NS_TEMPLATE, NS_HELP, NS_CATEGORY]` | `[NS_MAIN, NS_PROJECT, NS_TEMPLATE, NS_HELP, NS_CATEGORY]` |
| `$wgLibertyAltLiveRCTalkNamespaces` | Namespaces for the second tab in 'Recent Changes' | `[NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK, NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK]` | `[NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK, NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK]` |

## Navbar
Please fill out `MediaWiki:LibertyAlt-Navbar` article in the following format.

* First-Level menu:
  * `* icon=icon | display=display text | title=hover text | link=link | access=shortcut key | class=custom HTML classes | group=required user group | right=required user right`
* Second-Level menu:
  * `** icon=icon | display=display text | title=hover text | link=link | access=shortcut key | class=custom HTML classes | group=required user group | right=required user right`
* Third-Level menu:
  * `*** icon=icon | display=display text | title=hover text | link=link | access=shortcut key | class=custom HTML classes | group=required user group | right=required user right`
---
* All values are optional, but at least one of `icon` or `display` must be set.
* If `title` is not set, `display` is used instead.
* If you don't want to set some parameters, you can skip them. As an example, if you don't want to set an icon, skip `icon=...`.
* You can use i18n message names of MediaWiki for the values of `display` and `title` to show the i18n messages (e.g., write `recentchanges` to show `Recent changes`).
* Shortcut keys can be used as `Alt-Shift-(Key)`.
* When setting shortcuts, be careful not to overlap with the default shortcuts provided by MediaWiki.
* Custom classes are separated by `,` (e.g., write `classA, classB` to add `classA` and `classB` class).

You can see an example on [LibreWiki](https://librewiki.net/wiki/MediaWiki:Liberty-Navbar).
