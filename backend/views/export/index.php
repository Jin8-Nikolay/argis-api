<?php

/**
 * @var ExportExcelForm $model
 */

use backend\models\forms\ExportExcelForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'action' => Url::to('download')
]) ?>

<?= $form->field($model, 'excelFile')->fileInput() ?>

<?= Html::submitButton('Завантажити файл', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>
