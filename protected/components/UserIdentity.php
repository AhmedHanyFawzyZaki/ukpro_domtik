<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'username = "' . $this->username . '" or lower(email) = "' . strtolower($this->username) . '"';
		$user = User::model()->find($criteria);

		if($user === null){
	        $this->errorCode=self::ERROR_USERNAME_INVALID;
		}else if($user->check($this->password)){
			$this->_id=$user->id;
			$this->setState('username', $user->username);
			$this->setState('fname', $user->fname);
			$this->setState('lname', $user->lname);
			$this->setState('email', $user->email);
			$this->setState('group', $user->groups_id);
			$this->setState('admin_last_login', $user->last_login);
			$this->setState('admin_image', $user->image);
			$this->setState('user_active', $user->active);
			// save last login
			$user->last_login=date("Y-m-d H:i:s");
			$user->save(false);

			$this->errorCode=self::ERROR_NONE;

		}else{
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}


		return !$this->errorCode;

	}



	public function getId()
	{
		return $this->_id;
	}

}
