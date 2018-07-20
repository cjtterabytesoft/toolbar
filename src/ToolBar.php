<?php

/**
 * (c) CJT TERABYTE INC
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 *
 *        @link: https://gitlab.com/cjtterabytesoft/tadweb
 *      @author: Wilmer Arámbula <terabytefrelance@gmail.com>
 *   @copyright: (c) CJT TERABYTE INC
 *     @widgets: [ToolBar]
 *       @since: 1.0
 *         @yii: 3.0
 **/

namespace cjtterabytesoft\widgets;

use yii\base\Widget;
use yii\bootstrap4\ButtonDropdown;
use yii\helpers\Html;
use yii\helpers\Url;

class ToolBar extends Widget
{
	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_icon_panel = 'i';

	/**
	 * @var string the tag to use to render the button
	 */
	public $_label_icon_panel = '';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_icon_panel = ['class' => 'fas fa-th'];

	/**
	 * @var string the button label
	 */
	public $_title_panel = '';

	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_container_panel_header = 'div';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_container_panel_header = ['class' => 'peers bg-primary text-white align-content-center p-15'];

	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_left_panel_header = 'div';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_left_panel_header = ['class' => 'float-left'];

	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_rigth_panel_header = 'div';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_rigth_panel_header = ['class' => 'float-right ml-auto'];

	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_container_panel_button = 'div';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_container_panel_button = ['class' => 'peers bd p-15'];

	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_left_panel_button = 'div';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_left_panel_button = ['class' => 'float-left'];

	/**
	 * @var string the tag to use to render the button
	 */
	public $_tag_rigth_panel_button = 'div';

	/**
	 * @var array the tag to use to render the button
	 */
	public $_options_rigth_panel_button = ['class' => 'float-right ml-auto'];

	/**
	 * @var bool whether the label should be HTML-encoded.
	 */
	public $_encodeLabel = true;

	/**
	 * @var string the tag to use to render the button
	 */
	public $_panel_header_title = '';

	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();

		$iconpanel = $this->renderIcon();
		$titlepanel = $this->renderTitlePanel();
		$this->_panel_header_title = $iconpanel . '&nbsp' . '<b>' . $titlepanel . '</b>';
	  
		echo $this->renderPanelHeader() . $this->renderPanelBar();
	}

	private function renderIcon()
	{
		return Html::tag($this->_tag_icon_panel, $this->_label_icon_panel, $this->_options_icon_panel);
	}

	private function renderTitlePanel()
	{
		if (empty($this->_title_panel)) {
			$this->_title_panel =  \yii::t('toolbar', 'Gridview ToolBar');
		}

		return $this->_title_panel;
	}

	private function renderPanelHeader()
	{
		$panel_header = Html::begintag($this->_tag_container_panel_header, $this->_options_container_panel_header) .
							Html::begintag($this->_tag_left_panel_header, $this->_options_left_panel_header) .
								$this->_panel_header_title .
							Html::endTag($this->_tag_left_panel_header) .
							Html::begintag($this->_tag_rigth_panel_header, $this->_options_rigth_panel_header) .
								'{summary}' .
							Html::endTag($this->_tag_rigth_panel_header) .
						Html::endTag($this->_tag_container_panel_header);
		return $panel_header;
	}

	private function renderPanelBar()
	{
		$panel_button = Html::begintag($this->_tag_container_panel_button, $this->_options_container_panel_button) .
							Html::begintag($this->_tag_left_panel_button, $this->_options_left_panel_button) .
								$this->renderButtonPages() .
							Html::endTag($this->_tag_left_panel_button) .
							Html::begintag($this->_tag_rigth_panel_button, $this->_options_rigth_panel_button) .
								$this->renderButtonCreate() .
								$this->renderButtonFilter() .
								$this->renderButtonReset() .
							Html::endTag($this->_tag_rigth_panel_button) .
						Html::endTag($this->_tag_container_panel_button);
		return $panel_button;
	}

	private function renderButtonPages()
	{
		$button_pages = ButtonDropdown::widget([
							'buttonOptions' => ['class' => 'btn-sm btn-primary ai-c'],
							'label' => \yii::t('toolbar', 'Page Size'),
							'options' => ['class' => 'float-right'],
							'dropdown' => [
								'items' => [
									['label' => '1', 'url'  => Url::current(['index', 'page' => 1, 'pageSize' => '1'])],
									['label' => '5', 'url'  => Url::current(['index', 'page' => 1, 'pageSize' => '5'])],
									['label' => '10', 'url' => Url::current(['index', 'page' => 1, 'pageSize' => '10'])],
									['label' => '20', 'url' => Url::current(['index', 'page' => 1, 'pageSize' => '20'])],
									['label' => '25', 'url' => Url::current(['index', 'page' => 1, 'pageSize' => '25'])],
									['label' => '50', 'url' => Url::current(['index', 'page' => 1, 'pageSize' => '50'])],
								],
							],
						]);
		return $button_pages;
	}

	private function renderButtonCreate()
	{
		$button_create = Html::a(
			Html::tag('i', '', ['class' => 'fas fa-plus']),
			['create'],
			['class' => 'btn btn-lg bgc-green-500 c-white', 'title' => \yii::t('toolbar', 'Add')]
		);

		return $button_create;
	}

	private function renderButtonFilter()
	{
		$button_filter = Html::a(
			Html::tag('i', '', ['class' => 'fas fa-filter']),
			Url::current(),
			['id' => 'filter-checked-btn', 'class' => 'simple btn btn-lg bgc-blue-500 mL-2 c-white', 'title' => \yii::t('toolbar', 'Filter')]
		);

		return $button_filter;
	}

	private function renderButtonReset()
	{
		$button_reset = Html::a(
			Html::tag('i', '', ['class' => 'fas fa-sync-alt']),
			['index', [], []],
			['class' => 'btn btn-lg bgc-indigo-500 mL-2 c-white', 'title' => \yii::t('toolbar', 'Reset')]
		);

		return $button_reset;
	}
}