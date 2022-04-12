<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $idFotografia
 * @property string|null $email
 * @property string|null $full_name
 * @property int|null $genero
 * @property string|null $dataNascimento
 * @property string|null $telefone
 * @property string|null $morada
 * @property string|null $localidade
 * @property string|null $codPostal
 * @property int|null $nif
 * @property string|null $nib
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $timezone
 *
 * @property Fotografia $idFotografia0
 * @property User $user
 */
class Profile2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'idFotografia', 'genero', 'nif'], 'integer'],
            [['dataNascimento', 'created_at', 'updated_at'], 'safe'],
            [['email'], 'string', 'max' => 70],
            [['full_name', 'timezone'], 'string', 'max' => 255],
            [['telefone', 'codPostal'], 'string', 'max' => 15],
            [['morada'], 'string', 'max' => 150],
            [['localidade', 'nib'], 'string', 'max' => 50],
            [['idFotografia'], 'exist', 'skipOnError' => true, 'targetClass' => Fotografia::className(), 'targetAttribute' => ['idFotografia' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'idFotografia' => 'Id Fotografia',
            'email' => 'Email',
            'full_name' => 'Full Name',
            'genero' => 'Genero',
            'dataNascimento' => 'Data Nascimento',
            'telefone' => 'Telefone',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'codPostal' => 'Cod Postal',
            'nif' => 'Nif',
            'nib' => 'Nib',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'timezone' => 'Timezone',
        ];
    }

    /**
     * Gets query for [[IdFotografia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFotografia0()
    {
        return $this->hasOne(Fotografia::className(), ['id' => 'idFotografia']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
