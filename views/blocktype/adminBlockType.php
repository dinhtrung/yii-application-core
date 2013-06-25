<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Manage Block Types'),
);

$this->renderPartial('_menuBlockType');
?>

<h1><?php echo $this->pageTitle = Yii::t('core', 'Manage Block Types'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'blocktype-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'	=>	array(
				'duplicate' => array(
					'label'	=>	Yii::t('core', "Duplicate"),
					'url'	=>	'Yii::app()->controller->createUrl("sort",array("id"=>$data->primaryKey))',
					'imageUrl'	=> Yii::app()->baseUrl . "/images/icons/blue-document-copy.png",
				),
			),
			'template'	=>	'{view} {update} {delete} {duplicate}',
		),
	),
));
?>
