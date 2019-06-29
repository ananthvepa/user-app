<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $department_id
 * @property string $department_name
 * @property int $commission_percentage
 * @property double $allowance_payable
 * @property double $last_month_deduction
 *
 * @property User[] $users
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'department_name', 'commission_percentage', 'allowance_payable', 'last_month_deduction'], 'required'],
            [['department_id', 'commission_percentage'], 'integer'],
            [['allowance_payable', 'last_month_deduction'], 'number'],
            [['department_name'], 'string', 'max' => 20],
            [['department_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'commission_percentage' => 'Commission Percentage',
            'allowance_payable' => 'Allowance Payable',
            'last_month_deduction' => 'Last Month Deduction',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['department_id' => 'department_id']);
    }
}
