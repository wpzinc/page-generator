<?php
namespace Helper;

use \Facebook\WebDriver\WebDriverElement;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
	/**
	 * Helper method to assert that there are non PHP errors, warnings or notices output
	 * 
	 * @since 	1.9.6
	 */
	public function checkNoWarningsAndNoticesOnScreen($I)
	{
		// Check that no Xdebug errors exist.
		$I->dontSeeElement('.xdebug-error');
		$I->dontSeeElement('.xe-notice');
	}

	/**
	 * Helper method to enter text into a jQuery Select2 Field, selecting the option that appears.
	 * 
	 * @since 	1.9.6.4
	 * 
	 * @param 	AcceptanceTester 	$I
	 * @param 	string 				$container 	Field CSS Class / ID
	 * @param 	string 				$value 		Field Value
	 * @param 	string 				$ariaAttributeName 	Aria Attribute Name (aria-controls|aria-owns)
	 */
	public function fillSelect2Field($I, $container, $value, $ariaAttributeName = 'aria-controls')
	{
		$fieldID = $I->grabAttributeFrom($container, 'id');
		$fieldName = str_replace('-container', '', str_replace('select2-', '', $fieldID));
		$I->click('#'.$fieldID);
		$I->waitForElementVisible('.select2-search__field[' . $ariaAttributeName . '="select2-' . $fieldName . '-results"]');
		$I->fillField('.select2-search__field[' . $ariaAttributeName . '="select2-' . $fieldName . '-results"]', $value);
		$I->waitForElementVisible('ul#select2-' . $fieldName . '-results li.select2-results__option--highlighted');
		$I->pressKey('.select2-search__field[' . $ariaAttributeName . '="select2-' . $fieldName . '-results"]', \Facebook\WebDriver\WebDriverKeys::ENTER);
	}

	/**
	 * Helper method to close the Gutenberg "Welcome to the block editor" dialog, which
	 * might show for each Page/Post test performed due to there being no persistence
	 * remembering that the user dismissed the dialog.
	 * 
	 * @since 	1.9.6
	 */
	public function maybeCloseGutenbergWelcomeModal($I)
	{
		try {
			$I->performOn('.components-modal__screen-overlay', [
				'click' => '.components-modal__screen-overlay .components-modal__header button.components-button'
			], 3);
		} catch ( \Facebook\WebDriver\Exception\TimeoutException $e ) {
		}
	}

	/**
	 * Helper method to activate the Plugin.
	 * 
	 * @since 	1.9.6
	 */
	public function activateWPToBufferPlugin($I)
	{
		// Login as the Administrator
		$I->loginAsAdmin();

		// Go to the Plugins screen in the WordPress Administration interface.
		$I->amOnPluginsPage();

		// Activate the Plugin.
		$I->activatePlugin('page-generator-pro');

		// Check that the Plugin activated successfully.
		$I->seePluginActivated('page-generator-pro');

		// Check that no PHP warnings or notices were output.
		$I->checkNoWarningsAndNoticesOnScreen($I);
	}

	/**
	 * Helper method to deactivate the Plugin.
	 * 
	 * @since 	1.9.6
	 */
	public function deactivateWPToBufferPlugin($I)
	{
		// Login as the Administrator
		$I->loginAsAdmin();

		// Go to the Plugins screen in the WordPress Administration interface.
		$I->amOnPluginsPage();

		// Deactivate the Plugin.
		$I->deactivatePlugin('page-generator-pro');

		// Check that the Plugin deactivated successfully.
		$I->seePluginDeactivated('page-generator-pro');

		// Check that no PHP warnings or notices were output.
		$I->checkNoWarningsAndNoticesOnScreen($I);
	}
}
