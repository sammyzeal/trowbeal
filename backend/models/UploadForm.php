<?php

namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\Validators\FileValidator;
use Yii;





class UploadForm extends Model 
{
   
 /**
     * @var UploadedFile
    
 */
    
public $image;
public $randomCharacter;
public $fileDirectory;

    
    
public function rules()
   {
        
        return[
         
                  [['image'], 'file', 'skipOnEmpty' => false,  'extensions'=> 'png, jpg,jpeg'],
              ];
   }
   

 public function upload()
   {
        
        $rand = Yii::$app->security->generateRandomString(15);
        //generate random filename
        $this->randomCharacter = $rand;
        //assign generated file name to randomCharacter property
        
        //define the upload path;
          if ($this->validate()){
                $path = \Yii::getAlias("@backend/web/");
                $this->fileDirectory = 'uploads/'.$this->randomCharacter .'.'.$this->image->extension;
                $this->image->saveAs($path.$this->fileDirectory );
               
                return true;
        }else{
            return false;
        }
       
    }
    
 
    
}





