<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Job[]|\Cake\Collection\CollectionInterface $jobs
 */

//debug($name);
?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Today we have <p id="workForToday" style="display: inline; color: red"></p><p style="display: inline;"> job(s) left</p><p id="encouragement" style="display: inline"></p></h1>
        </div>
        <!-- /.col-lg-12 -->

        <!-- today panel-->
    <div class="col-lg-12">
        <div class="row">
        <div id="today" class="col-lg-4 col-md-6" style="cursor: pointer">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div id="todayN" class="col-xs-3 huge">❤️</div>
                        <div class="col-lg-8 text-right"><h3>Today</h3></div>
                    </div>
                </div>
                <a id="today-panel" style="cursor: pointer">
                    <div class="panel-footer">
                        <span class="pull-left">Show</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- coming week panel-->
        <div id="nextWeek" class="col-lg-4 col-md-6" style="cursor: pointer">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div id="nextWeekN" class="col-xs-2 huge">💙</div>
                        <div class="">
                            <div class="col-lg-9 text-right"><h3>Next Week</h3></div>
                        </div>
                    </div>
                </div>
                <a id="nextWeek-panel" style="cursor: pointer">
                    <div class="panel-footer">
                        <span class="pull-left">Show</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div id="quote" class="col-lg-4 col-md-6" style="cursor: pointer">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div id="quoteN" class="col-xs-3 huge">💛</div>
                        <div class="col-lg-8 text-right">
                            <h3>Quoted</h3>
                        </div>
                    </div>
                </div>
                <a id="quote-panel" style="cursor: pointer">
                    <div class="panel-footer">
                        <span class="pull-left">Show</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div id="pickupJob" class="col-lg-4 col-md-6" style="cursor: pointer">
            <div class="panel panel-default" style="border-color: #5542a9">
                <div class="panel-heading" style="background-color: #5542a9; color:white">
                    <div class="row">
                        <div id="pickup" class="col-xs-3 huge">💜</div>
                        <div class="">
                            <div class="col-lg-8 text-right"><h3>Pickup</h3></div>
                        </div>
                    </div>
                </div>
                <a id="pickupJob-panel"  style="cursor: pointer; color:#5542a9">
                    <div class="panel-footer">
                        <span class="pull-left">Show</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- all job panel-->
        <div id="allJob" class="col-lg-4 col-md-6" style="cursor: pointer">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div id="total" class="col-xs-3 huge">💚</div>
                        <div class="">
                            <div class="col-lg-8 text-right"><h3>All Incomplete</h3></div>
                        </div>
                    </div>
                </div>
                <a id="allJob-panel"  style="cursor: pointer">
                    <div class="panel-footer">
                        <span class="pull-left">Show</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div id="cancelledJob" class="col-lg-4 col-md-6" style="cursor: pointer">
            <div class="panel panel-default" style="border-color: #757575">
                <div class="panel-heading" style="background-color: #757575; color:white">
                    <div class="row">
                        <div id="cancelled" class="col-xs-3 huge">🖤</div>
                        <div class="">
                            <div class="col-lg-8 text-right"><h3>Cancelled</h3></div>
                        </div>
                    </div>
                </div>
                <a id="cancelledJob-panel"  style="cursor: pointer; color: #757575">
                    <div class="panel-footer">
                        <span class="pull-left">Show</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="bd-example">
    <?= $this->Html->link(__('New Job'), ['action' => 'add'], ['class' => ' btn btn-success', 'style' => '']) ?>
    <?= $this->Html->link(__('New Pickup Job'), ['action' => 'addpickup'], ['class' => ' btn btn-success', 'style' => '']) ?>
    <?= $this->Html->link(__('Download CSV'),[], ['class' => ' btn btn-info', 'id' => 'dTDownloadCSVBtn']) ?>
</div>
    <div class="row">
        <div class="col-lg-9">
            <div class="panel-body" style="margin-left: -15px;">
                <table width="100%" class="table table-striped table-bordered table-hover" id="Jobs">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th scope="col" class="notexport"><?= __('Action') ?></th>
                            <th scope="col"><?= __('Status') ?></th>
                            <th scope="col"><?= __('Job Date') ?></th>
                            <th scope="col"><?= __('Job Time') ?></th>
                            <th scope="col"><?= __('Booked Date') ?></th>
                            <th scope="col"><?= __('Price') ?></th>
                            <th scope="col"><?= __('Deposit') ?></th>
                            <th scope="col"><?= __('Expected arrival time') ?></th>
                            <th scope="col"><?= __('Expected setup time') ?></th>
                            <th scope="col"><?= __('Expected pickup time') ?></th>
                            <th scope="col"><?= __('Site') ?></th>
                            <th scope="col"><?= __('Event type') ?></th>
                            <th scope="col"><?= __('Customer') ?></th>
                            <th scope="col"><?= __('Created by') ?></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobs as $job):

                            if($job->job_status != "Completed"){
                        ?>
                        <tr>
                            <td><?= h($job->name) ?></td>
                            <td style="width:6%">
                                <?php if($job->is_pickup == 1){
                                echo $this->Html->link(__('View'), ['action' => 'viewpickup', $job->id], ['class' => 'btn btn-primary', 'style' => 'width:100%']);
                                } else{
                                echo $this->Html->link(__('View'), ['action' => 'view', $job->id], ['class' => 'btn btn-primary', 'style' => 'width:100%']);
                                }
                                ?>



                                <?php if($name == 1 || $name == 2){
                                    if($job->is_pickup == 1){
                                echo $this->Html->link(__('Edit'), ['action' => 'editpickup', $job->id], ['class' => 'btn btn-warning', 'style' => 'width:100%;marign-left:1%;margin-top:1%']);
                                }
                                else{
                                echo $this->Html->link(__('Edit'), ['action' => 'edit', $job->id], ['class' => 'btn btn-warning', 'style' => 'width:100%;marign-left:1%;margin-top:1%']);
                                }

                                }else{
                                '';
                                }
                                ?>

                                <?php   if($job->is_deleted == '1'){?>
                                <?= ($name == 1 || $name == 2)?$this->Html->link(__('Undelete'), ['action' => 'undelete', $job->id], ['class' => 'btn btn-danger', 'style' => 'width:100%;marign-right:1%;margin-top:1%', 'confirm' => __('Are you sure you want to undelete Job: {0}?',$job->name)]):"" ?>
                                <?php
                        }else{
                            ?>
                                <?= ($name == 1 || $name == 2)?$this->Html->link(__('Delete'), ['action' => 'delete', $job->id], ['class' => 'btn btn-danger', 'style' => 'width:100%;marign-right:1%;margin-top:1%', 'confirm' => __('Are you sure you want to delete Job: {0}?',$job->name)]):"" ?>
                                <?php
                        }
                        ?>
                                <?php if($job->job_status == 'Completed')
                                echo $this->Html->link(__('Invoice'), ['action' => 'invoice', $job->id], ['class' => 'btn btn-default', 'style' => 'width:100%;marign-left:1%;margin-top:1%;background-color: #5542a9;color: white;']);
                                elseif($job->job_status == 'Invoice')
                                echo $this->Html->link(__('Paid'), ['action' => 'paid', $job->id], ['class' => 'btn btn-info', 'style' => 'width:100%;marign-left:1%;margin-top:1%']);
                                ?>
                            </td>
                            <?php
                            if($job->is_deleted == '1')
                            echo "<td class='bg-default' style='color: white;background-color: black;'>Cancelled</td>";
                            elseif( $job->job_status == 'Order')
                            echo "<td class='bg-danger text-white'>Order</td>";
                            elseif ($job->job_status == 'Ready')
                            echo "<td class='bg-info text-white'>Ready</td>";
                            elseif($job->job_status == 'Quote')
                            echo "<td class='bg-warning text-white'>Quote</td>";
                            elseif($job->job_status == 'Completed')
                            echo "<td class='bg-success text-white'>Completed</td>";
                            elseif($job->job_status == 'Invoice')
                            echo "<td class='bg-default text-white' style='background-color: #bbb4da;'>Invoice</td>";
                            elseif($job->job_status == 'Paid')
                            echo "<td class='bg-default text-white' style='background-color: #5bc0de85;'>Paid</td>";
                            ?>
                            <td><?= h($job->job_date->format('l jS F Y')) ?></td>
                            <td><?= h($job->job_date->format('g:i A')) ?></td>
                            <td class="center"><?= h($job->booked_date->format('g:i A l jS F Y')) ?></td>
                            <td class="center">$<?= $this->Number->format($job->price) ?></td>
                            <td class="center">$<?= $this->Number->format($job->deposit) ?></td>
                            <td class="center"><?= h($job->e_arrival_time) ?></td>
                            <td class="center"><?= h($job->e_setup_time) ?></td>
                            <td class="center"><?= h($job->e_pickup_time) ?></td>
                            <td>
                                <?php if( $job->has('site')){
                                    if($name == 1 || $name == 2){
                                        echo $this->Html->link($job->site->name, ['controller' => 'Sites', 'action' => 'view', $job->site->id]);
                                    }
                                    else{
                                        echo h($job->site->name);
                                    }
                                }
                                else{
                                    '';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($job->has('event_type')) {
                                    echo h($job->event_type->name);
                                }
                                else{
                                    '';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($job->has('customer')) {
                                    echo h($job->customer->name);
                                }
                                else{
                                    '';
                                }
                                ?>
                            </td>
                            <td class="center">
                                <?php if($job->has('employee')){
                                    if ($name == 1 || $name == 2) {
                                        echo $this->Html->link($job->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $job->employee->id]);
                                    }
                                    else    {
                                        echo h($job->employee->full_name);
                                    }
                                }
                                else{
                                    '';
                                }
                                ?>
                            </td>

                        </tr>
                        <?php
                            }
                            endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3 col-md-4" style="margin-top: 77px">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Today Summary</b></div>
                <div class="list-group">
                    <a id="totalC" class="list-group-item" style="cursor: pointer;">Total Jobs
                        <span id="totalN" class="pull-right text-muted small">0</span>
                    </a>
                    <a id="orderC" class="list-group-item" style="cursor: pointer;">Jobs on order
                        <span id="orderN" class="pull-right text-muted small">0</span>
                    </a>
                    <a id="readyC" class="list-group-item" style="cursor: pointer;">Jobs on ready
                        <span id="readyN" class="pull-right text-muted small">0</span>
                    </a>
                    <a id="completedC" class="list-group-item" style="cursor: pointer;">Jobs completed
                        <span id="completedN" class="pull-right text-muted small">0</span>
                    </a>
                    <a id="invoicedC" class="list-group-item" style="cursor: pointer;">Jobs Invoiced
                        <span id="invoicedN" class="pull-right text-muted small">0</span>
                    </a>
                    <a id="paidC" class="list-group-item" style="cursor: pointer;">Jobs Paid
                        <span id="paidN" class="pull-right text-muted small">0</span>
                    </a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><b>This month Summary</b></div>
                <div class="list-group">
                    <a class="list-group-item">Total Jobs
                        <span id="totalMN" class="pull-right text-muted small">0</span>
                    </a>
                    <a class="list-group-item">Jobs Incomplete
                        <span id="incompleteMN" class="pull-right text-muted small">0</span>
                    </a>
                    <a class="list-group-item">Jobs completed
                        <span id="completedMN" class="pull-right text-muted small">0</span>
                    </a>
                    <a class="list-group-item">Jobs Paid
                        <span id="paidMN" class="pull-right text-muted small">0</span>
                    </a>
                    <a class="list-group-item">Total Income ($)
                        <span id="tIncomeMN" class="pull-right text-muted small">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?= $this->Html->script('/js/admindashboard.js') ?>
