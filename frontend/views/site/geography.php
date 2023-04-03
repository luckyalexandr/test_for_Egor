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
<div class="site-geography">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'geography-form']); ?>

    <?= $form->field($model, 'region_id')->textInput(['autofocus' => true, 'value' => '178248']) ?>

    <?= $form->field($model, 'language')->textInput(['value' => 'en-US']) ?>

    <?= $form->field($model, 'include')->textInput(['value' => 'details']) ?>

    <?= $form->field($model, 'billing_terms')->textInput() ?>

    <?= $form->field($model, 'partner_point_of_sale')->textInput() ?>

    <?= $form->field($model, 'payment_terms')->textInput() ?>

    <?= $form->field($model, 'platform_name')->textInput() ?>

    <?= $form->field($model, 'supply_source')->textInput() ?>

    <?= $form->field($model->header, 'accept')->textInput(['value' => 'application/json']) ?>

    <?= $form->field($model->header,'accept_encoding')->textInput(['value'=>'gzip']) ?>

    <?= $form->field($model->header, 'user_agent')->textInput(['value'=>'TravelNow/3.30.112']) ?>

    <?= $form->field($model->header, 'customer_session_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
