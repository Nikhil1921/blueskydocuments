<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-5">
                <h5><?= $title ?> <?= $operation ?></h5>
            </div>
            <div class="col-3">
                <?= anchor("$url/upload/$parent_id", '<span class="fa fa-plus"></span> Add document', 'class="btn btn-outline-success btn-sm float-right"'); ?>
            </div>
            <div class="col-2">
                <?= anchor("$url/add/$parent_id", '<span class="fa fa-plus"></span> Add folder', 'class="btn btn-outline-success btn-sm float-right"'); ?>
            </div>
            <div class="col-2">
                <?= anchor("$url/".e_id($back_id), '<span class="fa fa-back"></span> Go Back', 'class="btn btn-outline-primary btn-sm float-right"'); ?>
            </div>
        </div>
    </div>
</div>
<br>
<?php if($folders): ?>
<div class="row">
    <?php foreach($folders as $folder): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('folders/'.e_id($folder['id']))) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $folder['title'] ?></span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
<?php else: ?>
    <div class="card">
        <div class="col-md-12">
            <div class="card-body">
                NO FOLDERS AVAILABLE
            </div>
        </div>
    </div>
<?php endif ?>
<div class="card">
    <div class="card-header">
        <h5>Documents <?= $operation ?></h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered nowrap">
                <thead>
                    <th class="target">Sr.</th>
                    <th>Title</th>
                    <th>Upload Date</th>
                    <th>Update Date</th>
                    <th class="target">Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="folder_id" value="<?= $parent_id ?>" />