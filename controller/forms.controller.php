<?php 

class FormsController {
    
    static public function ctrLogin($email, $password){
        $response = FormsModel::mdlGetUsers('email', $email);
        
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

    static public function ctrGetUsers($item, $value){
        return FormsModel::mdlGetUsers($item, $value);
    }

    static public function ctrChangeLanguage($language, $idUser){
        $response = FormsModel::mdlChangeLanguage($language, $idUser);
        return $response;
    }

    static public function ctrGetProject() {
        $response = FormsModel::mdlGetProject();
        return $response;
    }

    static public function ctrGetTeams() {
        $response = FormsModel::mdlGetTeams();
        return $response;
    }

    static public function ctrGetEvents() {
        $response = FormsModel::mdlGetEvents();
        return $response;
    }

    static public function ctrAddTeam($data) {
        $response = FormsModel::mdlAddTeam($data);
        return $response;
    }

    static public function ctrAddProject($data) {
        $response = FormsModel::mdlAddProject($data);
        return $response;
    }
}