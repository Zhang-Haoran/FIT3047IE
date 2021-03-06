<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accessory[]|\Cake\Collection\CollectionInterface $accessories
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
        <h1 class="page-header"><?= __('Accessories') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr>
                        <th scope="col"><?= __('name') ?></th>
                        <th scope="col" class="actions" style="max-width: 200px"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accessories as $accessory): ?>
                    <tr>
                        <td class="center"><?= h($accessory->name) ?></td>
                        <td class="actions">
                            <div class="col-lg-4" style="padding-left: 0px; padding-right: 0px"><?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessory->id], ['class' => 'btn btn-warning', 'style' => 'width:99%']) ?></div>
                            <div class="col-lg-4" style="padding-left: 0px; padding-right: 0px"><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessory->id], ['class' => 'btn btn-danger', 'style' => 'width:99%', 'confirm' => __('Are you sure you want to delete Accessory: {0}?', $accessory->name)]) ?></div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#dataTables').DataTable({
        responsive: true,
        colReorder: false,
    });
</script>
