<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<div>
    <button onclick="goBack()" class="btn btn-success">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Edit Contact') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>



<div class="stocks form large-9 medium-8 columns content">
    <?= $this->Form->create($contact) ?>
    <div class="col col-lg-6">
        <div class="panel panel-default ">
            <div class="panel-heading">
                Contact Details
            </div>
            <div class="panel-body">
                <div class="form-group"><?= $this->Form->control('fname',  ['label' => 'First Name','class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('lname',  ['label' => 'Last Name','class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('phone', ['class' => 'form-control','placeholder' => ' +61412 345 678 or 0412 345 678']) ?></div>
                <div class="form-group"><?= $this->Form->control('email', ['class' => 'form-control','placeholder' => 'example@example.com']) ?></div>
                <div class="form-group"><?= $this->Form->control('role',  ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('job_id', ['class' => 'form-control','option' => $jobs]); ?></div>
            </div>
        </div>
    </div>

    <div class="col col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Contact Address
            </div>
            <div class="panel-body">

                <div class="form-group"><?= $this->Form->control('street',  ['label' => 'Address','class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('suburb',  ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('city',  ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                <div class="form-group"><?= $this->Form->control('postcode',  ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>

                <?php
                echo $this->Form->hidden('is_deleted');
                ?>

            </div>
        </div>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg']) ?>
    </div>
</div>





