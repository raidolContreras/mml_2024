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

    static public function ctrGetProject($item, $value) {
        $response = FormsModel::mdlGetProject($item, $value);
        return $response;
    }

    static public function ctrGetTeams($item, $value, $idProject) {
        $response = FormsModel::mdlGetTeams($item, $value, $idProject);
        return $response;
    }

    static public function ctrGetEvents($item, $value) {
        $response = FormsModel::mdlGetEvents($item, $value);
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
    
	static public function ctrAddLogo($data){
		$response = FormsModel::mdlAddLogo($data);
    	return $response;
	}
    
	static public function ctrAddEvent($eventName){
		$response = FormsModel::mdlAddEvent($eventName);
    	return $response;
	}

    static public function ctrAddUser($data){
        $response = FormsModel::mdlAddUser($data);
        $response2 = FormsModel::mdlAddUserToProject($response);
        return $response2;
    }

    static public function ctrUpdateUser($data, $idUser){
        $response = FormsModel::mdlUpdateUser($data, $idUser);
        return $response;
    }

    static public function ctrDeleteUser($item, $value){
        $response = FormsModel::mdlDeleteUser($item, $value);
        return $response;
    }

    static public function ctrUpdateProject($data, $idProject) {
        $response = FormsModel::mdlUpdateProject($data, $idProject);
        return $response;
    }

    static public function ctrDeleteProject($idProject) {
        $response = FormsModel::mdlDeleteProject($idProject);
        return $response;
    }

    static public function ctrUpdateTeam($data, $idTeam) {
        $response = FormsModel::mdlUpdateTeam($data, $idTeam);
        return $response;
    }

    static public function ctrDeleteTeam($idTeam) {
        $response = FormsModel::mdlDeleteTeam($idTeam);
        return $response;
    }

    static public function ctrUpdateEvent($eventName, $idEvent) {
        $response = FormsModel::mdlUpdateEvent($eventName, $idEvent);
        return $response;
    }

    static public function ctrDeleteEvent($idEvent) {
        $response = FormsModel::mdlDeleteEvent($idEvent);
        return $response;
    }

    static public function ctrChangeProjectActive($idProject, $idUser) {
        $response = FormsModel::mdlChangeProjectActive($idProject, $idUser);
        return $response;
    }

    static public function ctrUpdateColors($data) {
        $response = FormsModel::mdlUpdateColors($data);
        return $response;
    }

    static public function ctrAddParticipants($data, $idTeam) {
        $response = FormsModel::mdlAddParticipants($data, $idTeam);
        return $response;
    }

    static public function ctrGetParticipant($item, $value) {
        $response = FormsModel::mdlGetParticipant($item, $value);
        return $response;
    }

    static public function ctrUpdateTeamExtras($data) {
        $response = FormsModel::mdlUpdateTeamExtras($data);
        return $response;
    }

    static public function ctrUpdateParticipant($data) {
        $response = FormsModel::mdlUpdateParticipant($data);
        return $response;
    }

    static public function ctrDeleteParticipant($idParticipant) {
        $response = FormsModel::mdlDeleteParticipant($idParticipant);
        return $response;
    }

    static public function ctrGetProblemTree($idTeam, $idProject) {
        $response = FormsModel::mdlGetProblemTree($idTeam, $idProject);
        return $response;
    }

    static public function ctrAddMainProblem($data, $idTeam, $idProject) {
        $response = FormsModel::mdlAddMainProblem($data, $idTeam, $idProject);
        return $response;
    }

    static public function ctrAddMainObjetive($data, $idTeam, $idProject) {
        $response = FormsModel::mdlAddMainObjetive($data, $idTeam, $idProject);
        return $response;
    }

    static public function ctrUpdateMainProblems($data) {
        $response = FormsModel::mdlUpdateMainProblems($data);
        return $response;
    }

    static public function ctrUpdateMainGoals($data) {
        $response = FormsModel::mdlUpdateMainGoals($data);
        return $response;
    }

    static public function ctrGetStructure($idStructure) {
        $response = FormsModel::mdlGetStructure($idStructure);
        return $response;
    }

    static public function ctrSelectProblems($data) {
        $response = FormsModel::mdlSelectProblems($data);
        return $response;
    }

    static public function ctrGetOnlyStructure($idStructure) {
        $response = FormsModel::mdlGetOnlyStructure($idStructure);
        return $response;
    }

    static public function ctrUpdateStructure($data) {
        $response = FormsModel::mdlUpdateStructure($data);
        return $response;
    }

    static public function ctrAddMatrix($data) {
        $matrix = FormsModel::mdlSelectMatrix($data['idMatrix']);

        if (empty($matrix)) {
            $response = FormsModel::mdlAddMatrix($data);
        } else {
            $response = FormsModel::mdlUpdateMatrix($data);
        }

        return $response;
    }

    static public function ctrSearchStructureMatrix($idStructure, $activity) {
        $response = FormsModel::mdlSearchStructureMatrix($idStructure, $activity);
        return $response;
    }

    static public function ctrSearchReportsToMatrix($idMatrix) {
        $response = FormsModel::mdlSearchReportsToMatrix($idMatrix);
        return $response;
    }

    static public function ctrAddEvidence($idMatrix, $description, $progress) {
        $response = FormsModel::mdlAddEvidence($idMatrix, $description, $progress);
        return $response;
    }

    static public function ctrAddFilesEvidence($uploadId, $files) {
        $response = FormsModel::mdlAddFilesEvidence($uploadId, $files);
        return $response;
    }

    static public function ctrRemoveFileFromEvidence($uploadId, $files) {
        $response = FormsModel::mdlRemoveFileFromEvidence($uploadId, $files);
        return $response;
    }

    public static function ctrGetReportDetails($idReport) {
        return FormsModel::mdlGetReportDetails($idReport);
    }
    
    public static function ctrUpdateReport($idReport, $description, $progress) {
        return FormsModel::mdlUpdateReport($idReport, $description, $progress);
    }    

}