<?php echo TbHtml::well(Yii::t('app','Fields with <span class="required">*</span> are required.'));?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'block-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

<?php $this->beginClip('info'); ?>

	<?php echo $form->textFieldControlGroup($model, 'title', 
			array(
				'size' => TbHtml::INPUT_SIZE_XLARGE, 
				'help' => Yii::t('core', "Title of this block, to be displayed on Administration page."
	)));?>

	<?php echo $form->textAreaControlGroup($model, 'description', 
			array( 'size' => TbHtml::INPUT_SIZE_XXLARGE, 'help' => Yii::t('core', 'You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.' )));	
	//@TODO: Add Preview Button. See github implementations...	?>
	
	<?php echo $form->dropDownListControlGroup($model, 'type', Blocktype::listData(),
			array( 'help' => Yii::t('core', 'Block types provide various features to the CMS. Each block type will have its own behaviors.' )));	
	//@TODO: Add Preview Button. See github implementations...	?>
	
<?php $this->endClip(); // info ?>

<?php $this->beginClip('display'); ?>

	<?php echo $form->textFieldControlGroup($model,'label',array('help'=>Yii::t('core', 'If specified, the block will be render to the end users with this label.'))); ?>

	<?php echo $form->checkBoxControlGroup($model,'status',array('help'=>Yii::t('core', 'Temporary disable this block.'))); ?>

	<?php echo $form->radioButtonListControlGroup($model,'display', Block::displayOption(), array('help'=>Yii::t('core', 'Temporary disable this block.'))); ?>

	<?php echo $form->textAreaControlGroup($model,'url',array('help'=>Yii::t('core', 'URL to apply for current display mode.'))); ?>

<?php $this->endClip(); // display ?>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
'tabs'=>array(
	'info'	=>	array(
		'label'	=>	Yii::t('core', 'Information'),
		'content'	=>	$this->clips['info'],
		'active'	=>	TRUE,
	),
	'display'	=>	array(
		'label'	=>	Yii::t('core', 'Display Options'),
		'content'	=>	$this->clips['display']
	),
)));
?>


<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_DANGER)),
	)); ?>
	
<?php $this->endWidget(); // form?>