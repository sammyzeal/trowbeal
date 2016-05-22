<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "products".
 *
 * @property integer $product_id
 * @property integer $type_id
 * @property string $type_name
 * @property string $name
 * @property string $descr
 * @property integer $status
 * @property double $price
 * @property string $image
 * @property integer $added_at
 * @property integer $updated_at
 * @property integer $views
 * @property string $reviews
 *
 * @property ProductOrder[] $productOrders
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $productSearch;
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'type_name', 'name', 'descr', 'price'], 'required'],
            [['type_id', 'status', 'added_at', 'updated_at', 'views'], 'integer'],
            [['price'], 'number'],
            [['type_name', 'descr', 'image', 'reviews'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           
            'type_id' => 'Type ID',
            'cat_id' => 'Categories',
           'product_id' => 'ID',
            'type_name' => 'Type',
            'name' => 'Name',
            'descr' => 'Description',
            'status' => 'Status',
            'price' => 'Price',
            'image' => 'Image',
            'added_at' => 'Added At',
            'updated_at' => 'Updated At',
            'views' => 'Views',
            'reviews' => 'Reviews',
            'productSearch' => 'Search Product',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::className(), ['product_id' => 'product_id']);
    }
}
