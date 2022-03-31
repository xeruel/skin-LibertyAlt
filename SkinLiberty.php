<?php
// @codingStandardsIgnoreLine
class SkinLibertyAlt extends SkinTemplate {
	// @codingStandardsIgnoreStart
	public $skinname = 'liberty';
	public $stylename = 'Liberty';
	public $template = 'LibertyTemplate';
	// @codingStandardsIgnoreEnd

	/**
	 * Page initialize.
	 *
	 * @param OutputPage $out OutputPage
	 */
	public function initPage( OutputPage $out ) {
		// @codingStandardsIgnoreLine
		global $wgSitename, $wgTwitterAccount, $wgLanguageCode, $wgNaverVerification, $wgLogo, $wgLibertyAltEnableLiveRC, $wgLibertyAltAdSetting, $wgLibertyAltAdGroup;

		$user = $this->getUser();
		/* uncomment if needs to use UserGroupManager
		$service = MediaWiki\MediaWikiServices::getInstance();
		$usergroupmanager = $service->getUserGroupManager();
		$userGroups = $usergroupmanager->getUserGroups($user);
		*/

		$optionMainColor = $user->getOption( 'liberty-color-main' );
		$optionSecondColor = $user->getOption( 'liberty-color-second' );

		$mainColor = $optionMainColor ? $optionMainColor : $GLOBALS['wgLibertyAltMainColor'];
		// @codingStandardsIgnoreLine
		$tempSecondColor = isset($GLOBALS['wgLibertyAltSecondColor']) ? $GLOBALS['wgLibertyAltSecondColor'] : '#' . strtoupper(dechex(hexdec(substr($mainColor, 1, 6)) - hexdec('1A1415')));
		$secondColor = $optionSecondColor ? $optionSecondColor : $tempSecondColor;
		$ogLogo = isset( $GLOBALS['wgLibertyAltOgLogo'] ) ? $GLOBALS['wgLibertyAltOgLogo'] : $wgLogo;
		if ( !preg_match( '/^((?:(?:http(?:s)?)?:)?\/\/(?:.{4,}))$/i', $ogLogo ) ) {
			$ogLogo = $GLOBALS['wgServer'] . $GLOBALS['wgLogo'];
		}

		$skin = $this->getSkin();

		parent::initPage( $out );

		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1, maximum-scale=1' );

		if (
			!class_exists( ArticleMetaDescription::class ) ||
			!class_exists( Description2::class )
		) {
			// The validator complains if there's more than one description,
			// so output this here only if none of the aforementioned SEO
			// extensions aren't installed
			$out->addMeta( 'description', strip_tags(
				preg_replace( '/<table[^>]*>([\s\S]*?)<\/table[^>]*>/', '', $out->mBodytext ),
				'<br>'
			) );
		}
		$out->addMeta( 'keywords', $wgSitename . ',' . $skin->getTitle() );

		/* 네이버 웹마스터 도구 */
		if ( isset( $wgNaverVerification ) ) {
			$out->addMeta( 'naver-site-verification', $wgNaverVerification );
		}

		/* IOS 기기 및 모바일 크롬에서의 웹앱 옵션 켜기 및 상단바 투명화 */
		$out->addMeta( 'apple-mobile-web-app-capable', 'No' );
		//$out->addMeta( 'apple-mobile-web-app-status-bar-style', 'black-translucent' );
		$out->addMeta( 'mobile-web-app-capable', 'No' );

		/* 모바일에서의 테마 컬러 적용 */
		// 크롬, 파이어폭스 OS, 오페라
		$out->addMeta( 'theme-color', $mainColor );
		// 윈도우 폰
		$out->addMeta( 'msapplication-navbutton-color', $mainColor );

		/* 트위터 카드 */
		$out->addMeta( 'twitter:card', 'summary' );
		if ( isset( $wgTwitterAccount ) ) {
			$out->addMeta( 'twitter:site', "@$wgTwitterAccount" );
			$out->addMeta( 'twitter:creator', "@$wgTwitterAccount" );
		}

		$modules = [
			'skins.liberty.bootstrap',
			'skins.liberty.layoutjs'
		];

		// Only load ad-related JS if ads are enabled in site configuration
		if ( isset( $wgLibertyAltAdSetting['client'] ) && $wgLibertyAltAdSetting['client'] ) {
			$modules[] = 'skins.liberty.ads';
		}

		// Only load LiveRC JS is we have enabled that feature in site config
		if ( $wgLibertyAltEnableLiveRC ) {
			$modules[] = 'skins.liberty.liverc';
		}

		// Only load modal login JS for anons, no point in loading it for logged-in
		// users since the modal HTML isn't even rendered for them.
		if ( $skin->getUser()->isAnon() ) {
			$modules[] = 'skins.liberty.loginjs';
		}

		$out->addModules( $modules );

		// @codingStandardsIgnoreStart
		$out->addInlineStyle(".LibertyAlt .nav-wrapper,
		.LibertyAlt .nav-wrapper .navbar .form-inline .btn:hover,
		.LibertyAlt .nav-wrapper .navbar .form-inline .btn:focus,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link.active::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link:hover::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link:focus::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link:active::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-footer .label,
		.LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools .tools-btn:hover,
		.LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools .tools-btn:focus,
		.LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools .tools-btn:active {
			background-color: $mainColor;
		}

		.LibertyAlt .nav-wrapper .navbar .form-inline .btn:hover,
		.LibertyAlt .nav-wrapper .navbar .form-inline .btn:focus {
			border-color: $secondColor;
		}

		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link.active::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link:hover::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link:focus::before,
		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link:active::before {
			border-bottom: 2px solid $mainColor;
		}

		.LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-footer .label:hover,
		.LibertyAlt .nav-wrapper .navbar .navbar-nav .nav-item .nav-link:hover,
		.LibertyAlt .nav-wrapper .navbar .navbar-nav .nav-item .nav-link:focus,
		.dropdown-menu .dropdown-item:hover {
			background-color: $secondColor;
		}


		.LibertyAlt .content-wrapper #liberty-bottombtn,
		.LibertyAlt .content-wrapper #liberty-bottombtn:hover {
			background-color: $mainColor;
		}");

		// layout settings 
		global $wgLibertyAltUserSidebarSettings;

		$LibertyAltUserWidthSettings = $user->getOption( 'liberty-layout-width' );
		$wgLibertyAltUserSidebarSettings = $user->getOption( 'liberty-layout-sidebar' );
		$LibertyAltUserNavbarSettings = $user->getOption( 'liberty-layout-navfix' );
		$LibertyAltUsercontrolbarSettings = $user->getOption( 'liberty-layout-controlbar' );


		if ( isset( $LibertyAltUserNavbarSettings ) && $LibertyAltUserNavbarSettings ) {
			$out->addInlineStyle(
				".navbar-fixed-top {
					position: absolute;
				}"
			);
		};

		if ( isset( $wgLibertyAltUserSidebarSettings ) && $wgLibertyAltUserSidebarSettings ) {
			$out->addInlineStyle(
				".LibertyAlt .content-wrapper .liberty-content {
					margin-right: 0;
				}"
			);
		};

		if ( $LibertyAltUserWidthSettings != null ) {
			$out->addInlineStyle(
				".LibertyAlt .content-wrapper {
					max-width: $LibertyAltUserWidthSettings;
				}

				.LibertyAlt .nav-wrapper .navbar {
					max-width: $LibertyAltUserWidthSettings;
				}"
			);
		}

		if ( isset($LibertyAltUsercontrolbarSettings ) && $LibertyAltUsercontrolbarSettings ) {
			$out->addInlineStyle(
				".LibertyAlt .content-wrapper #liberty-bottombtn {
					display: none;
				}"
			);
		};

		// 폰트 설정
		$LibertyAltUserFontSettings = $user->getOption('liberty-font');
		if ($LibertyAltUserFontSettings != null) {
			$out->addInlineStyle(
				"body, h1, h2, h3, h4, h5, h6, b {
					font-family: $LibertyAltUserFontSettings;
				}"
			);
		}

		// Ads setting
		$LibertyAltUserMoreArticleSettings = $user->getOption('liberty-layout-morearticle');
		if (isset($wgLibertyAltAdSetting['client']) && $wgLibertyAltAdSetting['client']) {
			// if user is login, reduce ads
			if ( isset($wgLibertyAltAdGroup) && $wgLibertyAltAdGroup == 'differ' && $user->isLoggedIn()) {
				$wgLibertyAltAdSetting['header'] == null;
				$wgLibertyAltAdSetting['footer'] == null;
				if ($user->isNewbie() == False) {
					$wgLibertyAltAdSetting['sidebar'] == null;
				}
				if (isset($LibertyAltUserMoreArticleSettings) && $LibertyAltUserMoreArticleSettings) {
					$wgLibertyAltAdSetting['belowarticle'] == null;
				}
			}
		}

		$LibertyAltDarkCss = "body, .LibertyAlt, .dropdown-menu, .dropdown-item, .LibertyAlt .nav-wrapper .navbar .form-inline .btn, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item .nav-link.active, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main table.wikitable tr > th, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main table.wikitable tr > td, table.mw_metadata th, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main table.infobox th, #preferences fieldset:not(.prefsection), #preferences div.mw-prefs-buttons, .navbox, .navbox-subgroup, .navbox > tbody > tr:nth-child(even) > .navbox-list {
			background-color: #000;
			color: #DDD;
		}

		.liberty-content-header, .liberty-footer, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-footer, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item, .LibertyAlt .content-wrapper .liberty-content .liberty-content-header, .LibertyAlt .content-wrapper .liberty-footer, .editOptions, html .wikiEditor-ui-toolbar, #pagehistory li.selected, .mw-datatable td, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main table.wikitable tr > td, table.mw_metadata td, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main table.wikitable, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main table.infobox, #preferences, .navbox-list, .dropdown-divider {
			background-color: #1F2023;
			color: #DDD;
		}

		.LibertyAlt .content-wrapper .liberty-content .liberty-content-main, .mw-datatable th, .mw-datatable tr:hover td, textarea, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-content, div.mw-warning-with-logexcerpt, div.mw-lag-warn-high, div.mw-cascadeprotectedwarning, div#mw-protect-cascadeon {
			background-color: #000;
		}

		.LibertyAlt .content-wrapper .liberty-content .liberty-content-header .title>h1, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-content .live-recent-list .recent-item, caption { color: #DDD; }

		.btn-secondary { background: transparent; color: #DDD; }

		#pagehistory li { border: 0; }

		.LibertyAlt .content-wrapper .liberty-footer, .LibertyAlt .content-wrapper .liberty-content .liberty-content-header, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-footer, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-content, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-header .nav .nav-item + .nav-item, .LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools .tools-btn:hover, .LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools .tools-btn:focus, .LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools .tools-btn, .dropdown-menu, .dropdown-divider, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main fieldset, hr, .LibertyAlt .content-wrapper .liberty-sidebar .live-recent-wrapper .live-recent .live-recent-content .live-recent-list li, .mw-changeslist-legend, .LibertyAlt .content-wrapper .liberty-content .liberty-content-header .content-tools { border-color: #555; }

		.flow-post, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main .toc .toctext { color: #DDD; }
		.flow-topic-titlebar { color: #000; }
		.flow-ui-navigationWidget { color: #FFF; }
		.LibertyAlt .content-wrapper .liberty-content .liberty-content-main .toccolours, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main .toc ul, .LibertyAlt .content-wrapper .liberty-content .liberty-content-main .toc li { background-color: #000; }
		.LibertyAlt .content-wrapper .liberty-content .liberty-content-main .toc .toctitle { background-color: #1F2023; }";
		$LibertyAltUserDarkSetting = $user->getOption('liberty-dark');;
		if ($LibertyAltUserDarkSetting === 'dark') {
			$out->addInlineStyle($LibertyAltDarkCss);
		} elseif ($LibertyAltUserDarkSetting === null) {
			$out->addInlineStyle($LibertyAltCss);
		}
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Setup skin CSS.
	 *
	 * @param OutputPage $out OutputPage
	 */
	public function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$out->addHeadItem(
			'font-awesome',
			// @codingStandardsIgnoreLine
			'<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.13.1/css/all.css" />'
		);

		$out->addHeadItem(
			'font-awesome-shims',
			// @codingStandardsIgnoreLine
			'<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.13.1/css/v4-shims.css" />'
		);

		$out->addHeadItem(
			'webfonts',
			// @codingStandardsIgnoreLine
			'<link href="https://fonts.googleapis.com/css?family=Dokdo|Gaegu|Nanum+Gothic|Nanum+Gothic+Coding|Nanum+Myeongjo|Noto+Serif+KR|Noto+Sans+KR&display=swap&subset=korean" rel="stylesheet">'
		);

		$out->addHeadItem(
			'share-api-polyfill',
			// @codingStandardsIgnoreLine
			'<script async src="https://unpkg.com/share-api-polyfill/dist/share-min.js"></script>'
		);
		$out->addModuleStyles( [ 'skins.liberty.styles' ] );
	}

	/**
	 * Set body class.
	 *
	 * @param OutputPage $out OutputPage
	 * @param array &$bodyAttrs Body attributes
	 */
	public function addToBodyAttributes( $out, &$bodyAttrs ) {
		$bodyAttrs['class'] .= ' Liberty width-size';
	}
}
