<?php

$this->breadcrumbs=array(
	Yii::t('core', 'Blocks')	=> 'index',
	Yii::t('core', 'Create'),
);

$this->renderPartial('_menuBlock');
?>

<h1>
	<?php echo $this->pageTitle = Yii::t('core', 'Create') . ' ' . Yii::t('core', 'Block'); ?>
</h1>

<?php
$this->renderPartial('_formBlock', array( 'model' => $model));

?>

