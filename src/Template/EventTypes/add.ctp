<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventType $eventType
 */
?>




<div class="row">
    <?= $this->Form->create($eventType) ?>
    <div class="col col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Adding Event Type
            </div>
            <div class="panel-body">
                <div class="form-group"><?= $this->Form->control('name',['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
            </div>
        </div>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg', 'id' => 'btnSubmit']) ?>
    </div>

</div>
