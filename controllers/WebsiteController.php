<?php

class WebsiteController extends WebBaseController
{
	public function actionSettings() {
		$model = new Website('settings');
		$model->setAttributes(Yii::app()->setting->get('Website'));
		if (isset($_POST['Website'])) {
			$model->setAttributes($_POST['Website']);
			if ($model->validate()){
				Yii::app()->setting->set('Website', $_POST['Website']);
				Yii::app()->setting->commit();
			}
		} 
		$this->render('settingsWebsite', array('model' => $model));
	}
	/**
	 * List available themes
	 */
	public function actionIndex()
	{
		$this->render('indexWebsite', array('themes' => Website::themeOptions()));
	}
	/**
	 * View detail information for a theme
	 */
	public function actionView()
	{
		if (isset($_GET['theme'])) Yii::app()->theme = $_GET['theme'];
		$this->render('viewWebsite');
	}
}
