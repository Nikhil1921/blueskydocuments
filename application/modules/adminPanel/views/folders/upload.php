<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $title ?> <?= $operation ?></h5>
    </div>
    <div class="card-body">
        <?= form_open_multipart('', '', ['image' => (isset($data['document_file']) ? $data['document_file'] : '')]) ?>
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
                <div class="col-6">
                    <div class="form-group">
                        <?= form_label('Document', 'image', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'type' => "file",
                            'id' => "image",
                            (!isset($data['document_file']) ? 'required' : '') => '',
                            'name' => "image"
                        ]); ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <?= form_label('Description / Remarks', 'description', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'type' => "text",
                            'id' => "description",
                            'name' => "description",
                            'value' => set_value('description') ? set_value('description') : (isset($data['description']) ? $data['description'] : '')
                        ]); ?>
                        <?= form_error('description') ?>
                    </div>
                </div>
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