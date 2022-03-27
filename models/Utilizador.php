<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $id
 * @property int $tipoUtilizador
 * @property int $idFotografia
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string|null $nome
 * @property string|null $telefone
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property string|null $morada
 * @property string|null $localidade
 * @property string|null $codPostal
 * @property int|null $nif
 * @property string|null $nib
 * @property string|null $dataCriacao
 *
 * @property Fotografia $idFotografia0
 * @property Logs[] $logs
 * @property Pedido[] $pedidos
 * @property Tipoutilizador $tipoUtilizador0
 */
class Utilizador extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'unique'],
            [['tipoUtilizador', 'idFotografia', 'username', 'password', 'email'], 'required'],
            [['tipoUtilizador', 'idFotografia', 'nif'], 'integer'],
            [['dataCriacao'], 'safe'],
            [['username', 'localidade', 'nib'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 70],
            [['nome', 'morada'], 'string', 'max' => 150],
            [['telefone', 'codPostal'], 'string', 'max' => 15],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
            [['idFotografia'], 'exist', 'skipOnError' => true, 'targetClass' => Fotografia::className(), 'targetAttribute' => ['idFotografia' => 'id']],
            [['tipoUtilizador'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoutilizador::className(), 'targetAttribute' => ['tipoUtilizador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipoUtilizador' => 'Tipo Utilizador',
            'idFotografia' => 'Id Fotografia',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'nome' => 'Nome',
            'telefone' => 'Telefone',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'codPostal' => 'Cod Postal',
            'nif' => 'Nif',
            'nib' => 'Nib',
            'dataCriacao' => 'Data Criacao',
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
     * Gets query for [[Logs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['idUtilizador' => 'id']);
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idUtilizador' => 'id']);
    }

    /**
     * Gets query for [[TipoUtilizador0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUtilizador0()
    {
        return $this->hasOne(Tipoutilizador::className(), ['id' => 'tipoUtilizador']);
    }

    //migrado do User.php
    public function validatePassword($password)
    {
        //return $this->password === $password;

        //teste 0303
        //return $this->password === password_hash($password, PASSWORD_ARGON2I);

        return password_verify($password, $this->password);
    }

    public function getId()
    {
       return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public static function findIdentityByAccessToken($token, $type=null){
        return self::findOne(['accessToken'=>$token]);
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findByUsername($username){
        $findUser = Utilizador::find()->where(['like', 'username', $username])->one();

        if ($findUser != false){
            return $findUser;
        }

        return null;
    }
}
