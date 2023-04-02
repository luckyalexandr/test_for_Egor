<?php

/** @var yii\web\View $this
 * @var $form yii\bootstrap5\ActiveForm
 * @var $model \frontend\forms\ContentForm
 */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Content';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'content-form']); ?>

    <?= $form->field($model, 'language')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <?= $form->field($model, 'business_model')->textInput() ?>

    <?= $form->field($model, 'category_id_exclude')->textInput() ?>

    <?= $form->field($model, 'chain_id')->textInput() ?>

    <?= $form->field($model, 'country_code')->textInput() ?>

    <?= $form->field($model, 'date_added_end')->textInput() ?>

    <?= $form->field($model, 'date_added_start')->textInput() ?>

    <?= $form->field($model, 'date_updated_end')->textInput() ?>

    <?= $form->field($model, 'date_updated_start')->textInput() ?>

    <?= $form->field($model, 'include')->textInput() ?>

    <?= $form->field($model, 'multi_unit')->dropDownList(['' => 'Select', true => 'True', false => 'False']) ?>

    <?= $form->field($model, 'property_id')->textInput() ?>

    <?= $form->field($model, 'property_rating_max')->input('number') ?>

    <?= $form->field($model, 'property_rating_min')->input('number') ?>

    <?= $form->field($model, 'supply_source')->textInput() ?>

    <?= $form->field($model, 'billing_terms')->textInput() ?>

    <?= $form->field($model, 'partner_point_of_sale')->textInput() ?>

    <?= $form->field($model, 'payment_terms')->textInput() ?>

    <?= $form->field($model, 'platform_name')->textInput() ?>

    <?= $form->field($model->header, 'accept')->textInput(['value' => 'application/json']) ?>

    <?= $form->field($model->header,'accept_encoding')->textInput(['value'=>'gzip']) ?>

    <?= $form->field($model->header, 'user_agent')->textInput(['value'=>'TravelNow/3.30.112']) ?>

    <?= $form->field($model->header, 'customer_session_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
