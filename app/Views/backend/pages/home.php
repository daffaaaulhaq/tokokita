<? 
use App\Controllers;
?>


<?php $this->extend('backend/layout/pages-layout') ?>
<?php $this->section('content') ?>


<div class="row pb-10">
    <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">
                        <?= number_format($todayRevenue ?? 0, 2, ',', '.'); ?>
                    </div>
                    <div class="font-14 text-secondary weight-500">
                        Pendapatan hari ini
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                        <span class="icon-copy ti-heart"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">
                        <?= number_format($totalSoldItems ?? 0, 0, ',', '.'); ?>
                    </div>
                    <div class="font-14 text-secondary weight-500">
                        Total Barang terjual
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">
                        <?= number_format($totalRevenue ?? 0, 2, ',', '.'); ?>
                    </div>
                    <div class="font-14 text-secondary weight-500">Total Pendapatan</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                        <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
