<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;



/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $user_id = $model['user_id'];
            $user_type_id = $model['user_type_id'];
            $department_id = $model['department_id'];

            $connection = Yii::$app->getDb();

                // Query to Fetch basic salary from user_type table by using user_type_id ...
            $command = $connection->createCommand("SELECT basic_salary from  user_type  where  user_type_id = '$user_type_id'");
            $model = $command->queryOne();

            $basic_salary = $model['basic_salary'];

                //Query to Fetch commission_percentage,allowance_payable,last_month_deduction from Department Table by using depsrtment_id ....
            $command = $connection->createCommand("SELECT commission_percentage,allowance_payable,last_month_deduction from  department  where  department_id = '$department_id'");
            $model = $command->queryOne();

            $commission_percentage = $model['commission_percentage'];
            $allowance_payable = $model['allowance_payable'];
            $last_month_deduction = $model['last_month_deduction'];

                //Calculating Payable_salary based on the formula ...
             $payable_salary = $basic_salary + ($basic_salary*$commission_percentage/100) + $allowance_payable - $last_month_deduction ;

                // Querys to fetch tax_percentage
            $command = $connection->createCommand("SELECT payable_tax_charge_id, min(payable_salary_upto)  FROM payable_salary_tax_charge WHERE payable_salary_upto >= '$payable_salary' ");
            $model = $command->queryOne();

            $payable_tax_charge_id = $model['payable_tax_charge_id'];

            $command = $connection->createCommand("SELECT tax_pecentage_value FROM payable_salary_tax_charge WHERE payable_tax_charge_id = '$payable_tax_charge_id' ");
            $model = $command->queryOne();

            $tax_pecentage = $model['tax_pecentage_value'];

            //Formula to calculate Tax Value ...

            $tax_value = $payable_salary * $tax_pecentage/100; 
        
        $command = $connection->createCommand("INSERT INTO  user_accounts (user_id, payable_salary, basic_salary,tax_value)
        VALUES ('$user_id', '$payable_salary', '$basic_salary','$tax_value');")
        ->execute(); 

            return $this->redirect(['view', 'id' =>$user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $user_id = $model['user_id'];
            $user_type_id = $model['user_type_id'];
            $department_id = $model['department_id'];

            $connection = Yii::$app->getDb();

                // Query to Fetch basic salary from user_type table by using user_type_id ...
            $command = $connection->createCommand("SELECT basic_salary from  user_type  where  user_type_id = '$user_type_id'");
            $model = $command->queryOne();

            $basic_salary = $model['basic_salary'];

                //Query to Fetch commission_percentage,allowance_payable,last_month_deduction from Department Table by using depsrtment_id ....
            $command = $connection->createCommand("SELECT commission_percentage,allowance_payable,last_month_deduction from  department  where  department_id = '$department_id'");
            $model = $command->queryOne();

            $commission_percentage = $model['commission_percentage'];
            $allowance_payable = $model['allowance_payable'];
            $last_month_deduction = $model['last_month_deduction'];

                //Calculating Payable_salary based on the formula ...
             $payable_salary = $basic_salary + ($basic_salary*$commission_percentage/100) + $allowance_payable - $last_month_deduction ;

                // Querys to fetch tax_percentage
            $command = $connection->createCommand("SELECT payable_tax_charge_id, min(payable_salary_upto)  FROM payable_salary_tax_charge WHERE payable_salary_upto >= '$payable_salary' ");
            $model = $command->queryOne();

            $payable_tax_charge_id = $model['payable_tax_charge_id'];

            $command = $connection->createCommand("SELECT tax_pecentage_value FROM payable_salary_tax_charge WHERE payable_tax_charge_id = '$payable_tax_charge_id' ");
            $model = $command->queryOne();

            $tax_pecentage = $model['tax_pecentage_value'];

            //Formula to calculate Tax Value ...

            $tax_value = $payable_salary * $tax_pecentage/100; 
        
        $command = $connection->createCommand("UPDATE  user_accounts set  payable_salary = '$payable_salary', basic_salary = '$basic_salary',tax_value ='$tax_value' where user_id = '$user_id' ")->execute();  
            return $this->redirect(['view', 'id' => $user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionUser_view()
    {

        
          $dataProvider = new SqlDataProvider([
        'sql' => 'SELECT * from users_view'

    ]);

           
        return $this->render('user_view', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
