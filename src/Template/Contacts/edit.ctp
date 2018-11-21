<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>



<html>
<body>

<button onclick="goBack()">Go Back</button>


<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Edit Contact') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>



<div class="stocks form large-9 medium-8 columns content">
    <?= $this->Form->create($contact) ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic details
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group"><?= $this->Form->control('name', ['class' => 'form-control','placeholder' => 'This field is required']); ?></div>
                                <div class="form-group"><?= $this->Form->control('phone', ['class' => 'form-control','placeholder' => ' +61412 345 678 or 0412 345 678']); ?></div>
                                <div class="form-group"><?= $this->Form->control('email', ['class' => 'form-control','placeholder' => 'example@example.com']); ?></div>
                                <div class="form-group"><?= $this->Form->control('role', ['class' => 'form-control','placeholder' => 'This field is required']); ?></div>
                                <div class="form-group"><?= $this->Form->control('job_id', ['option' => $jobs]); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg', 'id' => 'btnSubmit']) ?>
        <?= $this->Form->end() ?>
    </div>





