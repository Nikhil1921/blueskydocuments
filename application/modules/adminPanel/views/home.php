<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <?php if(access()): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('users')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $users ?></span>
                            </h5>
                            <p>Total users</p>
                        </div>
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('folders')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $folders ?></span>
                            </h5>
                            <p>Total Folders</p>
                        </div>
                        <i class="fa fa-file-text fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('folders')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $documents ?></span>
                            </h5>
                            <p>Total Documents</p>
                        </div>
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>