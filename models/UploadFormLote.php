<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadFormLote extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    public $idProduto;
    public $codigo_lote;
    public $idLocalArmazem;
    public $idLocalExtracao;
    public $quantidade;
    public $dataHora;

    public function rules()
    {
        return [
            [['idProduto', 'idLocalExtracao', 'idLocalArmazem'], 'integer'],
            [['quantidade'], 'number'],
            [['dataHora'], 'safe'],
            [['idLocalExtracao'], 'exist', 'skipOnError' => true, 'targetClass' => Localextracao::className(), 'targetAttribute' => ['idLocalExtracao' => 'id']],
            [['idLocalArmazem'], 'exist', 'skipOnError' => true, 'targetClass' => Localarmazem::className(), 'targetAttribute' => ['idLocalArmazem' => 'id']],
            [['idProduto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['idProduto' => 'id']],
            [['imageFiles'], 'file', 'checkExtensionByMimeType' => false, 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProduto' => 'Produto',
            'quantidade' => 'Quantidade',
            'idLocalExtracao' => 'Local Extracão',
            'idLocalArmazem' => 'Local Armazem',
            'dataHora' => 'Data Hora',
        ];
    }


    /*
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }*/

    public function uploadLotePictures($idProduto){

        $codigo_lote = Lote::gerarCodigoLote($idProduto);
        $this->codigo_lote = $codigo_lote;

        FileHelper::createDirectory('uploads/lotes/' . $codigo_lote . '/', 0775);
        if ($this->validate(['imageFiles'])) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/lotes/' . $codigo_lote . '/' . $file->baseName . '.' . $file->extension);
            }

            $modelLote = new Lote();


            $modelLote->idProduto = $this->idProduto;
            $modelLote->codigo_lote = $this->codigo_lote;
            $modelLote->idLocalArmazem = $this->idLocalArmazem;
            $modelLote->idLocalExtracao = $this->idLocalExtracao;
            $modelLote->quantidade = $this->quantidade;
            $modelLote->dataHora = $this->dataHora;

            if($modelLote->validate() && $modelLote->save()){
                return true;
            } else {
                return false;
            }


        } else {
            return false;
        }
    }
}