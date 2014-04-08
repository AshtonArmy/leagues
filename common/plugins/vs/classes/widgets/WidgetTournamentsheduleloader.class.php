<?php

class PluginVs_WidgetTournamentsheduleloader extends Widget {
    public function Exec() {
		 
		if( $this->GetParam('oTournament') ){
			$oTournament=$this->GetParam('oTournament');
		}
		if( $this->GetParam('myteam') ){
			$myteam=$this->GetParam('myteam');
		}		
		if($oTournament){
			
			$this->oUserCurrent=$this->User_GetUserCurrent();
			
			if( $this->GetParam('myteam') ){
				$myteam=$this->GetParam('myteam');
			}else{
				$myteam=0;
			}
			if ($myteam==0)$myteam = $this->PluginVs_Stat_GetMyTeam($oTournament);
			
			//Блок матчей - задолженных, текущих, ближайших 
			if($myteam<>0){
				$aBlockMatches = $this->PluginVs_Stat_GetMatchesItemsByFilter(array(
					'tournament_id' => $oTournament->getTournamentId(),
					'#where' => array('(away = (?d) or home = (?d) ) and week(dates,1)=(?d)' => array($myteam, $myteam, date('W', time()))),				
					//'team_id not in'=>$arr_teams,
					'#with'         => array('hometeam','awayteam')
				));
				
				$this->Viewer_Assign('aBlockMatches',$aBlockMatches);			
			
				$this->Viewer_Assign('myteam',$myteam);	
				$month=intval(date('n', time()));
				$year=intval(date('Y', time()));
				
				
				$aMatches=$this->PluginVs_Stat_MonthMatches($oTournament->getTournamentId(), $myteam, $month);
				
				
				$running_day = date('w',mktime(0,0,0,$month,1,$year));
				$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
				$days_in_this_week = 1;
				$day_counter = 0;
				$dates_array = array();
				if($running_day==0)$running_day=7;
				for($x = 1; $x < $running_day; $x++){
					$dates_array[1][$x]['day']=0;
					$days_in_this_week++;
				}
				$week=1;
			  /* keep going with days.... */
				for($list_day = 1; $list_day <= $days_in_month; $list_day++){
					$x++;
					$dates_array[$week][$x]['day']=$list_day;
					  /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
						if($aMatches)					  
						foreach($aMatches as $oMatch) {
								if($oMatch['day']==$list_day){
									$dates_array[$week][$x]['logo']=$oMatch['logo'];
									$dates_array[$week][$x]['css']=$oMatch['css'];
									$dates_array[$week][$x]['played']=$oMatch['played'];
									$dates_array[$week][$x]['status']=$oMatch['status'];
									$dates_array[$week][$x]['ot']=$oMatch['ot'];
									$dates_array[$week][$x]['so']=$oMatch['so'];
									$dates_array[$week][$x]['teh']=$oMatch['teh'];
									$dates_array[$week][$x]['goals_home']=$oMatch['goals_home'];
									$dates_array[$week][$x]['goals_away']=$oMatch['goals_away'];
									$dates_array[$week][$x]['g_c']=$oMatch['g_c'];
								}
						}	
					if($running_day == 7){
						if(($day_counter+1) != $days_in_month){
							$week++;
						}
						$running_day = 0;
						$days_in_this_week = 0;
					}
					$days_in_this_week++; $running_day++; $day_counter++;
				}

			  /* finish the rest of the days in the week */
			  if($days_in_this_week < 8 && $days_in_this_week<>1){
				for($x = 1; $x <= (8 - $days_in_this_week); $x++){
				  $dates_array[$week][$x]['day']=0;
				}
			  }
			  $this->Viewer_Assign('dates_array',$dates_array);
			  $this->Viewer_Assign('month',$month);
			  $this->Viewer_Assign('year',$year);
		  }
		  $this->Viewer_Assign('oTournament',$oTournament);
		  $this->Viewer_Assign('tournament_id',$oTournament->getTournamentId());
		
		//Блок матчей - задолженных, текущих, ближайших	
		}
    }
}
?>