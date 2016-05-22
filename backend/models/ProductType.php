<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $type_id
 * @property string $name
 * @property integer $pid
 * @property string $path
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pid', 'path', 'type_id'], 'required'],
            [['pid','type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'name' => 'Name',
            'pid' => 'Pid',
            'path' => 'Path',
        ];
    }
}
