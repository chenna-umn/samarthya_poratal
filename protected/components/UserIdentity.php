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
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{           
		$user=User::model()->find('LOWER(username)=?',array(strtolower($this->username)));  
               
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($user->password<>md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{ 
                    
                  
                    
                    if(isset($user->user_type) && !empty($user->user_type)){
                                if($user->user_type==1){
                                $this->_id=$user->id;
                                $this->username=$user->username;
                                $this->errorCode=self::ERROR_NONE;
                                $this->setState('userId',$user->id);
                                $this->setState('userType',$user->user_type);
                                $this->setState('username',$user->username);
                                $this->setState('firstname',$user->staff_name);
                                $this->setState('loggedInAt',date('Y-m-d h:i:s'));
                                $this->setState('isAdmin',1);
                            }else if($user->user_type==2){
                                $this->_id=$user->id;
                                $this->username=$user->username;
                                $this->errorCode=self::ERROR_NONE;
                                $this->setState('memId',$user->id);
                                $this->setState('userType',$user->user_type);
                                $this->setState('memname',$user->username);
                                $this->setState('firstname',$user->staff_name);
                                $this->setState('memloggedInAt',date('Y-m-d h:i:s'));
                                $this->setState('isMember',1);
                            }
                        }else{
                                $this->errorCode=self::ERROR_USERNAME_INVALID;
                        }
                    
		}
             
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}