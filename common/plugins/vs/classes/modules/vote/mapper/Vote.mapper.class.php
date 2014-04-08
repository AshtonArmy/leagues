<?php

class PluginVs_ModuleVote_MapperVote extends Mapper {


public function GetUserVotes($FromWhere, $id) {
	$sql = "SELECT 	u.user_id, 
					u.user_login,  
					v.vote_value
			FROM ".Config::Get('db.table.vote')." v, ".Config::Get('db.table.user')." u  
			WHERE v.target_type = ?s 
				and v.user_voter_id=u.user_id
				and v.target_id = ?d
				and v.vote_value<>0
			order by v.vote_date";				
			
		$aVotes=array();
		if ($aRows=$this->oDb->select($sql, $FromWhere, $id)) {			
			foreach ($aRows as $aVote) {
				if($FromWhere != 'blog' && $FromWhere != 'user'){
					$vote=round($aVote['vote_value'],0);
				}else{
					$vote=round($aVote['vote_value'],2);
				}
				$aVotes[]=array(
					'uid' => $aVote['user_id'],
					'attitude' => $vote,
					'login' => $aVote['user_login'],
				);
				
			}
		}

		return $aVotes;
	}
}

?>