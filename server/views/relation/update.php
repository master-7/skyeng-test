<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Relation */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Relation',
]) . $model->ru;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ru, 'url' => ['view', 'ru' => $model->ru, 'eng' => $model->eng]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="relation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
