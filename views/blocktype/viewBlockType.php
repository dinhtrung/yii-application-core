<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Manage Block Types') =>array('index'),
	CHtml::encode($model),
);
$this->renderPartial('_menuBlockType');
?>

<h1><?php echo $this->pageTitle = Yii::t('core', 'View') . ' ' . Yii::t('core', 'Block type :name', array(':name' => CHtml::encode($model))); ?></h1>

<?php $this->beginClip('info'); ?>
<?php $this->beginWidget("CMarkdown"); echo $model->description; $this->endWidget(); ?>

<?php  $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'component',
		'callback',
		'viewfile',
	),
)); ?>
<?php $this->endClip(); ?>

<?php $this->beginClip('block'); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'block-grid',
					'dataProvider'=> $model->getDataProvider('blocks'),
					'columns' => array(
						'link:raw:title',
						'label',
						'description',
					),
)); ?>
<?php $this->endClip(); ?>


<?php
$this->widget('bootstrap.widgets.TbTabs', array(
'tabs'=>array(
	'info'	=>	array(
		'label'	=>	Yii::t('core', 'Information'),
		'content'	=>	$this->clips['info'],
		'active'	=>	TRUE,
	),
	'block'	=>	array(
		'label'	=>	Yii::t('core', 'Blocks of this type'),
		'content'	=>	$this->clips['block']
	),
)));
?>
