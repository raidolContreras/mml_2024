<?php 

class FormsController {
    static public function ctrLogin($email, $password){
        $response = FormsModel::mdlGetUsers($email);
        
		$cryptPassword = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        if (!empty($response)){
            if($response['password'] == $cryptPassword){
                if ($response['status'] == 1) {
                    $response['sesion'] = "ok";
                    return $response;
                } else {
                    return 'Error: Suspendido';
                }
            } else {
                return 'Error: Password incorrect';
            }
        } else {
            return 'Error: Email does not contain';
        }
    }

    static public function ctrChangeLanguage($language, $idUser){
        $response = FormsModel::mdlChangeLanguage($language, $idUser);
        return $response;
    }
}