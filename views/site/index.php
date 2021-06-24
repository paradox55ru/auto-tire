<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use limion\jqueryfileupload\JQueryFileUpload;

$this->title = 'Автошины';
?>

<?php $form = ActiveForm::begin(); ?>
    <?= JQueryFileUpload::widget([
        'url' => ['upload-file-ajax',], // your route for saving file,
        'appearance'=>'basic', // available values: 'ui','plus' or 'basic'
        'name' => 'UploadForm[file]',
        'formId'=>$form->id,
        'options' => [
            'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ],
        'clientOptions' => [
            'maxFileSize' => 2000000,
            'dataType' => 'json',
            'acceptFileTypes'=>new yii\web\JsExpression('/(\.|\/)(xlsx)$/i'),
            'autoUpload'=>true
        ],
        'clientEvents' => [
            'done'=> "function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        var proccessUploadFile = $('#proccessUploadFile');
                        $(proccessUploadFile).attr('href', '" .  Url::to(['auto-tire/read-xlsx-file'], true) ."'+'&fileName='+file.name).css('visibility', 'visible');
                        //$(proccessUploadFile).appendTo('.files .name');
                    });
                }",
            'progressall'=> "function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }",
        ]
    ]);?>
<?php ActiveForm::end(); ?>

<div id="fileUploadPanel">
    <a href="#" id="proccessUploadFile" style="visibility: hidden;">Обработать загруженный файл</a>
</div>