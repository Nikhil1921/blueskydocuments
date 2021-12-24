<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $title ?> <?= $operation ?></h5>
    </div>
    <div class="card-body">
        <?= form_open() ?>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <?= form_label('Title', 'title', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'type' => "text",
                            'id' => "title",
                            'name' => "title",
                            'maxlength' => 255,
                            'required' => "",
                            'value' => set_value('title') ? set_value('title') : (isset($data['title']) ? $data['title'] : '')
                        ]); ?>
                        <?= form_error('title') ?>
                    </div>
                </div>
                <div class="col-12"></div>
                <div class="col-3">
                    <?= form_button([
                        'type'    => 'submit',
                        'class'   => 'btn btn-outline-primary btn-block',
                        'content' => 'SAVE'
                    ]); ?>
                </div>
                <div class="col-3">
                    <a href="javascript:;" onclick="window.history.back();" class="btn btn-outline-danger col-12"><span class="fa fa-back"></span> Go Back</a>
                </div>
            </div>
        <?= form_close() ?>
    </div>
</div>