<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WordRu */

$this->title = Yii::t('app', 'Create Word Ru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Word Rus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="word-ru-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
