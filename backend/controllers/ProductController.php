<?php

namespace backend\controllers;

use Yii;
use backend\models\Products;
use backend\models\ProductType;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use backend\models\UploadForm;
use yii\Validators\FileValidator;
use yiimodules\categories\models\Categories;



/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=> ['index','create','update','delete'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //$models = $dataProvider->getModels();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'models' => $models,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Products();
        $upload = new UploadForm();
        
      
        if($model->load(Yii::$app->request->post())){
            //load the form
            $upload->image = UploadedFile::getInstance($model, 'image');
            //load the image with instance of Uploadform class
            
            $name = ProductType::findOne($model->type_id);
            //print_r($name['name']);
            //exit;
            
            if($upload->upload()){
                $model->added_at = time();
                $model->type_name = $name['name'];
                $model->image = $upload->fileDirectory;
                $model->save();
                return $this->redirect(['view', 'id' => $model->product_id]);
            }
         } else{
                return $this->renderAjax('create', [
                'model' => $model,
                
                
              ]);
 
            }
        
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $upload = new UploadForm();
        
        if($model->load(Yii::$app->request->post())){
            //load the form
            $upload->image = UploadedFile::getInstance($model, 'image');
            //load the image with instance of Uploadform class
               
                if($upload->image !== null){
                     $upload->upload();
                     $model->image = $upload->fileDirectory;
                    
                
            }else{
                $oldImg = $this->findModel($id);
                $model->image = $oldImg['image']; //old atribute value i.e old image
            }
              
                $name = ProductType::findOne($model->type_id);
                $model->updated_at = time();
                $model->type_name = $name['name'];
                $oldImg = $this->findModel($id);
                $fileName = $oldImg['image']; 
                $path = \Yii::getAlias("@backend/web/");
               if($upload->image !== null){
                    unlink($path.$fileName);
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->product_id]);
            
         }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($model = $this->findModel($id)){
            $model = $this->findModel($id);
            $fileName = $model['image'];
            $path = \Yii::getAlias("@backend/web/");
        }
      if(unlink($path.$fileName)){
            $model->delete();
            Yii::$app->session->setFlash('success','delete succussfully!') ;
        }
        

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLists($id)
    {
        $countCategories = Categories::find() ->where(['parent_id' => $id]) ->count();
 
        $Categories = Categories::find() ->where(['parent_id' => $id]) ->all();
        
 
        if($countCategories>0){
            foreach($Categories as $Category){
                echo "<option value='".$Category->id."'>".$Category->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
 
    }
    
}
