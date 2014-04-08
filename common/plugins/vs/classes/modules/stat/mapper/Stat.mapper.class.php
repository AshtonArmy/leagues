<?php

class PluginVs_ModuleStat_MapperStat extends Mapper {

	public function GetPlayersByFilter($aFilter,$aOrder,&$iCount,$iCurrPage,$iPerPage) {
		$aOrderAllow=array('user_id','user_login','user_date_register','user_rating','user_skill','user_profile_name');
		$sOrder='';
		foreach ($aOrder as $key=>$value) {
			if (!in_array($key,$aOrderAllow)) {
				unset($aOrder[$key]);
			} elseif (in_array($value,array('asc','desc'))) {
				$sOrder.=" {$key} {$value},";
			}
		}
		$sOrder=trim($sOrder,',');
		if ($sOrder=='') {
			$sOrder=' user_id desc ';
		}

		$sql = "SELECT
					u.user_id
				FROM
					".Config::Get('db.table.user')." u, tis_stat_player_tournament pt
				WHERE
					1 = 1
					{ AND u.user_id = ?d }
					{ AND u.user_mail = ? }
					{ AND u.user_password = ? }
					{ AND u.user_ip_register = ? }
					{ AND u.user_activate = ?d }
					{ AND u.user_activate_key = ? }
					{ AND u.user_profile_sex = ? }
					{ AND u.user_login LIKE ? }
					{ AND u.user_profile_name LIKE ? }
					AND u.user_id = pt.user_id
					AND p.tournament_id = 0
				ORDER by {$sOrder}
				LIMIT ?d, ?d ;
					";
		$aResult=array();
		if ($aRows=$this->oDb->selectPage($iCount,$sql,
										  isset($aFilter['id']) ? $aFilter['id'] : DBSIMPLE_SKIP,
										  isset($aFilter['mail']) ? $aFilter['mail'] : DBSIMPLE_SKIP,
										  isset($aFilter['password']) ? $aFilter['password'] : DBSIMPLE_SKIP,
										  isset($aFilter['ip_register']) ? $aFilter['ip_register'] : DBSIMPLE_SKIP,
										  isset($aFilter['activate']) ? $aFilter['activate'] : DBSIMPLE_SKIP,
										  isset($aFilter['activate_key']) ? $aFilter['activate_key'] : DBSIMPLE_SKIP,
										  isset($aFilter['profile_sex']) ? $aFilter['profile_sex'] : DBSIMPLE_SKIP,
										  isset($aFilter['login']) ? $aFilter['login'] : DBSIMPLE_SKIP,
										  isset($aFilter['profile_name']) ? $aFilter['profile_name'] : DBSIMPLE_SKIP,
										  ($iCurrPage-1)*$iPerPage, $iPerPage
		)) {
			foreach ($aRows as $aRow) {
				$aResult[]=$aRow['user_id'];
			}
		}
		return $aResult;
	}
	
	public function SituationStats($aFilter){
		if($aFilter['gametype_id']==7){
			$sql = "SELECT pc.nhlplayercard_id as player, 
					0 as user_id,
					concat (max(pc.family) ,' ',   max(pc.name))                AS fio, 
					''                    AS user_login,
					max(t.team_id) as team_id,
					max(t.brief) as team_brief,
					max(t.logo) as team_logo,
									 
					sum(case when g.raznica<=(-3) then 1 else 0 end) as t3, 
					sum(case when g.raznica=(-2) then 1 else 0 end) as t2, 
					sum(case when g.raznica=(-1) then 1 else 0 end) as t1, 
					sum(case when g.raznica=(0) then 1 else 0 end) as t, 
					sum(case when g.raznica=(1) then 1 else 0 end) as l1, 
					sum(case when g.raznica=(2) then 1 else 0 end) as l2, 
					sum(case when g.raznica>=(3) then 1 else 0 end) as l3,
					sum(g.wining) as gw,
					sum(g.empty_net) as eng,
					sum(case when g.type=(3) then 1 else 0 end) as psg,
					count(*) as goals
					 

				FROM tis_stat_matches m

				inner join `tis_stat_matchgoal` g 
					on g.match_id=m.match_id
					and g.goal>0 
				inner join tis_stat_nhlplayercard pc
					on g.goal=pc.nhlplayercard_id
				  
				inner join tis_stat_matchplayerstat mps
					on mps.playercard_id=pc.nhlplayercard_id
					and mps.match_id=m.match_id
					{ and mps.team_id in (?a) } 
					
				inner join tis_stat_team t
				on mps.team_id=t.team_id
				where m.tournament_id = ?d
					and m.played=1
						
					{ and m.dates >= ? }
					{ and m.dates <= ? }
					{ and m.round_id = ?d }
				group by pc.nhlplayercard_id
				
				order by goals desc ";
			}else{
				$sql = "SELECT pc.playercard_id as player, 
					ifnull(max(pl.user_id),0) as user_id,
					concat (max(pc.family) ,' ',   max(pc.name))                AS fio, 
					max(pl.user_login)                    AS user_login,
					max(t.team_id) as team_id,
					max(t.brief) as team_brief,
					max(t.logo) as team_logo,
									 
					sum(case when g.raznica<=(-3) then 1 else 0 end) as t3, 
					sum(case when g.raznica=(-2) then 1 else 0 end) as t2, 
					sum(case when g.raznica=(-1) then 1 else 0 end) as t1, 
					sum(case when g.raznica=(0) then 1 else 0 end) as t, 
					sum(case when g.raznica=(1) then 1 else 0 end) as l1, 
					sum(case when g.raznica=(2) then 1 else 0 end) as l2, 
					sum(case when g.raznica>=(3) then 1 else 0 end) as l3,
					sum(g.wining) as gw,
					sum(g.empty_net) as eng,
					sum(case when g.type=(3) then 1 else 0 end) as psg,
					count(*) as goals
					 

				FROM tis_stat_matches m

				inner join `tis_stat_matchgoal` g 
					on g.match_id=m.match_id
					and g.goal>0
				inner join tis_stat_playercard pc
					on g.goal=pc.playercard_id
					
				left join tis_user pl
					on pc.user_id=pl.user_id	
					
				inner join tis_stat_playertournament  pt
					on pt.tournament_id=m.tournament_id 
					and pt.playercard_id=pc.playercard_id
					{ and pt.team_id in (?a) } 
					
				left join tis_stat_team t
					on pt.team_id=t.team_id
					
				where m.tournament_id = ?d
					and m.played=1
						
					{ and m.dates >= ? }
					{ and m.dates <= ? }
					{ and m.round_id = ?d }					
				group by pc.playercard_id
				
				order by goals desc";
			
			
			}
		$aRows = @$this->oDb->select($sql, 
			( isset($aFilter['teams']) ) ? $aFilter['teams'] : DBSIMPLE_SKIP,
			$aFilter['tournament_id'], 			
			( isset($aFilter['date_start']) ) ? $aFilter['date_start'] : DBSIMPLE_SKIP, 
			( isset($aFilter['date_end']) ) ? $aFilter['date_end'] : DBSIMPLE_SKIP, 
			( isset($aFilter['round_id']) ) ? $aFilter['round_id'] : DBSIMPLE_SKIP);
		
        return $aRows;
	}
	public function PlayerStats($aFilter){
		$get_team='pt';
		if(isset($aFilter['get_team']))$get_team=$aFilter['get_team'];
	if ($aFilter['who']!='goalkeeper'){
		if($aFilter['gametype_id']==7){
		$sql = "select distinct mps.playercard_id as player,
					min(s.tournament_id) as tournament_id,
					min(m.round_id) as round_id,
					min(r.name) as round_name,
					count(mps.match_id) as games,
					0 as user_id,
					concat (max(pc.family) ,' ',   max(pc.name))                AS fio, 
					max('')                    AS user_login,
					max(t.team_id) as team_id,
					max(t.brief) as team_brief,
					max(t.logo) as team_logo,
					sum(mps.shots) as shots,
					sum(mps.penalty) as penalty,
					sum(mps.hits) as hits,
					sum(mps.goals) as goals,
					sum(mps.assists) as  assist,
					sum(mps.goals)  + sum(mps.assists) as points,
					sum(mps.pp) as pp,
					sum(mps.pk) as pk,
					case when sum(mps.shots)=0 then '0' else Concat(round(sum(mps.goals)/sum(mps.shots)*100,2),'')  end as prcnt,
				  
					sum(mps.plus_minus) as plus_minus,
					sum(mps.win_goal) as win_goal,
					sum(mps.star1)*3 +sum(mps.star2)*2+sum(mps.star3)*1 as mv
			from tis_stat_matchplayerstat mps

			inner join tis_stat_nhlplayercard pc
				on mps.playercard_id=pc.nhlplayercard_id
				 

			inner join tis_stat_matches m
				on m.match_id=mps.match_id
				and m.played=1
				{ and m.tournament_id=?d }
				
			inner join tis_stat_matchresult mr
				on mps.match_id=mr.match_id

			inner join tis_stat_matchresult mr2
				on mps.match_id=mr2.match_id
				and m.match_id=mr2.match_id 
				and mps.team_id=mr.team_id
				and mr.team_id<>mr2.team_id	

			inner join tis_stat_tournament  s
				on s.tournament_id=m.tournament_id
				
			inner join tis_stat_round  r
				on r.round_id=m.round_id
			
			inner join tis_stat_team t
				on ".$get_team.".team_id=t.team_id
			where mps.position<>'g'";
		}else{
		$sql = "select distinct mps.playercard_id as player,
					min(s.tournament_id) as tournament_id,
					min(m.round_id) as round_id,
					min(r.name) as round_name,
					count(mps.match_id) as games,
					ifnull(max(pl.user_id),0) as user_id,
					concat (max(pc.family) ,' ',   max(pc.name))                AS fio, 
					max(pl.user_login)                    AS user_login,
					max(t.team_id) as team_id,
					max(t.brief) as team_brief,
					max(t.logo) as team_logo,
					sum(mps.shots) as shots,
					sum(mps.penalty) as penalty,
					sum(mps.hits) as hits,
					sum(mps.goals) as goals,
					sum(mps.assists) as  assist,
					sum(mps.goals)  + sum(mps.assists) as points,
					sum(mps.pp) as pp,
					sum(mps.pk) as pk,
					case when sum(mps.shots)=0 then '0' else Concat(round(sum(mps.goals)/sum(mps.shots)*100,2),'')  end as prcnt,
				  
					sum(mps.plus_minus) as plus_minus,
					sum(mps.win_goal) as win_goal,
					sum(mps.star1)*3 +sum(mps.star2)*2+sum(mps.star3)*1 as mv
			from tis_stat_matchplayerstat mps

			inner join tis_stat_playercard pc
				on mps.playercard_id=pc.playercard_id
				
			left join tis_user pl
				on pc.user_id=pl.user_id

			inner join tis_stat_matches m
				on m.match_id=mps.match_id
				and m.played=1
				{ and m.tournament_id=?d }
				
			inner join tis_stat_matchresult mr
				on mps.match_id=mr.match_id

			inner join tis_stat_matchresult mr2
				on mps.match_id=mr2.match_id
				and m.match_id=mr2.match_id 
				and mps.team_id=mr.team_id
				and mr.team_id<>mr2.team_id	

			inner join tis_stat_tournament  s
				on s.tournament_id=m.tournament_id
				
			inner join tis_stat_round  r
				on r.round_id=m.round_id
				
			inner join tis_stat_playertournament  pt
				on pt.tournament_id=s.tournament_id
				and pt.playercard_id=pc.playercard_id
				
			left join tis_stat_team t
				on ".$get_team.".team_id=t.team_id
			where mps.position<>'g'";
		}
		if($aFilter['who']=='attack') $sql .=" and mps.position<>'ld' and mps.position<>'rd' and mps.position<>'g' ";
		if($aFilter['who']=='defence') $sql .=" and mps.position<>'lw' and mps.position<>'rw' and mps.position<>'c' and mps.position<>'g' ";
		$sql.="		{ and pc.playercard_id = ?d }
					{ and pc.user_id = ?d }
					{ and pc.platform_id = ?d }
					{ and pc.sport_id = ?d }
					{ and m.match_id in (?a) }	
					{ and m.dates >= ? }
					{ and m.dates <= ? }	
					{ and ".$get_team.".team_id in (?a) }
					{ and m.round_id = ?d }	 
			Group by mps.playercard_id ";
		if(isset($aFilter['group_by']))$sql.=", ".implode(",", $aFilter['group_by']);
		$sql.=" order by tournament_id, round_id, points desc, goals desc";
		
		if(isset($aFilter['limit']))$sql.=" LIMIT 0, ". $aFilter['limit'];
		
	}else{
		if($aFilter['gametype_id']==7){
			$sql="select distinct mps.playercard_id as player,
						min(s.tournament_id) as tournament_id,
						min(m.round_id) as round_id,
						min(r.name) as round_name,
						count(mps.match_id) as games,
						0 as user_id,
						concat (max(pc.family) ,' ',   max(pc.name))                AS fio, 
						max('')                    AS user_login,
						max(t.team_id) as team_id,
						max(t.brief) as team_brief,
						max(t.logo) as team_logo,
						sum(mps.goals) as goals,
						sum(mps.assists) as  assists,
						sum(mr2.shots)-sum(case when mr.team_id=m.home then mr.away else mr.home end)+sum(mr2.empty_net) as shots,
						sum(mr2.shots)  as total_shots,
						round((sum(mr2.shots)-sum(           
							  case when mr.team_id=m.home then mr.away else mr.home end
								)+sum(mr2.empty_net))/sum(mr2.shots)*100,2) as shots_prcn,
						sum(mps.penalty) 													as penalty,
						sum(mps.goals)/sum(mps.shots*100) as prcnt,
						sum(case when mr.team_id=m.home then mr.away else mr.home end)-sum(mr2.empty_net) as ga,
						max(mps.match_id) as match_id,
						round((sum(case when mr.team_id=m.home then mr.away else mr.home end)-sum(mr2.empty_net))/count(mps.match_id),2) as sr_ga,
						sum(
							case when mr.team_id=m.home and (mr.home-mr.away)>0 then 1
									when mr.team_id=m.away and (mr.away-mr.home)>0 then 1
							else 0 end
						) as wins, 
						sum(
							case when mr.team_id=m.home and (mr.home-mr.away)<0 then 1
								when mr.team_id=m.away and (mr.away-mr.home)<0 then 1
							else 0 end
						) as loses, 
						sum(
							case when mr.team_id=m.home and mr.away=0 then 1
								when mr.team_id=m.away and mr.home=0 then 1
							else 0 end
						) as ibp,  
						sum(mps.star1)*3 +sum(mps.star2)*2+sum(mps.star3)*1 as mv
				from tis_stat_matchplayerstat mps

				inner join tis_stat_nhlplayercard pc
					on mps.playercard_id=pc.nhlplayercard_id
					
				 
				inner join tis_stat_matches m
					on m.match_id=mps.match_id
					and m.played=1
					{ and m.tournament_id=?d }
					
				inner join tis_stat_matchresult mr
					on mps.match_id=mr.match_id

				inner join tis_stat_matchresult mr2
					on mps.match_id=mr2.match_id
					and m.match_id=mr2.match_id 
					and mps.team_id=mr.team_id
					and mr.team_id<>mr2.team_id	

				inner join tis_stat_tournament  s
					on s.tournament_id=m.tournament_id
				
				inner join tis_stat_round  r
					on r.round_id=m.round_id
					
				inner join tis_stat_team t
					on ".$get_team.".team_id=t.team_id
				
				where mps.position='g'
					";
		}else{
		$sql="select distinct mps.playercard_id as player,
						min(s.tournament_id) as tournament_id,
						min(m.round_id) as round_id,
						min(r.name) as round_name,
						count(mps.match_id) as games,
						ifnull(max(pl.user_id),0) as user_id,
						concat (max(pc.family) ,' ',   max(pc.name))                AS fio,  
						max(pl.user_login)                    AS user_login,
						max(t.team_id) as team_id,
						max(t.brief) as team_brief,
						max(t.logo) as team_logo,
			sum(mps.goals) as goals,
			sum(mps.assists) as  assists,
			sum(mr2.shots)-sum(case when mr.team_id=m.home then mr.away else mr.home end)+sum(mr2.empty_net) as shots,
			sum(mr2.shots)  as total_shots,
			round((sum(mr2.shots)-sum(           
				  case when mr.team_id=m.home then mr.away else mr.home end
					)+sum(mr2.empty_net))/sum(mr2.shots)*100,2) as shots_prcn,
			sum(mps.penalty) 													as penalty,
			sum(mps.goals)/sum(mps.shots*100) as prcnt,
			sum(case when mr.team_id=m.home then mr.away else mr.home end)-sum(mr2.empty_net) as ga,
			max(mps.match_id) as match_id,
			round((sum(case when mr.team_id=m.home then mr.away else mr.home end)-sum(mr2.empty_net))/count(mps.match_id),2) as sr_ga,
			sum(
				case when mr.team_id=m.home and (mr.home-mr.away)>0 then 1
						when mr.team_id=m.away and (mr.away-mr.home)>0 then 1
				else 0 end
			) as wins, 
			sum(
				case when mr.team_id=m.home and (mr.home-mr.away)<0 then 1
					when mr.team_id=m.away and (mr.away-mr.home)<0 then 1
				else 0 end
			) as loses, 
			sum(
				case when mr.team_id=m.home and mr.away=0 then 1
					when mr.team_id=m.away and mr.home=0 then 1
				else 0 end
			) as ibp,  
						sum(mps.star1)*3 +sum(mps.star2)*2+sum(mps.star3)*1 as mv
				from tis_stat_matchplayerstat mps

				inner join tis_stat_playercard pc
					on mps.playercard_id=pc.playercard_id
					
				left join tis_user pl
					on pc.user_id=pl.user_id

				inner join tis_stat_matches m
					on m.match_id=mps.match_id
					and m.played=1
					{ and m.tournament_id=?d }
					
				inner join tis_stat_matchresult mr
					on mps.match_id=mr.match_id

				inner join tis_stat_matchresult mr2
					on mps.match_id=mr2.match_id
					and m.match_id=mr2.match_id 
					and mps.team_id=mr.team_id
					and mr.team_id<>mr2.team_id	

				inner join tis_stat_tournament  s
					on s.tournament_id=m.tournament_id
					
				inner join tis_stat_round  r
					on r.round_id=m.round_id
					
				inner join tis_stat_playertournament  pt
					on pt.tournament_id=s.tournament_id
					and pt.playercard_id=pc.playercard_id
					
				left join tis_stat_team t
					on ".$get_team.".team_id=t.team_id
				where mps.position='g'";
			}
			
			$sql.=" { and pc.playercard_id = ?d }
					{ and pc.user_id = ?d }
					{ and pc.platform_id = ?d }
					{ and pc.sport_id = ?d }
					{ and m.match_id in (?a) }
					{ and m.dates >= ? }
					{ and m.dates <= ? }
					{ and ".$get_team.".team_id in (?a) } 
					{ and m.round_id = ?d }	
				Group by mps.playercard_id ";
			if(isset($aFilter['group_by']))$sql.=", ".implode(",", $aFilter['group_by']);
			
			$sql.=" ORDER BY tournament_id, round_id, wins DESC, shots_prcn  DESC";
			if(isset($aFilter['limit']))$sql.=" LIMIT 0, ". $aFilter['limit'];

	}
		$aRows = @$this->oDb->select($sql, 
			( isset($aFilter['tournament_id']) && $aFilter['tournament_id']!=0 ) ? $aFilter['tournament_id'] : DBSIMPLE_SKIP, 
			( isset($aFilter['playercard_id']) ) ? $aFilter['playercard_id'] : DBSIMPLE_SKIP, 
			( isset($aFilter['user_id']) ) ? $aFilter['user_id'] : DBSIMPLE_SKIP, 
			( isset($aFilter['platform_id']) ) ? $aFilter['platform_id'] : DBSIMPLE_SKIP, 
			( isset($aFilter['sport_id']) ) ? $aFilter['sport_id'] : DBSIMPLE_SKIP, 
			( isset($aFilter['match_id']) ) ? $aFilter['match_id'] : DBSIMPLE_SKIP, 
			( isset($aFilter['date_start']) ) ? $aFilter['date_start'] : DBSIMPLE_SKIP, 
			( isset($aFilter['date_end']) ) ? $aFilter['date_end'] : DBSIMPLE_SKIP , 
			( isset($aFilter['teams']) ) ? $aFilter['teams'] : DBSIMPLE_SKIP, 
			( isset($aFilter['round_id']) ) ? $aFilter['round_id'] : DBSIMPLE_SKIP  );
		
        return $aRows;
	}
	public function GetAll($sql) {
        $sValue = null;

        //$sql = "SELECT adminset_key AS `key`, adminset_val AS `val` FROM ".Config::Get('db.table.adminset')." WHERE adminset_key LIKE ? ";
        $aRows = @$this->oDb->select($sql);
        if ($aRows) $sValue = $aRows;
      
        return $sValue;
    }
	public function getUserSubscribes($iUserId) {
		$sql = 'SELECT target_user_id FROM ' . Config::Get('db.table.stream_subscribe') . ' WHERE user_id = ?d';
		return $this->oDb->selectCol($sql, !is_null($iCount) ? $iCount : DBSIMPLE_SKIP);
	}
	public function PlayerRatings($user_id,$game_id,$gametype_id) {
		$sql = "SELECT u.user_login                                  AS user_login, 
					   SUM(CASE 
							 WHEN ( ( m.home_player = u.user_id 
									  AND m.goals_home > m.goals_away ) 
									 OR ( m.away_player = u.user_id 
										  AND m.goals_away > m.goals_home ) ) THEN 1 
							 ELSE 0 
						   END)                                      AS win, 
					   SUM(CASE 
							 WHEN ( ( m.home_player = u.user_id 
									  AND m.goals_home < m.goals_away ) 
									 OR ( m.away_player = u.user_id 
										  AND m.goals_away < m.goals_home ) ) 
								  AND m.ot = 0 
								  AND m.so = 0 THEN 1 
							 ELSE 0 
						   END)                                      AS lose, 
					   SUM(CASE 
							 WHEN ( ( m.home_player = u.user_id 
									  AND m.goals_home < m.goals_away ) 
									 OR ( m.away_player = u.user_id 
										  AND m.goals_away < m.goals_home ) ) 
								  AND ( m.ot = 1 
										 OR m.so = 1 ) THEN 1 
							 ELSE 0 
						   END)   + sum(case when ((m.home_player=u.user_id or m.away_player=u.user_id)) and m.goals_home=m.goals_away then 1 else 0 end)                                   AS lose_o, 
					   Min(r.rating)                                 AS rating, 
					   Ifnull(u.user_profile_avatar, '')             AS user_profile_avatar, 
					   COUNT(m.match_id)                             AS total_matches, 
					   (SELECT COUNT(DISTINCT tournament_id) 
						FROM   tis_stat_matches 
						WHERE  tournament_id<>0 
							   AND ( u.user_id = home_player 
									  OR u.user_id = away_player )
								AND game_id=r.game_id 
								AND gametype_id = r.gametype_id)  AS tournaments, 
					   Min(p.brief)                                  AS platform, 
					   Min(g.brief)                                  AS game, 
					   Min(gt.brief)                                 AS gametype, 
					   Min(g.sport_id)                               AS sport_id, 
					   Ifnull((SELECT COUNT(*) 
							   FROM   tis_stat_rating 
							   WHERE  game_id = r.game_id 
									  AND gametype_id = r.gametype_id
									  AND user_id <> 0
									  AND rating > r.rating), 0) + 1 AS position,
					   Ifnull((SELECT COUNT(*) 
							   FROM   tis_stat_medals 
							   WHERE  game_id = r.game_id 
									  AND gametype_id = r.gametype_id 
									  AND user_id = r.user_id), 0)     AS medals,	
					   Ifnull((SELECT COUNT(*) 
							   FROM   tis_stat_penalty pe, tis_stat_tournament t
							   WHERE   pe.user_id = r.user_id
										AND pe.tournament_id=t.tournament_id
										AND t.game_id=r.game_id 
										AND t.gametype_id = r.gametype_id), 0)     AS cards,
					   Ifnull((SELECT ovrskillpoints 
							   FROM   tis_stat_ofrating  
							   WHERE   user_id = r.user_id 
										AND game_id=r.game_id 
										AND gametype_id = r.gametype_id limit 0,1), 0)     AS ofrating,
										
					   Ifnull((SELECT CONCAT(wins,'-',losses,'-',ties) 
							   FROM   tis_stat_ofrating  
							   WHERE   user_id = r.user_id 
										AND game_id=r.game_id 
										AND gametype_id = r.gametype_id limit 0,1), 0)     AS ofrating_stat									
				FROM   `tis_stat_matches` m, 
					   tis_user u, 
					   tis_stat_rating r, 
					   tis_stat_game g, 
					   tis_stat_gametype gt, 
					   tis_stat_platform p 
				WHERE  m.played = 1 
					   AND ( m.home_player = u.user_id 
							  OR m.away_player = u.user_id ) 
					   AND m.game_id = g.game_id 
					   AND m.gametype_id = gt.gametype_id 
					   AND g.platform_id = p.platform_id 
					   AND u.user_id = r.user_id 
					   AND u.user_id = ?d 
					   AND m.game_id = ?d
					   AND m.gametype_id = ?d
					   AND m.game_id = r.game_id 
					   AND m.gametype_id = r.gametype_id 
				GROUP  BY u.user_login, 
						  r.game_id 
				 ";
		$aRows = @$this->oDb->select($sql, $user_id,$game_id,$gametype_id);
		
        return $aRows[0];
	}
	
	public function PlayoffTree($tournament_id){
		$sql = "SELECT sp.* , 
					CASE WHEN round =  '1/32' THEN 1 
					WHEN round =  '1/16' THEN 2 
					WHEN round =  '1/8' THEN 3 
					WHEN round =  '1/4' THEN 4 
					WHEN round =  '1/2' THEN 5 
					WHEN round =  '1' THEN 6 
								END AS round_num,
ifnull((select count(*) from tis_stat_matches where tournament_id=sp.tournament_id and round_id=100 and round_po=sp.round and played=1 and ((home=sp.team_id and goals_home>goals_away) or (away=sp.team_id and goals_away>goals_home) ) ),0) as wins
				FROM  `tis_stat_playoff` sp 
				WHERE sp.tournament_id = ?d
				ORDER BY round_num, num";
		$aRows = @$this->oDb->select($sql,  $tournament_id);
		
        return $aRows;
	
	}
	public function PlayoffTreeWithMatches($tournament_id){
		$sql = "SELECT sp1.*,
						CASE 	WHEN sp1.round =  '1/32' THEN 1 
							WHEN sp1.round =  '1/16' THEN 2 
							WHEN sp1.round =  '1/8' THEN 3 
							WHEN sp1.round =  '1/4' THEN 4 
							WHEN sp1.round =  '1/2' THEN 5 
							WHEN sp1.round =  '1' THEN 6 
						END AS round_num,
						t1.name as name_1,
						t1.team_id as team_id_1,
						t1.logo as logo_1,

						t2.name as name_2,
						t2.team_id as team_id_2,
						t2.logo as logo_2,
						m.home,
						m.away,
						m.goals_home,
						m.goals_away,
						m.match_id,
						concat(m.goals_away, '-', m.goals_home, 
							case when m.ot=1 then ' OT' else '' end, 
							case when m.so=1 then ' SO' else ''end, 
							case when m.teh=1 then ' тех' else ''end) as result,
						concat(m.goals_home, '-', m.goals_away, 
							case when m.ot=1 then ' OT' else '' end, 
							case when m.so=1 then ' SO' else ''end, 
							case when m.teh=1 then ' тех' else ''end) as result_zerkalo,
						case when m.goals_home> m.goals_away then home else away end as winner,
						case when m.goals_home<= m.goals_away then home else away end as loser

				  FROM tis_stat_playoff sp1

				 inner join tis_stat_playoff sp2
					on sp2.tournament_id = sp1.tournament_id
				   AND sp2.num = (sp1.num + 1)
				   AND sp2.round = sp1.round

				 inner join tis_stat_team t1
					on t1.team_id = sp1.team_id

				 inner join tis_stat_team t2
					on t2.team_id = sp2.team_id

				 left join tis_stat_matches m
					on (m.home = t1.team_id or m.away = t1.team_id)
				   and m.played = 1
				   and m.tournament_id = sp1.tournament_id
				   and m.round_po = sp1.round

				 WHERE sp1.tournament_id =?d
				   AND sp2.num % 2 = 0

				 ORDER BY round_num, num";
		$aRows = @$this->oDb->select($sql,  $tournament_id);
        return $aRows;
	}
	public function MonthMatches($tournament_id, $team_id, $month) {
		$sql = "SELECT distinct
				min(case when m.home=?d then t1.logo else t2.logo end) as logo,
				min(case when g.sport_id=1 then
				              case when m.home=?d then '-home' else '-away' end
						when g.sport_id=2 then
				              case when m.home=?d then '-away' else '-home' end	  
						else
							case when m.home=?d then '-home' else '-away' end
						end
						) as css,
				day(m.dates) as day,
				min(m.played) as played,
				case when m.home = ?d and m.played = 1 and m.goals_home > m.goals_away  then 'W'
					 when m.home = ?d and m.played = 1 and m.goals_home = m.goals_away  then 'N'
					 when m.home = ?d and m.played = 1 and m.goals_home < m.goals_away  then 'L'
					 when m.away = ?d and m.played = 1 and m.goals_home < m.goals_away  then 'W'
					 when m.away = ?d and m.played = 1 and m.goals_home = m.goals_away  then 'N'
					 when m.away = ?d and m.played = 1 and m.goals_home > m.goals_away  then 'L'
					else '' end as status,
				min(m.ot) as ot,
				min(m.so) as so,
				min(m.teh) as teh,
				min(m.goals_home) as goals_home,
				min(m.goals_away) as goals_away,
				
				group_concat(concat(case when m.home = ?d and m.played = 1 and m.goals_home > m.goals_away  then 'W'
						 when m.home = ?d and m.played = 1 and m.goals_home = m.goals_away  then 'N'
						 when m.home = ?d and m.played = 1 and m.goals_home < m.goals_away  then 'L'
						 when m.away = ?d and m.played = 1 and m.goals_home < m.goals_away  then 'W'
						 when m.away = ?d and m.played = 1 and m.goals_home = m.goals_away  then 'N'
						 when m.away = ?d and m.played = 1 and m.goals_home > m.goals_away  then 'L'
						else '' end, case when m.ot=1 then ' OT' else '' end, case when m.so=1 then ' SO' else '' end, case when m.teh=1 then ' teh' else '' end) SEPARATOR ', ') as g_c
								
				FROM `tis_stat_matches` m,
					`tis_stat_team` t1,
					`tis_stat_team` t2,
					`tis_stat_tournament` t,
					`tis_stat_game` g
				WHERE m.tournament_id= ?d
				and g.game_id=t.game_id
				and (m.home= ?d or m.away= ?d)
				and month(m.dates)=?d
				and t1.team_id=m.away
				and t2.team_id=m.home 
				and m.tournament_id=t.tournament_id
				group by m.dates";
		$aRows = @$this->oDb->select($sql, $team_id, $team_id, $team_id, $team_id, $team_id, $team_id, $team_id, $team_id, $team_id, $team_id,  $team_id, $team_id, $team_id, $team_id, $team_id, $team_id, $tournament_id, $team_id, $team_id, $month);
		
        return $aRows;
	}
	public function MatchesSQL($aFilter) {
        $sValue = null;
		
		$sql = "SELECT DATE_FORMAT(m.dates, '%d.%m.%y') as dates ,
					DATE_FORMAT(m.dates, '%Y%m%d') as date_match,
					case when WEEKDAY(m.dates)=0 then 'понедельник'
						when WEEKDAY(m.dates)=1 then 'вторник'
						when WEEKDAY(m.dates)=2 then 'среда'
						when WEEKDAY(m.dates)=3 then 'четверг'
						when WEEKDAY(m.dates)=4 then 'пятница'
						when WEEKDAY(m.dates)=5 then 'суббота'
						when WEEKDAY(m.dates)=6 then 'воскресение' end as day_of_week,
					m.number   as number,
					t.dateopenrasp as dateopenrasp,					
					DATE_FORMAT(t.dateopenrasp, '%Y%m%d') as date_openrasp,
					m.played   as played,
					m.teh      as teh,
					m.so       as so,
					m.ot       as ot,
					m.goals_home   as g_home,
					m.goals_away   as g_away,
					awayt.logo as away_logo,
					homet.logo as home_logo,
					awayt.name as away_name,
					homet.name as home_name,
					m.home_insert   as home_insert,
					m.away_insert   as away_insert,
					m.home_rating   as home_rating,
					m.away_rating   as home_rating,	
					m.home as home,
					m.away as away,
					m.match_id as match_id,
					awayt.shortname as away_brief,
					week(m.dates,1) as currentweek,
					week(DATE_ADD(m.dates, INTERVAL m.prodlen WEEK)) as prodlenweek,
					year(DATE_ADD(m.dates, INTERVAL m.prodlen WEEK)) as prodlenyear,
					DATE_ADD(m.dates, INTERVAL m.prodlen DAY) as prodlenday,
					m.prodlen as prodlen,
					t.prodlenie as prodlenie,
					year(m.dates) as currentyear,
					m.timetoplay as timetoplay,
					case when homet.team_id = ?d or awayt.team_id = ?d then 1 else 0 end as myteam,
					homet.shortname as home_brief,
					{ ?d as vneseno, }
					{ifnull((select distinct 1 from tis_stat_matchresult where match_id=m.match_id and team_id = ?d ),0) as vneseno, }
					ifnull((select distinct 1 from tis_stat_matchresult where match_id=m.match_id ),0) as vneseno_one,
					{case when homet.shortname = ? then (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id and (m2.away=homet.team_id or m2.home=homet.team_id))}
					{	when awayt.shortname = ? then (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id and (m2.away=awayt.team_id or m2.home=awayt.team_id))
					end as match_day, }
					{ ?d as match_day, }
					m.gametype_id as gametype_id,
					0 as here
				from tis_stat_matches m, 
					tis_stat_team homet, 
					tis_stat_team awayt,
					tis_stat_tournament t
				where m.home=homet.team_id 
						and m.away=awayt.team_id
						and m.tournament_id=t.tournament_id
						{and week(m.dates,1) = ?d}
						{and month(m.dates) = ?d }
						{and ? in (homet.shortname, awayt.shortname ) } 
						{and m.tournament_id = ?d}						
						{and ( homet.team_id in ( ?a )}{ or awayt.team_id in ( ?a ) )}
				order by m.dates, m.number
					"; 
		 
				
			$aRows = $this->oDb->select(
				$sql,
				$aFilter['my_team_id'], $aFilter['my_team_id'],
				($aFilter['user_id'] == 0) ? 0 : DBSIMPLE_SKIP,
				($aFilter['user_id'] != 0) ? $aFilter['my_team_id'] : DBSIMPLE_SKIP,
				( isset($aFilter['team_brief']) ) ? $aFilter['team_brief'] : DBSIMPLE_SKIP,
				( isset($aFilter['team_brief']) ) ? $aFilter['team_brief'] : DBSIMPLE_SKIP,
				( ! isset($aFilter['team_brief']) ) ? 0 : DBSIMPLE_SKIP,
				( isset($aFilter['week']) and $aFilter['week']<>0 ) ? $aFilter['week'] : DBSIMPLE_SKIP,
				( isset($aFilter['month']) and $aFilter['month']<>0 ) ? $aFilter['month'] : DBSIMPLE_SKIP,				
				( isset($aFilter['team_brief']) and $aFilter['team_brief']<>'' ) ? $aFilter['team_brief'] : DBSIMPLE_SKIP,
				( isset($aFilter['tournament_id']) and $aFilter['tournament_id']<>0 ) ? $aFilter['tournament_id'] : DBSIMPLE_SKIP,
				( isset($aFilter['teams']) and is_array($aFilter['teams']) ) ? $aFilter['teams'] : DBSIMPLE_SKIP,
				( isset($aFilter['teams']) and is_array($aFilter['teams']) ) ? $aFilter['teams'] : DBSIMPLE_SKIP
				

			);
 
		 
        if ($aRows) $sValue = $aRows;
      
        return $sValue;
    }
	public function MatchesSQLNew($aFilter) {
        $sValue = null;
		
		$sql = "SELECT DATE_FORMAT(m.dates, '%d.%m.%y') as dates ,
					DATE_FORMAT(m.dates, '%Y%m%d') as date_match,
					case when WEEKDAY(m.dates)=0 then 'понедельник'
						when WEEKDAY(m.dates)=1 then 'вторник'
						when WEEKDAY(m.dates)=2 then 'среда'
						when WEEKDAY(m.dates)=3 then 'четверг'
						when WEEKDAY(m.dates)=4 then 'пятница'
						when WEEKDAY(m.dates)=5 then 'суббота'
						when WEEKDAY(m.dates)=6 then 'воскресение' end as day_of_week,
					m.number   as number,
					t.dateopenrasp as dateopenrasp,					
					DATE_FORMAT(t.dateopenrasp, '%Y%m%d') as date_openrasp,
					m.played   as played,
					m.teh      as teh,
					m.so       as so,
					m.ot       as ot,
					m.goals_home   as g_home,
					m.goals_away   as g_away,
					awayt.logo as away_logo,
					homet.logo as home_logo,
					awayt.name as away_name,
					homet.name as home_name,
					m.home_insert   as home_insert,
					m.away_insert   as away_insert,
					m.home_rating   as home_rating,
					m.away_rating   as home_rating,	
					m.home as home,
					m.away as away,
					m.match_id as match_id,
					awayt.shortname as away_brief,
					week(m.dates,1) as currentweek,
					week(DATE_ADD(m.dates, INTERVAL m.prodlen WEEK)) as prodlenweek,
					year(DATE_ADD(m.dates, INTERVAL m.prodlen WEEK)) as prodlenyear,
					DATE_ADD(m.dates, INTERVAL m.prodlen DAY) as prodlenday,
					m.prodlen as prodlen,
					t.prodlenie as prodlenie,
					year(m.dates) as currentyear,
					m.timetoplay as timetoplay,
					case when homet.team_id = ?d or awayt.team_id = ?d then 1 else 0 end as myteam,
					homet.shortname as home_brief,
					{ ?d as vneseno, }
					{ifnull((select distinct 1 from tis_stat_matchresult where match_id=m.match_id and team_id = ?d ),0) as vneseno, }
					ifnull((select distinct 1 from tis_stat_matchresult where match_id=m.match_id ),0) as vneseno_one,
					{case when homet.shortname = ? then (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id and (m2.away=homet.team_id or m2.home=homet.team_id))}
					{	when awayt.shortname = ? then (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id and (m2.away=awayt.team_id or m2.home=awayt.team_id))
					end as match_day, }
					{ ?d as match_day, }
					m.gametype_id as gametype_id,
					0 as here
				from tis_stat_matches m, 
					tis_stat_team homet, 
					tis_stat_team awayt,
					tis_stat_tournament t
				where m.home=homet.team_id 
						and m.away=awayt.team_id
						and m.tournament_id=t.tournament_id
						{and week(m.dates,1) = ?d}
						{and month(m.dates) = ?d }
						{and ? in (homet.shortname, awayt.shortname ) } 
						{and m.tournament_id = ?d}						
						{and ( homet.team_id in ( ?a )}{ or awayt.team_id in ( ?a ) )}
						{and m.played = ?d }
						{and m.dates >= ?}
						{and m.dates <= ?}
						{ and m.round_id = ?d }	
				order by m.dates, m.number
					"; 
		 
				
			$aRows = $this->oDb->select(
				$sql,
				$aFilter['my_team_id'], $aFilter['my_team_id'],
				( (isset($aFilter['user_id']) && $aFilter['user_id'] == 0) || !isset($aFilter['user_id'])) ? 0 : DBSIMPLE_SKIP,
				( $aFilter['user_id'] && $aFilter['user_id'] != 0) ? $aFilter['my_team_id'] : DBSIMPLE_SKIP,
				( isset($aFilter['team_brief']) ) ? $aFilter['team_brief'] : DBSIMPLE_SKIP,
				( isset($aFilter['team_brief']) ) ? $aFilter['team_brief'] : DBSIMPLE_SKIP,
				( ! isset($aFilter['team_brief']) ) ? 0 : DBSIMPLE_SKIP,
				( isset($aFilter['week']) and $aFilter['week']<>0 ) ? $aFilter['week'] : DBSIMPLE_SKIP,
				( isset($aFilter['month']) and $aFilter['month']<>0 ) ? $aFilter['month'] : DBSIMPLE_SKIP,				
				( isset($aFilter['team_brief']) and $aFilter['team_brief']<>'' ) ? $aFilter['team_brief'] : DBSIMPLE_SKIP,
				( isset($aFilter['tournament_id']) and $aFilter['tournament_id']<>0 ) ? $aFilter['tournament_id'] : DBSIMPLE_SKIP,
				( isset($aFilter['teams']) and is_array($aFilter['teams']) ) ? $aFilter['teams'] : DBSIMPLE_SKIP,
				( isset($aFilter['teams']) and is_array($aFilter['teams']) ) ? $aFilter['teams'] : DBSIMPLE_SKIP,
				( isset($aFilter['not_played']) and $aFilter['not_played']==1 ) ? 0 : DBSIMPLE_SKIP,
				( isset($aFilter['date_start']) and $aFilter['date_start']!='' ) ? $aFilter['date_start'] : DBSIMPLE_SKIP,
				( isset($aFilter['date_end']) and $aFilter['date_end']!='' ) ? $aFilter['date_end'] : DBSIMPLE_SKIP,
				( isset($aFilter['round_id']) ) ? $aFilter['round_id'] : DBSIMPLE_SKIP
				
			); 
		 
        if ($aRows) $sValue = $aRows;
      
        return $sValue;
    }
	
	public function MatchesSQL_old($myteam, $userid, $Setteam, $teambrief, $month, $Setcurrentweek, $week, $tournament_id) {
        $sValue = null;

        //$sql = "SELECT adminset_key AS `key`, adminset_val AS `val` FROM ".Config::Get('db.table.adminset')." WHERE adminset_key LIKE ? ";
		$sql = "SELECT DATE_FORMAT(m.dates, '%d.%m.%y') as dates ,
					DATE_FORMAT(m.dates, '%Y%m%d') as date_match,
					case when WEEKDAY(m.dates)=0 then 'понедельник'
						when WEEKDAY(m.dates)=1 then 'вторник'
						when WEEKDAY(m.dates)=2 then 'среда'
						when WEEKDAY(m.dates)=3 then 'четверг'
						when WEEKDAY(m.dates)=4 then 'пятница'
						when WEEKDAY(m.dates)=5 then 'суббота'
						when WEEKDAY(m.dates)=6 then 'воскресение' end as day_of_week,
					m.number   as number,
					t.dateopenrasp as dateopenrasp,
					m.played   as played,
					m.teh      as teh,
					m.so       as so,
					m.ot       as ot,
					m.goals_home   as g_home,
					m.goals_away   as g_away,
					awayt.logo as away_logo,
					homet.logo as home_logo,
					awayt.name as away_name,
					homet.name as home_name,
					m.home_insert   as home_insert,
					m.away_insert   as away_insert,
					m.home_rating   as home_rating,
					m.away_rating   as home_rating,	
					m.home as home,
					m.away as away,
					m.match_id as match_id,
					awayt.shortname as away_brief,
					week(m.dates,1) as currentweek,
					week(DATE_ADD(m.dates, INTERVAL m.prodlen WEEK)) as prodlenweek,
					year(DATE_ADD(m.dates, INTERVAL m.prodlen WEEK)) as prodlenyear,
					DATE_ADD(m.dates, INTERVAL m.prodlen DAY) as prodlenday,
					m.prodlen as prodlen,
					t.prodlenie as prodlenie,
					year(m.dates) as currentyear,
					m.timetoplay as timetoplay,
					case when homet.team_id='".$myteam."' or awayt.team_id='".$myteam."' then 1 else 0 end as myteam,
					homet.shortname as home_brief,";
	if($userid==0)$sql .= " 0 as vneseno, ";
	if($userid!=0)$sql .= " ifnull((select distinct 1 from tis_stat_matchresult where match_id=m.match_id and team_id='".$myteam."'),0) as vneseno, ";
					$sql .= " ifnull((select distinct 1 from tis_stat_matchresult where match_id=m.match_id ),0) as vneseno_one, ";
	if($Setteam)$sql .= " case when homet.shortname='".$teambrief."' then (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id and (m2.away=homet.team_id or m2.home=homet.team_id))
						when awayt.shortname='".$teambrief."' then (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id and (m2.away=awayt.team_id or m2.home=awayt.team_id))
					end as match_day ";
	//if(!$Setteam)$sql .= " (select count(*) from tis_stat_matches m2 where date(m.dates)=date(m2.dates) and m.tournament_id=m2.tournament_id) as match_day ";
	if(!$Setteam)$sql .= " 0 as match_day ";	
		$sql .= "	from tis_stat_matches m, 
					tis_stat_team homet, 
					tis_stat_team awayt,
					tis_stat_tournament t
				where m.home=homet.team_id 
						and m.away=awayt.team_id
						and m.tournament_id=t.tournament_id";
			if($week<>0)   $sql .= " and week(m.dates,1)='".$week."' ";
			if($month<>0)	$sql .= " and month(m.dates)='".$month."' ";
			//if($Setmonth) $sql .= " and month(m.dates)='".$month."' ";
			//if($Setyear) $sql .= " and year(m.dates)='".$year."' ";
			if(isset($Setteam) && $Setteam) $sql .= " and (homet.shortname='".$teambrief."' or awayt.shortname = '".$teambrief."')";
			if($Setcurrentweek) $sql .= " and week(m.dates,1)='".$week."' ";
				$sql .= "	and m.tournament_id=".$tournament_id."
				order by m.dates, m.number";
//echo $sql;				
        $aRows = @$this->oDb->select($sql);
        if ($aRows) $sValue = $aRows;
      
        return $sValue;
    }
	public function Zayavok($tournament_id) {
        $sValue = null;

        $sql = "SELECT user_id FROM `tis_stat_zayavki` WHERE tournament_id = ?d group by user_id
		union 
		select user_id from tis_purse_logs where service_subj_id=?d and service_from_type='tournament' group by user_id";
        $aRows = @$this->oDb->select($sql, $tournament_id, $tournament_id);
        if ($aRows) $sValue = count($aRows);      
        return $sValue;
    }
	public function TeamZayavok($tournament_id) {
        $sValue = null;

        $sql = "SELECT team_id, count(user_id) as zayavok FROM `tis_stat_zayavki` WHERE tournament_id = ?d  group by team_id";
		
        $aRows = @$this->oDb->select($sql, $tournament_id);
        if ($aRows){
			$sValue = array();
			foreach($aRows as $oRow){
				$sValue[$oRow['team_id']] = $oRow['zayavok'];
			}
		}     
        return $sValue;
    }
	public function TeamZayavki($tournament_id) {
        $sValue = null;

        $sql = "SELECT u.user_login as user_login FROM  `tis_stat_zayavki` sz,  `tis_user` u WHERE sz.tournament_id = ?d AND u.user_id = sz.user_id GROUP BY u.user_login
		union 
		select u.user_login as user_login from tis_purse_logs pl, `tis_user` u  where pl.service_subj_id=?d and pl.service_from_type='tournament' AND u.user_id = pl.user_id GROUP BY u.user_login  order by user_login";
        $aRows = @$this->oDb->select($sql, $tournament_id, $tournament_id);
        if ($aRows){
			$sValue = array();
			foreach($aRows as $oRow){
				$sValue[] = $oRow['user_login'];
			}
		}     
        return $sValue;
    }	
	
	public function CreateBlog($sql) {

		if ($iId=$this->oDb->query($sql)) {
			return $iId;
		}		
		return false;
    }
	
	public function DelZayavki($user,$tournament) {
		$sql = "DELETE FROM tis_stat_zayavki WHERE user_id = ?d	and tournament_id = ?d";	
		
		if ($this->oDb->query($sql,$user, $tournament)) {
			return true;
		}		
		return false;
    }
	public function CheckZayavkaTime($user,$tournament) {

			$sql = "INSERT INTO `tis_stat_playertournament` (`user_id`, `tournament_id`, `dates`) 
			
					select	?d, ?d,  NOW() from tis_stat_playertournament where not exists (select 1 FROM tis_stat_playertournament WHERE user_id = ?d	and tournament_id = ?d);";	
					
			if ($this->oDb->query($sql,$user, $tournament,$user, $tournament)) {
				return true;
			}		
			return false;

    }
	public function CheckSetZayavkaTime($user,$tournament, $psnid) {

			$sql = "UPDATE `tis_stat_playertournament`  
			
					SET psnid = ?s 
					where tournament_id= ?d and user_id = ?d";	
					
			if ($this->oDb->query($sql, $psnid, $tournament, $user)) {
				return true;
			}		
			return false;

    }
	public function InsertZayavkaTime($user,$tournament) {
		
    }	
	public function InsertZayavki($user, $tournament, $number, $prior ) {
	
		$sql = "INSERT INTO `tis_stat_zayavki` (`user_id`, `tournament_id`, `team_id`, `prioritet`) VALUES
					(?d, ?d, ?d, ?d);";	
				
		if ($this->oDb->query($sql,$user, $tournament, $number, $prior )) {

			return true;
		}		
		return false;
    }
}

?>