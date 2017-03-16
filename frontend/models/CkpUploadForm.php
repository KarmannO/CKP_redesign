<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 14.03.2017
 * Time: 16:25
 */

namespace frontend\models;


use common\models\CkpDocument;
use common\models\User;
use yii\base\Model;
use yii\base\Security;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

class CkpUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Загрузите файл'
        ];
    }

    public function upload($ckp)
    {
        if(!$this->validate())
            return false;
        $fileupload = UploadedFile::getInstance($this, 'file');
        if(!empty($fileupload)) {
            $directory = \Yii::$app->params['uploadPath'] . $ckp;
            if (!is_dir($directory)) {
                BaseFileHelper::createDirectory($directory);
            }
            $filename = $directory . '/' . $fileupload->baseName . '.' . $fileupload->extension;

            $ckp_document = new CkpDocument();
            $ckp_document->ckp = $ckp;
            $ckp_document->path = $filename;
            $ckp_document->short_path = $fileupload->baseName . '.' . $fileupload->extension;
            $ckp_document->user = User::getCurrentUser()->id;
            $ckp_document->time = time();
            $ckp_document->hash = \Yii::$app->security->generateRandomString(16);

            $ckp_document->save();

            $fileupload->saveAs($filename);

            return true;
        }
    }
}