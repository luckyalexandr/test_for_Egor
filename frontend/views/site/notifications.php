<?php

/** @var yii\web\View $this
 * @var $request
 * @var $fullUrl
 * @var $form yii\bootstrap5\ActiveForm
 * @var $model \frontend\forms\ContentForm
 */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-notifications">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'notifications-form']); ?>

    <?= $form->field($model, 'undeliverable')->textInput(['autofocus' => true, 'value' => 'false']) ?>

    <?= $form->field($model, 'billing_terms')->textInput() ?>

    <?= $form->field($model, 'partner_point_of_sale')->textInput() ?>

    <?= $form->field($model, 'payment_terms')->textInput() ?>

    <?= $form->field($model, 'platform_name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
