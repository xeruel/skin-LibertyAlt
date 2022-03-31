<?php //phpcs:ignore
class LibertyAltHooks extends Hooks {
	/**
	 * Preference
	 * @param User $user user
	 * @param Preferences &$preferences preferences
	 */
	public static function onGetPreferences( $user, &$preferences ) {
		global $wgLibertyAltAdSetting, $wgLibertyAltAdGroup;
		$service = MediaWiki\MediaWikiServices::getInstance();
		$usergroupemanager = $service->getUserGroupManager();
		$userGroups = $usergroupemanager->getUserGroups( $user );

		$preferences['libertyalt-layout-width'] = [
			'type' => 'select',
			'label-message' => 'libertyalt-pref-layout-width',
			'section' => 'libertyalt/layout',
			'options' => [
				wfMessage( 'libertyalt-layout-select-1000' )->text() => '1000px',
				wfMessage( 'libertyalt-layout-select-1100' )->text() => '1100px',
				wfMessage( 'libertyalt-layout-select-1200' )->text() => null,
				wfMessage( 'libertyalt-layout-select-1300' )->text() => '1300px',
				wfMessage( 'libertyalt-layout-select-1400' )->text() => '1400px',
				wfMessage( 'libertyalt-layout-select-1500' )->text() => '1500px',
				wfMessage( 'libertyalt-layout-select-1600' )->text() => '1600px',
			],
			'help-message' => 'libertyalt-pref-layout-width-help',
			'default' => null
		];

		$preferences['libertyalt-layout-navfix'] = [
			'type' => 'toggle',
			'label-message' => 'libertyalt-pref-layout-navfix',
			'section' => 'libertyalt/layout',
		];

		$preferences['libertyalt-layout-sidebar'] = [
			'type' => 'toggle',
			'label-message' => 'libertyalt-pref-layout-sidebar',
			'section' => 'libertyalt/layout',
		];

		$preferences['libertyalt-layout-controlbar'] = [
			'type' => 'toggle',
			'label-message' => 'libertyalt-pref-layout-controlbar',
			'section' => 'libertyalt/layout',
		];

		if ( isset( $wgLibertyAltAdSetting['below'] ) && $wgLibertyAltAdSetting['below']
		&& isset( $wgLibertyAltAdGroup ) && $wgLibertyAltAdGroup == 'differ' && in_array( 'sysop', $userGroups ) ) {
			$preferences['libertyalt-layout-morearticle'] = [
				'type' => 'toggle',
				'label-message' => 'libertyalt-pref-layout-morearticle',
				'section' => 'libertyalt/layout',
			];
		}

		$preferences['libertyalt-color-main'] = [
			'type' => 'text',
			'label-message' => 'libertyalt-pref-color-main',
			'section' => 'libertyalt/color',
			'help-message' => 'libertyalt-pref-color-main-help'
		];

		$preferences['libertyalt-color-second'] = [
			'type' => 'text',
			'label-message' => 'libertyalt-pref-color-second',
			'section' => 'libertyalt/color',
			'help-message' => 'libertyalt-pref-color-second-help'
		];

		$preferences['libertyalt-font'] = [
			'type' => 'selectorother',
			'label-message' => 'libertyalt-pref-fonts',
			'section' => 'libertyalt/font',
			'options' => [
				wfMessage( 'libertyalt-font-name-default' )->text() => null,
				wfMessage( 'libertyalt-font-name-noto-sans-kr' )->text() => 'Noto Sans KR',
				wfMessage( 'libertyalt-font-name-noto-serif-kr' )->text() => 'Noto Serif KR',
				wfMessage( 'libertyalt-font-name-spoqa-han-sans' )->text() => 'Spoqa Han Sans',
				wfMessage( 'libertyalt-font-name-nanum-gothic' )->text() => 'Nanum Gothic',
				wfMessage( 'libertyalt-font-name-nanum-myeongjo' )->text() => 'Nanum Myeongjo',
				wfMessage( 'libertyalt-font-name-dokdo' )->text() => 'Dokdo',
				wfMessage( 'libertyalt-font-name-gaegu' )->text() => 'Gaegu',
				wfMessage( 'libertyalt-font-name-hankc' )->text() => 'Hankc',
				wfMessage( 'libertyalt-font-name-youth' )->text() => 'Youth',
				wfMessage( 'libertyalt-font-name-malgun-gothic' )->text() => 'Malgun Gothic'
			],
			'help-message' => 'libertyalt-pref-fonts-help',
			'default' => null,
		];

		$preferences['libertyalt-dark'] = [
			'type' => 'select',
			'label-message' => 'libertyalt-pref-dark',
			'section' => 'libertyalt/color',
			'options' => [
				wfMessage( 'libertyalt-dark-default' )->text() => null,
				wfMessage( 'libertyalt-dark-dark' )->text() => 'dark',
				wfMessage( 'libertyalt-dark-light' )->text() => 'light'
			],
			'help-message' => 'libertyalt-pref-dark-help',
			'default' => null
		];
	}
}
