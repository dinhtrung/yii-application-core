<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Blocks')	=>	array('index'),
	Yii::t('core', 'Manage'),
);

if(empty($this->menu)) $this->renderPartial('_menuBlock', array('modelClass' => 'Blocks'));
?>

<h1>
<?php echo $this->pageTitle = Yii::t('core', 'Manage') . ' ' . Yii::t('core', 'Blocks'); ?>
</h1>

<?php
$type = $model->getAttributeLabel('type');
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'block-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'label',
		'description',
		"blocktype.link:raw:$type",
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'	=>	array(
				'duplicate' => array(
					'label'	=>	Yii::t('core', "Duplicate"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/blue-document-copy.png",
				),
				'configure'	=>	array(
 					'label'	=> 	Yii::t('core', 'Configure'),
     				'url'	=>	'Yii::app()->controller->createUrl("configure",array("id"=>$data->primaryKey))',
     				'imageUrl'	=>	Yii::app()->getBaseUrl() . '/images/icons/block--pencil.png',
				),
				'theme'	=>	array(
 					'label'	=> 	Yii::t('core', 'Theme'),
     				'url'	=>	'Yii::app()->controller->createUrl("theme",array("id"=>$data->primaryKey))',
     				'imageUrl'	=>	Yii::app()->getBaseUrl() . '/images/icons/block--arrow.png',
				),
			),
			'template'	=>	'{view} {update} {delete} {duplicate} {configure} {theme} ',
		),
	),
)); ?>
