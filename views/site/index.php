<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'TelegramBot [pshekusbot]';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Excellent!</h1>

        <p class="lead">The name of the Telegram Bot <b>pshekusbot</b></p>

        <p><a id='btn1' class="btn btn-lg btn-success" href="/TelegramBot/web?r=site/init">Get started with Telegram Bot</a></p>
        <p><a id='btn2' style='visibility: hidden;' class="btn btn-lg btn-danger" href="https://google.com">stop Telegram Bot</a></p>
    </div>

</div>


<?php
$this->registerJsFile('@web/js/scripts.js', ['depends' => 'yii\web\YiiAsset']);

$js = <<<JS
$(document).ready(function() {
        $('#btn1').on('click',function() {
          $('#btn1').css({'display' : 'none'});
          $('#btn2').css({'visibility' : 'visible'});
        });
        })
JS;

$this->registerJs($js);