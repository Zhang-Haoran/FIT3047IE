<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Stock;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 *
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $jobs = $this->Jobs->find('all')
            ->contain(['Sites', 'EventTypes', 'Customers', 'Employees']);
        $this->set(compact('jobs'));
        $session = $this->getRequest()->getSession();
        $name = $session->read('Auth.User.access_level');
        $this->set('name', $name);
            if($name) {
                if ($this->Auth->user('access_level') == '3') {
                    $this->render('fieldstaffdashboard');
                } elseif ($this->Auth->user('access_level') == '2') {
                    $this->render('officestaffdashboard');
                } elseif ($this->Auth->user('access_level') == '1') {
                    $this->render('admindashboard');
                }
            }else{
                $this->redirect($this->Auth->logout());
            }


    }

    public function joblist()
    {
        $jobs = $this->Jobs->find('all')
            ->contain(['Sites', 'EventTypes', 'Customers', 'Employees']);
        $this->set(compact('jobs'));
        $session = $this->getRequest()->getSession();
        $name = $session->read('Auth.User.access_level');
        $this->set('name', $name);

        //reference from the authentication code from function view()
        if($this->Auth->user('access_level') !='1' && $this->Auth->user('access_level') !='2'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            $this->redirect($this->Auth->redirectUrl());
        }

    }


    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Sites', 'EventTypes', 'Customers', 'Employees', 'Images']
        ]);
        if($job->is_deleted == '1' && $this->Auth->user('access_level') !='1' ) {
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            $this->redirect($this->Auth->redirectUrl());
        }


        $this->loadModel('Sites');
        $site = $this->Sites->get($job->site_id);

        $this->set('site', $site);
        $this->set('job', $job);
    }

    /**
     * Add method
     *
     * @return array
     */

    public function convert_date($cake_date){
        $separate = explode("/",$cake_date);
        $date=[];
        $date['year'] = $separate[2];
        $date['month'] = $separate[1];
        $date['day'] = $separate[0];

        return $date;
    }

    public function convert_datetime($cake_date){
        $separate1 = explode(" ",$cake_date);

        $separate2 = explode("/",$separate1[0]);
        $date=[];
        $date['year'] = $separate2[2];
        $date['month'] = $separate2[1];
        $date['day'] = $separate2[0];

        $separate3 = explode(":",$separate1[1]);
        if ($separate1[2] == "PM"){
            $separate3[0] = $separate3[0]+12;
//            $separate3 = $separate3[0].":".$separate3[1];
        }
        $date['hour'] = $separate3[0];
        $date['minute'] = $separate3[1];
        return $date;

    }
    public function add()
    {
        if($this->Auth->user('access_level')=='3'){
        $this->Flash->set(__('You have no authorization to access this page as a field staff'));
        return $this->redirect($this->Auth->redirectUrl());
        }

        $job = $this->Jobs->newEntity();
        if ($this->request->is('post')) {
            $post = $this->request->getData();
            //convert job date
            $job_date = $post['job_date'];
            if($job_date != "") {
                $job_date = $this->convert_date($job_date);
            }
            $post['job_date'] = $job_date;
            //job date end

            //arrival time
            $e_arrival_time = $post['e_arrival_time'];
            if($e_arrival_time != "") {
                $e_arrival_time = $this->convert_datetime($e_arrival_time);
            }
            $post['e_arrival_time'] = $e_arrival_time;


            //setup time
            $e_setup_time = $post['e_setup_time'];
            if($e_setup_time != "") {
                $e_setup_time = $this->convert_datetime($e_setup_time);
            }
            $post['e_setup_time'] = $e_setup_time;


            //pickup time
            $e_pickup_time = $post['e_pickup_time'];
            if($e_pickup_time != "") {
                $e_pickup_time = $this->convert_datetime($e_pickup_time);
            }
            $post['e_pickup_time'] = $e_pickup_time;



            $job = $this->Jobs->patchEntity($job, $post,[
                'associated' => [
                    'customers',
                    'sites',
                    'eventTypes',
                ]
            ]);

            //changing the time last changed to now
            $job->last_changed = Time::now();

            //Adding the id of the employee that created the job
            $this->loadModel('Employees');
            $staff = $this->Employees->get($this->Auth->user('id'));

            $job->edited_by = $staff->full_name;
            $job->employee_id = $this->Auth->user('id');

            //Adding stocks to order details

            $job = $this->Jobs->patchEntity($job,$post);

            //Save first to get status of the save action
            $jobSaveStatus = $this->Jobs->save($job);
            if ($jobSaveStatus) {
                //debug($post);
                //exit;

                //$stocks = $post['stocks'];

//                //TODO: Save all stock info here
//                //$jobObj = $this->loadComponent('Stocklines');
//                //$stocks = $jobObj->Stocklines->find('list');
//                $jobID = $jobSaveStatus['id'];
//                $this->loadModel('Stocklines');
//                //foreach ($stocks as $stock) {
//                $stockline = $this->Stocklines->newEntity();
//                //debug($stockline);
//                $stockline->stock_id = $post['stock_id'];
//                $stockline->jobs_id = $jobID;
//                //debug($stockline);
//                //patchEntity();
//                $stocklinessave = $this->Stocklines->save($stockline);
//                //debug($stocklinessave);
//
//                //}
//                $this->loadModel('Accessorielines');
//                $accessline = $this->Accessorielines->newEntity();
//                $accessline ->accessories_id = $post['accessory_id'];
//                $accessline ->jobs_id = $jobID;
//
//                $accessLinesave = $this->Accessorielines->save($accessline);




                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            else{

                $this->Flash->error(__('The job could not be saved. Please, try again.'));
                }
        }
        $sites = $this->Jobs->Sites->find('list', [
            'keyField' => 'id',
            'valueField' => function ($site) {
                return $site->get('label');
            }
        ]);
        $eventTypes = $this->Jobs->EventTypes->find('list');

        $customers = $this->Jobs->Customers->find('all', [
            'contain' => ['CustTypes'],
            'keyField' => 'id',
            'valueField' => function ($customer) {
                return $customer->get('label');
            }
        ]);
        $employees = $this->Jobs->Employees->find('list');



        $contacts = $this->Jobs->Contacts->find('list', [
            'keyField' => 'id',
            'valueField' => function ($contact) {
                return $contact->get('label');
            }
        ]);


        $this->loadModel('CustTypes');
        $CustTypes = $this->CustTypes->find('list');
        //$csrfToken = $this->request->getParam('_csrfToken');
        $this->loadModel('Stocks');
       $stocks = $this->Stocks->find('list');
       $this->loadModel('Accessories');
       $access = $this->Accessories->find('list');
        $this->set(compact('job', 'sites', 'eventTypes', 'customers', 'employees','CustTypes','contacts','stocks','access'));
        $this->set('statusOptions', array('Quote' => 'Quote', 'Order'=>'Order', 'Ready'=>'Ready', 'Completed'=>'Completed', 'Invoice'=>'Invoice', 'Paid'=>'Paid'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return array
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function reconvert_date($cake_date){
        $separate = explode("/",$cake_date);
        $date=[];
        $date['year'] = $separate[2];
        $date['month'] = $separate[1];
        $date['day'] = $separate[0];

        return $date;
    }
    public function reconvert_datetime($cake_date){
        $separate1 = explode(" ",$cake_date);

        $separate2 = explode("/",$separate1[0]);
        $date=[];
        $date['year'] = $separate2[2];
        $date['month'] = $separate2[1];
        $date['day'] = $separate2[0];

        $separate3 = explode(":",$separate1[1]);
        if ($separate1[2] == "PM"){
            $separate3[0] = $separate3[0]+12;
//            $separate3 = $separate3[0].":".$separate3[1];
        }
        $date['hour'] =''.$separate3[0];
        $date['minute'] = $separate3[1];
        return $date;

    }

    public function edit($id = null)
    {
        if ($this->Auth->user('access_level') == '3') {
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $job = $this->Jobs->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->request->getData();

            //convert job date
            $job_date = $post['job_date'];
            $job_date = $this->reconvert_date($job_date);
            $post['job_date'] =$job_date;
            //job date end

            //arrival time
            $e_arrival_time = $post['e_arrival_time'];
            if($e_arrival_time != "") {
                $e_arrival_time = $this->reconvert_datetime($e_arrival_time);
            }
            $post['e_arrival_time'] = $e_arrival_time;
            //arrival time end

            //setup time
            $e_setup_time = $post['e_setup_time'];
            if($e_setup_time != "") {
                $e_setup_time = $this->reconvert_datetime($e_setup_time);
            }
            $post['e_setup_time'] = $e_setup_time;
            //setup time end

            //pickup time
            $e_pickup_time = $post['e_pickup_time'];
            if($e_pickup_time != "") {
                $e_pickup_time = $this->reconvert_datetime($e_pickup_time);
            }
            $post['e_pickup_time'] = $e_pickup_time;
            //pickup time end

            $job->last_changed = Time::now();
            $this->loadModel('Employees');
            $staff = $this->Employees->get($this->Auth->user('id'));
            $job->edited_by = $staff->full_name;


            $job = $this->Jobs->patchEntity($job,$post);

            if ($this->Jobs->save($job)) {
                    $this->Flash->success(__('The job has been saved.'));
                    return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $sites = $this->Jobs->Sites->find('list', [
            'keyField' => 'id',
            'valueField' => function ($site) {
                return $site->get('label');
            }
        ]);
        $eventTypes = $this->Jobs->EventTypes->find('list');
        $customers = $this->Jobs->Customers->find('all', [
            'contain' => ['CustTypes'],
            'keyField' => 'id',
            'valueField' => function ($customer) {
                return $customer->get('label');
            }
        ]);
        $employees = $this->Jobs->Employees->find('list');
        $this->loadModel('CustTypes');
        $CustTypes = $this->CustTypes->find('list');
        $this->loadModel('Contacts');
        $contacts = $this->Contacts->find('list', [
            'keyField' => 'id',
            'valueField' => function ($contact) {
                return $contact->get('label');
            }
        ]);
        $this->set(compact('job', 'sites', 'eventTypes', 'customers', 'employees', 'CustTypes','contacts'));
        $status = $this->Jobs->get($id)->job_status;
        if ($status == 'Quote'){
            $this->set('statusOptions', array('Quote' => 'Quote', 'Order'=>'Order'));
        }
        elseif ($status == 'Order'){
            $this->set('statusOptions', array('Quote' => 'Quote', 'Order'=>'Order', 'Ready'=>'Ready'));
        }
        elseif ($status == 'Ready'){
            $this->set('statusOptions', array( 'Order' => 'Order', 'Ready'=>'Ready', 'Completed'=>'Completed'));
        }
        elseif ($status == 'Completed'){
            $this->set('statusOptions', array('Ready' => 'Ready', 'Completed'=>'Completed', 'Invoice'=>'Invoice'));
        }
        else{
            $this->set('statusOptions', array('Completed' => 'Completed', 'Invoice'=>'Invoice', 'Paid'=>'Paid'));
        }

        $this->loadModel('Stocks');
        $stocks = $this->Stocks->find('list');
        $this->set(compact('stocks'));
    }

    /**
     * invoiced method
     *
     * change job status to 'invoice'
     * change job status to 'invoice'
     * change job status to 'invoice'
     */

    public function invoice($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => []
        ]);
        $job->job_status = 'Invoice';

        if ($this->Jobs->save($job)) {
            $this->Flash->success(__('Job status updated'));
        }
        else{
            $this->Flash->error(__('Job status cannot be updated. Please, try again.'));

        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * paid method
     *
     * change job status to 'paid'
     * change job status to 'paid'
     * change job status to 'paid'
     */

    public function paid($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => []
        ]);
        $job->job_status = 'Paid';

        if ($this->Jobs->save($job)) {
            $this->Flash->success(__('Job status updated'));
        }
        else{
            $this->Flash->error(__('Job status cannot be updated. Please, try again.'));

        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function delete($id = null)
    {
        if($this->Auth->user('access_level')=='3'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $this->request->allowMethod(['get', 'delete']);

        $job = $this->Jobs->get($id);

        $job->last_changed = Time::now();
        $this->loadModel('Employees');
        $staff = $this->Employees->get($this->Auth->user('id'));
        $job->edited_by = $staff->full_name;
        $job->is_deleted = '1';


        if ($this->Jobs->save($job)) {
            $this->Flash->success(__('The job has been deleted.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The job could not be deleted. Please, try again.'));

        return $this->redirect(['action' => 'index']);
    }

    public function addpickup()
    {   if($this->Auth->user('access_level')=='3'){
        $this->Flash->set(__('You have no authorization to access this page as a field staff'));
        return $this->redirect($this->Auth->redirectUrl());
    }

        $job = $this->Jobs->newEntity();
        if ($this->request->is('post')) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData(),[
                'associated' => [
                    'customers'
                ]
            ]);
            $job->last_changed = Time::now();
            $this->loadModel('Employees');
            $staff = $this->Employees->get($this->Auth->user('id'));
            $job->edited_by = $staff->full_name;
            $job->employee_id = $this->Auth->user('id');

            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));

        }
        $sites = $this->Jobs->Sites->find('list', [
            'keyField' => 'id',
            'valueField' => function ($site) {
                return $site->get('label');
            }
        ]);
        $eventTypes = $this->Jobs->EventTypes->find('list');

        $customers = $this->Jobs->Customers->find('all', [
            'contain' => ['CustTypes'],
            'keyField' => 'id',
            'valueField' => function ($customer) {
                return $customer->get('label');
            }
        ]);
        $employees = $this->Jobs->Employees->find('list');
        $this->loadModel('Contacts');
        $contacts = $this->Contacts->find('list', [
            'keyField' => 'id',
            'valueField' => function ($contact) {
                return $contact->get('label');
            }
        ]);
        $this->loadModel('CustTypes');
        $CustTypes = $this->CustTypes->find('list');
        $this->loadModel('Stocks');
        $stocks = $this->Stocks->find('list');
        //$csrfToken = $this->request->getParam('_csrfToken');
        $this->set(compact('job', 'sites', 'eventTypes', 'customers', 'employees','CustTypes','contacts', 'stocks'));
        $this->set('statusOptions', array('Quote' => 'Quote', 'Order'=>'Order', 'Ready'=>'Ready', 'Completed'=>'Completed', 'Invoice'=>'Invoice', 'Paid'=>'Paid'));
    }

    public function undelete($id = null)
    {
        if($this->Auth->user('access_level')!='1'){
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $this->request->allowMethod(['get', 'delete']);

        $job = $this->Jobs->get($id);

        $job->last_changed = Time::now();
        $this->loadModel('Employees');
        $staff = $this->Employees->get($this->Auth->user('id'));
        $job->edited_by = $staff->full_name;
        $job->is_deleted = '0';


        if ($this->Jobs->save($job)) {
            $this->Flash->success(__('The job has been undeleted.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The job could not be undeleted. Please, try again.'));

        return $this->redirect(['action' => 'index']);

    }






    public function editpickup($id = null){
        if ($this->Auth->user('access_level') == '3') {
            $this->Flash->set(__('You have no authorization to access this page as a field staff'));
            return $this->redirect($this->Auth->redirectUrl());
        }

        $job = $this->Jobs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            $job->last_changed = Time::now();
            $this->loadModel('Employees');
            $staff = $this->Employees->get($this->Auth->user('id'));
            $job->edited_by = $staff->full_name;

            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $sites = $this->Jobs->Sites->find('list', [
            'keyField' => 'id',
            'valueField' => function ($site) {
                return $site->get('label');
            }
        ]);
        $eventTypes = $this->Jobs->EventTypes->find('list');
        $customers = $this->Jobs->Customers->find('all', [
            'contain' => ['CustTypes'],
            'keyField' => 'id',
            'valueField' => function ($customer) {
                return $customer->get('label');
            }
        ]);
        $employees = $this->Jobs->Employees->find('list');
        $this->loadModel('CustTypes');
        $custTypes = $this->CustTypes->find('list');
        $this->loadModel('Contacts');
        $contacts = $this->Contacts->find('list');
        $this->set(compact('job', 'sites', 'eventTypes', 'customers', 'employees', 'custTypes','contacts'));
        $status = $this->Jobs->get($id)->job_status;
        if ($status == 'Quote'){
            $this->set('statusOptions', array('Quote' => 'Quote', 'Order'=>'Order'));
        }
        elseif ($status == 'Order'){
            $this->set('statusOptions', array('Order'=>'Order', 'Ready'=>'Ready'));
        }
        elseif ($status == 'Ready'){
            $this->set('statusOptions', array('Ready'=>'Ready', 'Completed'=>'Completed'));
        }
        elseif ($status == 'Completed'){
            $this->set('statusOptions', array('Completed'=>'Completed', 'Invoice'=>'Invoice'));
        }
        else{
            $this->set('statusOptions', array('Invoice'=>'Invoice', 'Paid'=>'Paid'));
        }

        $this->loadModel('Stocks');
        $stocks = $this->Stocks->find('list');
        $this->set(compact('stocks'));
    }

    public function viewpickup($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Sites', 'EventTypes', 'Customers', 'Employees', 'Images']
        ]);

        $this->set('job', $job);
    }

    public function orderview($id = null)
    {    //save job status
        $JobsTable = TableRegistry::get('Jobs');
        $jobs = $JobsTable->get($id); // Return article with id
        $jobs->job_status = 'Order';
        $JobsTable->save($jobs);
        //--------------------



        $job = $this->Jobs->get($id, [
            'contain' => ['Sites', 'EventTypes', 'Customers', 'Employees', 'Images','Contacts']
        ]);

        $this->loadModel('Sites');
        $site = $this->Sites->get($job->site_id);

        $this->set('site', $site);
        $this->set('job', $job);
    }

    public function readyview($id = null)
{    //save job status
    $this->Flash->success(__('The job status has changed to Ready'));
    $JobsTable = TableRegistry::get('Jobs');
    $jobs = $JobsTable->get($id); // Return article with id
    $jobs->job_status = 'Ready';
    $JobsTable->save($jobs);
    //--------------------
    $job = $this->Jobs->get($id, [
        'contain' => ['Sites', 'EventTypes', 'Customers', 'Employees', 'Images','Contacts']
    ]);

    $this->loadModel('Sites');
    $site = $this->Sites->get($job->site_id);

    $this->set('site', $site);
    $this->set('job', $job);
}
    public function completedview($id = null)
    {

        //save job status
        $this->Flash->success(__('The job status has changed to Completed'));
        $JobsTable = TableRegistry::get('Jobs');
        $jobs = $JobsTable->get($id); // Return article with id
        $jobs->job_status = 'Completed';
        $JobsTable->save($jobs);
        //--------------------


        $job = $this->Jobs->get($id, [
            'contain' => ['Sites', 'EventTypes', 'Customers', 'Employees', 'Images','Contacts']
        ]);

        $this->loadModel('Sites');
        $site = $this->Sites->get($job->site_id);

        $this->set('site', $site);
        $this->set('job', $job);
    }

}
