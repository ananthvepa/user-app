<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property int $user_type_id
 * @property string $user_type_name
 * @property double $basic_salary
 *
 * @property User[] $users
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type_id', 'user_type_name', 'basic_salary'], 'required'],
            [['user_type_id'], 'integer'],
            [['basic_salary'], 'number'],
            [['user_type_name'], 'string', 'max' => 20],
            [['user_type_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_type_id' => 'User Type ID',
            'user_type_name' => 'User Type Name',
            'basic_salary' => 'Basic Salary',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_type_id' => 'user_type_id']);
    }
}
