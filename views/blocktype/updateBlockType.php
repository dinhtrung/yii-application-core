<?php


$this->breadcrumbs=array(
	Yii::t('core', 'Manage Block Types') =>array('index'),
	CHtml::encode($model)	=>	array('view','id'=>$model->btid),
	Yii::t('core', 'Update'),
);

$this->renderPartial('_menuBlockType');
?>

<h1><?php echo $this->pageTitle = Yii::t('core', 'Update Block Type :name', array(':name' => CHtml::encode($model->title))); ?></h1>

<?php $this->renderPartial('_formBlockType', array('model'=>$model)); ?>
