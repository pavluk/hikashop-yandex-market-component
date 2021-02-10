<?php
/**
 * @package      Yandex.Market for HikaShop
 * @subpackage   com_yandexmarket
 * @author       Igor Inkovskiy
 * @copyright    Copyright (C) 2017 Igor Inkovskiy. All rights reserved.
 * @contact   https://shop.igor-i.ru, igor-i-shop@ya.ru
 * @license      Beerware
 */

// Запрет прямого доступа.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

// Загружаем тултипы.
HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.keepalive');
// Загружаем проверку формы и ещё какие-то украшательства
HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('formbehavior.chosen', 'select', null, array('disable_search_threshold' => 0));

// Стили
//HTMLHelper::stylesheet('media/com_yandexmarket/css/admin.min.css');

$input = Factory::getApplication()->input;
Factory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task) {
		if (task == "yml.cancel" || document.formvalidator.isValid(document.getElementById("adminForm"))) {
			Joomla.submitform(task, document.getElementById("adminForm"));
		}
	};
');
?>
<form action="<?php echo Route::_('index.php?option=com_yandexmarket&view=yml&layout=edit&id=' . (int) $this->item->id); ?>"
	  method="post"
	  name="adminForm"
	  id="adminForm"
	  class="form-validate yml">
	<div class="form-inline form-inline-header">
		<?php echo $this->form->renderField('name'); ?>
		<?php echo $this->form->renderField('yml_menuitem'); ?>
		<?php echo $this->form->renderField('yml_limit'); ?>
	</div>
	<div class="row-fluid">
		<div class="span9">
			<div class="form-horizontal">
				<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'yandex')); ?>
				<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'yandex', Text::_('COM_YANDEXMARKET_FIELDSET_YANDEX_SETTINGS_LABEL', true)); ?>
				<div>
					<?php echo $this->form->renderFieldset('yandex'); ?>
				</div>
				<?php echo HTMLHelper::_('bootstrap.endTab'); ?>
				<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'offers', Text::_('COM_YANDEXMARKET_YML_OFFERINGS_LABEL', true)); ?>
				<div>
					<?php echo $this->form->renderField('offers_settings'); ?>
				</div>
				<?php echo HTMLHelper::_('bootstrap.endTab'); ?>
				<?php echo HTMLHelper::_('bootstrap.endTabSet'); ?>
			</div>
		</div>

		<div class="span3">
			<?php
			// Set main fields.
			$this->fields = array(
				'published',
				'is_default'
			);
			?>
			<?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
		</div>
	</div>

	<input type="hidden" name="task" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
