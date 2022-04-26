<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotografia".
 *
 * @property int $id
 * @property string $link
 *
 * @property FotografiaLote[] $fotografiaLotes
 * @property FotografiaProduto[] $fotografiaProdutos
 * @property Utilizador[] $utilizadors
 */
class Fotografia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotografia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link'], 'required'],
            [['link'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
        ];
    }

    /**
     * Gets query for [[FotografiaLotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotografiaLotes()
    {
        return $this->hasMany(FotografiaLote::className(), ['idFotografia' => 'id']);
    }

    /**
     * Gets query for [[FotografiaProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotografiaProdutos()
    {
        return $this->hasMany(FotografiaProduto::className(), ['idFotografia' => 'id']);
    }

    /**
     * Gets query for [[Utilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors()
    {
        return $this->hasMany(Utilizador::className(), ['idFotografia' => 'id']);
    }

    public static function registrarFotografia($link){
        $model = new Fotografia();
        $model->link = $link;
        if($model->save()){
            return $model->id;
        }
        return false;
    }
}
