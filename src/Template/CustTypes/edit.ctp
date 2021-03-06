<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustType $custType
 */
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Edit Customer Type') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="custTypes form content">
    <?= $this->Form->create($custType) ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic details
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group"><?= $this->Form->control('name', ['class' => 'form-control','placeholder' => 'This field is required']); ?></div>
                                <div class="form-group"><?= $this->Form->hidden('is_deleted'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg', 'id' => 'btnSubmit']) ?>
    <?= $this->Form->end() ?>
</div>
