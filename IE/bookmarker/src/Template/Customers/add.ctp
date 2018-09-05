<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cust Types'), ['controller' => 'CustTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cust Type'), ['controller' => 'CustTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customers form large-9 medium-8 columns content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <legend><?= __('Add Customer') ?></legend>
        <?php
            echo $this->Form->control('cust_fname');
            echo $this->Form->control('cust_lname');
            echo $this->Form->control('cust_contact');
            echo $this->Form->control('cust_phone');
            echo $this->Form->control('cust_mobile');
            echo $this->Form->control('cust_email');
            echo $this->Form->control('cust_type_id', ['options' => $custTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
