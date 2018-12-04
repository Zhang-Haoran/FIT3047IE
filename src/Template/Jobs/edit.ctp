<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Job $job
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


<?= $this->html->css('jquery.datetimepicker.min.css')?>
<?= $this->html->script('jquery.datetimepicker.full.js', ['block' => 'scriptBottom']); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Edit Job') ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?= $this->Form->create($job) ?>
<div class="row">
    <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#job" data-toggle="tab">Job</a>
                    </li>
                    <li><a href="#customer" data-toggle="tab">Customer</a>
                    </li>
                    <li><a href="#contacts" data-toggle="tab">Contacts</a>
                    </li>
                    <li><a href="#site" data-toggle="tab">Site</a>
                    </li>
                    <li><a href="#priceInfo" data-toggle="tab">Billing Info</a>
                    </li>
                    <li><a href="#stock" data-toggle="tab">Stock & Order Detail</a>
                    </li>
                </ul>
                <div class="panel-body">
                        <div class="tab-pane fade in active" id="job">
                          <div class="tab-content">
                            <div class="row">
                            <div class="col-lg-6">
                            <div class="form-group"><?= $this->Form->control('name', ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                            <div class="form-group"><?= $this->Form->control('job_status', array('class' => 'form-control', 'type' => 'select', 'options' => $statusOptions)) ?></div>
                                <div class="form-group"><?= $this->Form->control('job_date', array('class' => 'form-control','placeholder'=>'Please select job date','label' => "Event Date",'type' => 'text','empty'=>'true','id' => 'job_datetime'))?></div>
                            <div class="form-group"><?= $this->Form->control('event_type_id', ['options' => $eventTypes, 'class' => 'form-control','id'=> 'type_html_id']) ?></div>
                          </div>
                                <div class="col-lg-6">
                                    <div class="form-group"><?php echo $this->Form->control('e_arrival_time', array('class' => 'form-control','placeholder'=>'Please select expected arrival time','label' => 'Arrive by','type' => 'text','empty'=>'true','id' => 'e_arrival_datetime'));?></div>
                                    <div class="form-group"><?php echo $this->Form->control('e_setup_time', array('class' => 'form-control','placeholder'=>'Please select expected setup time','label' => 'Setup by','type' => 'text','empty'=>'true','id' => 'e_setup_datetime'));?></div>
                                    <div class="form-group"><?php echo $this->Form->control('e_pickup_time', array('class' => 'form-control','placeholder'=>'Please select expected pickup time','label' => 'Pickup after','type' => 'text','empty'=>'true','id' => 'e_pickup_datetime'));?></div>
                                </div>
                          </div>
                          </div>

                      </div>

                        <div class="tab-pane fade" id="customer">
                          <div class="panel-group" id="accordion">
                                <div class="panel panel-default">

                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Select existing customer</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">

                                    <?php
                                    $list_cust= array();
                                    foreach ($customers as $customer)
                                        array_push($list_cust, "{$customer->name} ({$customer->cust_type->name})");

                                    ?>

                                    <div class="form-group"><?= $this->Form->control('customer_id', ['options' => $list_cust, 'class' => 'form-control','id'=> 'cust_html_id']) ?></div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-parent="#accordion" href="#collapseTwo" data-toggle="modal" data-target = "#custAdd" >Create new customer</a>
                                </h4>
                            </div>
                        </div>
                      </div>
                    </div>

                        <div class="tab-pane fade" id="site">

                          <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Select existing site</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="form-group"><?= $this->Form->control('site_id', ['options' => $sites, 'class' => 'form-control','id'=> 'site_html_id']) ?></div>
                                </div>
                            </div>
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#accordion" href="#collapseTwo" data-toggle="modal" data-target = "#siteAdd" >Create new site</a>
                                    </h4>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="priceInfo">
                          <div class="form-group"><?= $this->Form->control('quote', ['label' => 'Quote number','class' => 'form-control','placeholder'=>'Quote#']) ?></div>
                            <div class="form-group"><?= $this->Form->control('job_order', ['class' => 'form-control','placeholder'=>'Order#','label' => 'Order']) ?></div>
                            <div class="form-group"><?= $this->Form->control('Invoice', ['class' => 'form-control','placeholder'=>'Invoice#']) ?></div>
                            <div class="form-group"><?= $this->Form->control('price', ['class' => 'form-control', 'min'=>'0',  'value'=>'0', 'step'=>'1']) ?></div>
                            <div class="form-group"><?= $this->Form->control('deposit', ['class' => 'form-control', 'min'=>'0', 'value'=>'0', 'step'=>'1']) ?></div>
                        </div>


                        <div class="tab-pane fade" id="stock">
                            <div class="form-group"><?= $this->Form->control('order_detail', ['class' => 'form-control']) ?></div>
                            <div class="form-group"><?= $this->Form->control('additional_note', ['class' => 'form-control']) ?></div>
                        </div>

                    <div class="tab-pane fade" id="contacts">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Select existing contact</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="form-group"><?= $this->Form->control('contact_id', ['options' => $contacts, 'class' => 'form-control','id'=> 'contact_html_id']) ?></div>
                                    </div>
                                </div>
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-parent="#accordion" href="#collapseTwo" data-toggle="modal" data-target = "#contactsAdd" >Create new contact</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                      </div>
                    </div>
    <div class ="tab-content">
        <div class="Footer">
            <div class="divleft">
                <button id="btnPrev"  type="button" value="Previous Tab" text="Previous Tab" class="btn btn-success btn-lg">Previous
                </button>
            </div>
            <div class="divright">
                <button id="btnNext" type="button" value="Next Tab"  text="Next Tab" class="btn btn-success btn-lg">Next
                </button>
            </div>
        </div>
        <div class="divright">
            <button id="Submit" type="submit" value="Submit" text="Submit" class="btn btn-success btn-lg">Submit</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
    </div>

        <div class="modal fade" id="custAdd" role="dialog">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Customer</h4>
                    </div>
                    <div class="modal-body">
                        <?= $this->Form->create(null,['url' => ['controller' => 'Customers','action' => 'jobAdd']]) ?>
                        <fieldset>
                            <?php
                            echo $this->Form->control('fname', ['label' => 'First name','class' => 'form-control','placeholder' => 'This field is required']);
                            echo $this->Form->control('lname', ['label' => 'Last name','class' => 'form-control','placeholder' => 'This field is required']);
                            echo $this->Form->control('contact', ['label' => 'Contact name','class' => 'form-control','placeholder' => 'This field is required']);
                            echo $this->Form->control('phone', ['label' => 'Phone number','class' => 'form-control','placeholder' => ' +61412 345 678 or 0412 345 678']);
                            echo $this->Form->control('mobile', ['label' => 'Mobile number','class' => 'form-control','placeholder' => ' +61412 345 678 or 0412 345 678']);
                            echo $this->Form->control('email', ['label' => 'Email address','class' => 'form-control','placeholder' => 'example@example.com']);
                            echo $this->Form->control('cust_type_id', ['options' => $custTypes, 'label' => 'Type','class' => 'form-control']);
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg' ,'disabled']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>

</div>

<div class="modal fade" id="siteAdd" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New site</h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null,['url' => ['controller' => 'Sites','action' => 'siteAdd']]) ?>
                <fieldset>
                    <div class="form-group"><?= $this->Form->control('name', ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                    <div class="form-group"><?= $this->Form->control('address', ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                    <div class="form-group"><?= $this->Form->control('suburb', ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                    <div class="form-group"><?= $this->Form->control('postcode', ['class' => 'form-control','placeholder' => 'This field is required']) ?></div>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg', 'id' => 'btnSubmit' ,'disabled']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

</div>


<?php $this->start('script'); ?>
<script>
    $('button#btnPrev').hide();
    $('button#Submit').hide();

    $("#job_datetime").datetimepicker({
        defaultDate: new Date(),
        timepicker:false,
    });

    $("#e_arrival_datetime").datetimepicker({
        defaultDate: new Date(),
        step:30
    });
    $("#e_setup_datetime").datetimepicker({
        defaultDate: new Date(),
        step:30
    });
    $("#e_pickup_datetime").datetimepicker({
        defaultDate: new Date(),
        step:30
    });


    $(document).ready(function () {
        $("#type_html_id").chosen();
        $("#cust_html_id").chosen();
        $("#site_html_id").chosen();
        $("#contact_html_id").chosen();
        $("#image_html_id").chosen();
    });

    $(function() {
        var $tabs = $('.col-lg-12 li');

        $('#btnPrev').on('click', function() {
            $tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
        });
        $('#btnNext').on('click', function() {
            $tabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');
        });

        $('a[href="#job"]').on('show.bs.tab', function () {
            $('button#btnPrev').hide();
        });
        $('a[href="#job"]').on('hide.bs.tab', function () {
            $('button#btnPrev').show();
        });
        $('a[href="#stock"]').on('show.bs.tab', function () {
            $('button#btnNext').hide();
            $('button#Submit').show();
        });
        $('a[href="#stock"]').on('hide.bs.tab', function () {
            $('button#btnNext').show();
            $('button#Submit').hide();
        });

    });

</script>
<?php $this->end(); ?>
