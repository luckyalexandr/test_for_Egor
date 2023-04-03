<?php

/** @var yii\web\View $this
 * @var $request
 * @var $fullUrl
 * @var $form yii\bootstrap5\ActiveForm
 * @var $model \frontend\forms\ContentForm
 */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Shopping';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-shopping">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'shopping-form']); ?>

    <?= $form->field($model, 'property_id')->textInput(['autofocus' => true, 'value' => '19248']) ?>

    <?= $form->field($model, 'room_id')->textInput(['value' => '123abc']) ?>

    <?= $form->field($model, 'rate_id')->textInput(['value' => '123abc']) ?>

    <?= $form->field($model, 'token')->textInput(['value' => 'MY5S3j36cOcLfLBZjPYQ1abhfc8CqmjmFVzkk7euvWaunE57LLeDgaxm516m']) ?>

    <?= $form->field($model->header, 'accept')->textInput(['value' => 'application/json']) ?>

    <?= $form->field($model->header,'accept_encoding')->textInput(['value'=>'gzip']) ?>

    <?= $form->field($model->header, 'user_agent')->textInput(['value'=>'TravelNow/3.30.112']) ?>

    <?= $form->field($model->header, 'customer_session_id')->textInput() ?>

    <?= $form->field($model->header, 'customer_ip')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
