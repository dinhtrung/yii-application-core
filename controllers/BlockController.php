<?php

class BlockController extends WebBaseController
{
	/**
	 * Manage all available block
	 */
	public function actionIndex(){
		$model = new Block('search');
		$this->render('adminBlock', array('model' => $model));
	}
	/**
	 * Details for existing block
	 */
	public function actionView(){
		$model = $this->loadModel('Block');
		$this->render('viewBlock', array('model' => $model));
	}
	/**
	 * Create a new block
	 */
	public function actionCreate(){
		$model = new Block('insert');
		$this->performAjaxValidation($model, 'block-form');
		if (isset($_POST['Block'])){
			$model->setAttributes($_POST['Block']);
			if ($model->save()){
				Yii::app()->user->setFlash('success', Yii::t('core', 'Successfully create block :title', array(':title' => $model->title)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('createBlock', array('model' => $model));
	}
	/**
	 * Update existing block
	 */
	public function actionUpdate(){
		$model = $this->loadModel('Block');
		$this->performAjaxValidation($model, 'block-form');
		if (isset($_POST['Block'])){
			$model->setAttributes($_POST['Block']);
			if ($model->save()){
				Yii::app()->user->setFlash('success', Yii::t('core', 'Successfully update block :title', array(':title' => $model->title)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('updateBlock', array('model' => $model));
	}
	/**
	 * Duplicate existing block
	 */
	public function actionDuplicate(){
		$model = $this->loadModel('Block');
		$model->setScenario('insert');
		$model->setIsNewRecord(TRUE);
		$this->performAjaxValidation($model, 'block-form');
		if (isset($_POST['Block'])){
			$model->setAttributes($_POST['Block']);
			if ($model->save()){
				Yii::app()->user->setFlash('success', Yii::t('core', 'Successfully update block :title', array(':title' => $model->title)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('createBlock', array('model' => $model));
	}
	/**
	 * Update existing block
	 */
	public function actionDelete(){
		$model = $this->loadModel('Block');
		if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest && $model->delete()){
			$this->redirect(array('admin'));
		} else throw new CHttpException(404, Yii::t('app', 'Page not found'));
	}
	/**
	 * Assign a block to one or many themes available to the system
	 */
	public function actionTheme()
	{
		$model = $this->loadModel();
		$item = Blocktheme::model()->findAllByAttributes(array("block" => $model->bid));
		foreach ($item as $k => $v){
			$item[$v->theme] = $v;
			unset($item[$k]);
		}
		foreach (Website::themeOptions() as $theme => $name) {
			if (empty($item[$theme])) {
				$item[$theme] = new Blocktheme();
			}
		}
		if (isset($_POST["Blocktheme"])){
			foreach ($_POST["Blocktheme"] as $theme => $data){
				$item[$theme]->setAttributes($data);
				$item[$theme]->block = $model->bid;
				$item[$theme]->theme = $theme;
				if ($item[$theme]->save()){
					Yii::app()->getUser()->setFlash("success", "Data saved.");
				} elseif (! $item[$theme]->getIsNewRecord()){
					$item[$theme]->delete();
				}
			}
			$this->redirect(Yii::app()->getUser()->getReturnUrl());
		}
		$this->render('themeBlock',array( 'model'=>$model, 'item' => $item));
	}

	/**
	 * Preview Blocks in their position
	 * TODO: Add drag and drop support
	 */
	function actionPreview() {
		$model = Blocktheme::model()->with("owner")->findAllByAttributes(array("theme" => Yii::app()->setting->get("Website", "theme")));
		$this->render("previewBlock", array("model" => $model), FALSE, FALSE);
	}

	/**
	 * Sort the blocks in current themes
	 */
	function actionSort() {
		// Handle the POST request data submission
		if (Yii::app()->request->isPostRequest && isset($_POST['Order']))
		{
			// Since we converted the Javascript array to a string,
			// convert the string back to a PHP array
			$models = explode(',', $_POST['Order']);

			for ($i = 0; $i < sizeof($models); $i++)
			{
				if ($model = Blocktheme::model()->findbyPk($models[$i])) {
					$model->weight = $i;
					$model->save();
				}
			}
			echo "<div class='flash-success'>";
			echo Yii::t('core', 'Sucessfully update order.');
			echo "</div>";
			Yii::app()->end();
		} else {
			$model = Blocktheme::model()->with("owner")->findAllByAttributes(array("theme" => Yii::app()->setting->get("Website", "theme")));
			$this->render("sortBlock", array('model' => $model), FALSE, FALSE);
		}
	}

	/**
	* Copy existing item to a new one
	**/
	public function actionConfigure(){
		$model = $this->loadModel();
		if (! $model->blocktype->component) throw new CHttpException(200, Yii::t('core', "The block :block has no configuration.", array(':block' => CHtml::encode($model->blocktype->title))));
		$component = Yii::import($model->blocktype->component);
		if(!empty($_POST[$component])) {
			$model->option = $_POST[$component];
			if($model->save()) {
     			$this->redirect(Yii::app()->getUser()->getReturnUrl());
			}
		}
		// Check to see if this component exists;
		$callback = $model->blocktype->callback . 'Config';
		$config = call_user_func(array($component, $callback));
		$config['title'] = Yii::t('core', "Configuration for block :block", array(":block" => $model->title));
		$config['showErrorSummary'] = TRUE;
		$config['buttons'] = array(
				'submit' => array(
				'type' => 'submit',
				'value' => Yii::t('core', 'Save'))
		);
		$component = new $component("block");
		$component->setAttributes($model->option, FALSE);
		$form = new CForm($config, $component);
		$this->render('configBlock', array('form'=>$form, 'model' => $model));
	}
}
