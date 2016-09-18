<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Relation */

$this->title = Yii::t('app', 'Create Relation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
