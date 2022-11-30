<?php

/**
 * @var ExportExcelForm $model
 */

use backend\models\forms\ExportExcelForm;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'action' => \yii\helpers\Url::to('download')
]) ?>

<?= $form->field($model, 'excelFile')->fileInput() ?>

<?= \yii\helpers\Html::submitButton('Export', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>