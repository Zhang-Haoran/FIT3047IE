<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact[]|\Cake\Collection\CollectionInterface $contacts
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
        <h1 class="page-header"><?= __('Contacts') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
        <thead>
            <tr>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col" style="max-width: 200px"><?= __('Action') ?></th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= h($contact->fname) ?></td>
                <td><?= h($contact->lname) ?></td>
                <td><?= h($contact->role) ?></td>
                <td><?= h($contact->phone) ?></td>
                <td><a href = "mailto:<?= ($contact->email) ?>"><?= ($contact->email) ?></a></td>
                <td class="actions">
                    <div class="col-lg-4" style="padding-left: 0px; padding-right: 0px"><?= $this->Html->link(__('View'), ['action' => 'view', $contact->id], ['class' => 'btn btn-primary', 'style' => 'width:99%']) ?></div>
                    <div class="col-lg-4" style="padding-left: 0px; padding-right: 0px"><?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'btn btn-warning', 'style' => 'width:99%']) ?></div>
                    <div class="col-lg-4" style="padding-left: 0px; padding-right: 0px"><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['class' => 'btn btn-danger', 'style' => 'width:99%;', 'confirm' => __('Are you sure you want to delete contact: {0} {1}?', $contact->fname, $contact->lname)]) ?></div>
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
