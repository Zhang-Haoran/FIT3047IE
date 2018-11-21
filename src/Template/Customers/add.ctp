<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>


<div class="row">
    <?= $this->Form->create($customer) ?>

    <div class="col col-lg-6">
        <div class="panel panel-default ">
            <div class="panel-heading">
                Customer detail
            </div>
            <div class="panel-body">
                <div class="form-group"><?= $this->Form->control('name', ['class' => 'form-control','label' => 'Name','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('is_business',['label' => 'is business?','class' => 'checkbox','type' => 'checkbox']); ?></div>
                <div class="form-group"><?= $this->Form->control('cust_type_id', ['options' => $custTypes, 'label' => 'Type', 'class' => 'form-control']) ?></div>

            </div>
        </div>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg', 'id' => 'btnSubmit']) ?>
    </div>

</div>
