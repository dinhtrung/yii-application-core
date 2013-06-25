<?php

class BlocktypeController extends WebBaseController
{
	/**
	 * Manage all available block
	 */
	public function actionIndex(){
		$model = new BlockType('search');
		$this->render('adminBlockType', array('model' => $model));
	}
	/**
	 * Details for existing block type
	 */
	public function actionView(){
		$model = $this->loadModel('BlockType');
		$this->render('viewBlockType', array('model' => $model));
	}
	/**
	 * Create a new block type
	 */
	public function actionCreate(){
		$model = new BlockType('insert');
		$this->performAjaxValidation($model, 'block-form');
		if (isset($_POST['BlockType'])){
			$model->setAttributes($_POST['BlockType']);
			if ($model->save()){
				Yii::app()->user->setFlash('success', Yii::t('core', 'Successfully create block :title', array(':title' => $model->title)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('createBlockType', array('model' => $model));
	}
	/**
	 * Update existing block type
	 */
	public function actionUpdate(){
		$model = $this->loadModel('BlockType');
		$this->performAjaxValidation($model, 'block-type-form');
		if (isset($_POST['BlockType'])){
			$model->setAttributes($_POST['BlockType']);
			if ($model->save()){
				Yii::app()->user->setFlash('success', Yii::t('core', 'Successfully update block :title', array(':title' => $model->title)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('updateBlockType', array('model' => $model));
	}
	/**
	 * Duplicate existing block type
	 */
	public function actionDuplicate(){
		$model = $this->loadModel('BlockType');
		$model->setScenario('insert');
		$model->setIsNewRecord(TRUE);
		$this->performAjaxValidation($model, 'block-type-form');
		if (isset($_POST['BlockType'])){
			$model->setAttributes($_POST['BlockType']);
			if ($model->save()){
				Yii::app()->user->setFlash('success', Yii::t('core', 'Successfully update block :title', array(':title' => $model->title)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('createBlockType', array('model' => $model));
	}
	/**
	 * Delete existing block type
	 */
	public function actionDelete(){
		$model = $this->loadModel('BlockType');
		if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest && $model->delete()){
			$this->redirect(array('admin'));
		} else throw new CHttpException(404, Yii::t('app', 'Page not found'));
	}
	/**
	 * Import block config from module blocktypes configuration....
	 * @TODO: Test if using exists Framework CConfiguration is okay?
	public function actionImport(){
		$modules = Yii::app()->getModules();
		foreach ($modules as $moduleId => $moduleConfig){
			$alias = "$moduleId.data.blocktype";
			if (! file_exists(Yii::getPathOfAlias($alias) . '.php')) continue;
			$config = new BlocktypeConfig('search', $alias);
			foreach ($config->findAll() as $blocktype){
				$blocktypeModel = new BlockType();
				$blocktypeModel->setAttributes($blocktype->getAttributes());
				if ($blocktypeModel->save()){
					echo Yii::t('core', "Successfully install blocktype :title", array(':title' => $blocktypeModel->title));
				} else {
					echo CVarDumper::dumpAsString($blocktypeModel->getErrors(), 10, TRUE);
				}
			}
		}
	}*/
	/**
	 * Scan block types from modules configuration files
	 
	public function actionExport(){
		$blocktype = BlockType::model()->findAll();
		foreach ($blocktype as $mdl){
			$config = new BlockTypeConfig();
			$config->setAttributes($mdl->getAttributes());
			if ($config->save()){
				echo Yii::t('core', "Successfully export blocktype :title", array(':title' => $mdl->title));
			} else {
				echo CVarDumper::dumpAsString($config->getErrors(), 10, TRUE);
			}

		}
	}*/
}
