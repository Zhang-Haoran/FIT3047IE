<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventType $eventType
 */
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('View Event Type') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>




<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <th>Event type details</th>
        </div>

        <table class="panel-body">
            <tr class="table-responsive">
                <table id="table" class="table table-striped table-bordered table-hover">



        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($eventType->name) ?></td>
        </tr>
    </table>
            </tr>
        </table>
    </div>

</div>


