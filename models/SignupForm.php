<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $postcode;
    public $image;
    public $mobile_number;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['postcode', 'required'],
            ['postcode', 'string', 'max' => 8],

            ['mobile_number', 'required'],
            ['mobile_number', 'string', 'max' => 13],

            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, svg', 'maxFiles' => 1],

        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->postcode = $this->postcode;
        $user->mobile_number = $this->mobile_number;
        if ($this->image){
            $user->image = $this->image;
            if ($user->upload()) {
                $user->profile_picture = $user->image->name;
            }
        }
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
