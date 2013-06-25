<?php echo TbHtml::well(Yii::t('app','Fields with <span class="required">*</span> are required.'));?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'blocktype-form',
		'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>

	<?php echo $form->textFieldControlGroup($model,'btid',array('help'=> $model->t("Machine name of this block type."))); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('help' => $model->t("Name of this block type. Used in administration interfaces"))); ?>

	<?php echo $form->textAreaControlGroup($model,'description',array('cols' => 70, 'size' => TbHtml::INPUT_SIZE_XXLARGE, 'rows' => 5, 'help'=> $model->t('You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.'))); ?>

	<?php echo $form->textFieldControlGroup($model,'component',array('help'=> $model->t("Yii Component that provide Callback Data and Config functions, written in Yii path alias."))); ?>

	<?php echo $form->textFieldControlGroup($model,'callback',array('help'=> $model->t("Prefix for the callback functions.<br> This block configuration will be provided by function <code><em>callback</em>Config</code> while data will be provided by <code><em>callback</em>Data</code> in the component above."))); ?>

	<?php echo $form->textFieldControlGroup($model,'viewfile',array(
			'help' => $model->t("The view file this block type will use. Provided as Yii path alias format.<br/>Finds a view file based on its name. The view name can be in one of the following formats:<br>
	<ul>
		<li><strong>absolute view within a module:</strong> the view name starts with a single slash <kbd>'/'</kbd>. In this case, the view will be searched for under the currently active module's view path. If there is no active module, the view will be searched for under the application's view path.</li>
		<li><strong>absolute view within the application:</strong> the view name starts with double slashes <kbd>'//'</kbd>. In this case, the view will be searched for under the application's view path.</li>
		<li><strong>aliased view:</strong> the view name contains dots and refers to a path alias. The view file is determined by calling <code>YiiBase::getPathOfAlias()</code>. Note that aliased views cannot be themed because they can refer to a view file located at arbitrary places.</li>
		<li><strong>relative view:</strong> otherwise. Relative views will be searched for under the currently active controller's view path.</li>
	</ul>
	For absolute view and relative view, the corresponding view file is a PHP file whose name is the same as the view name. The file is located under a specified directory. This method will call CApplication::findLocalizedFile to search for a localized file, if any."))); ?>

	<?php echo TbHtml::formActions(array(
		TbHtml::submitButton(Yii::t('app', 'Submit'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		TbHtml::resetButton(Yii::t('app', 'Reset'), array('color' => TbHtml::BUTTON_COLOR_DANGER)),
	)); ?>
	
<?php $this->endWidget(); ?>
