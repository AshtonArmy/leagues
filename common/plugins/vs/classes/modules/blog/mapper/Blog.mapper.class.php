<?php

class PluginVs_ModuleBlog_MapperBlog extends PluginVs_Inherit_ModuleBlog_MapperBlog {


	public function GetBlogsBySql($sWhere) {
	$sql = "SELECT 
						b.blog_id							
					FROM ".Config::Get('db.table.blog')." as b			
					WHERE 
						1=1					
						".$sWhere."									
					ORDER by b.blog_id asc";		
		$aBlogs=array();
		if ($aRows=$this->oDb->select($sql)) {			
			foreach ($aRows as $aBlog) {
				$aBlogs[]=$aBlog['blog_id'];
			}
		}

		return $aBlogs;
	}
	
	public function GetBlogByTournamentId($tournament_id) {		
		/*$sql = "SELECT 
				b.blog_id 
			FROM 
				".Config::Get('db.table.blog')." as b
			WHERE 
				b.tournament_id = ? 		
				";*/
		$sql = "SELECT 
				t.blog_id 
			FROM 
				tis_stat_tournament as t
			WHERE 
				t.tournament_id = ? 		
				";
		if ($aRow=$this->oDb->selectRow($sql,$tournament_id)) {
			return $aRow['blog_id'];
		}
		return null;
	}
	
	public function GetBlogByTeamId($team_id) {		
		$sql = "SELECT 
				b.blog_id 
			FROM 
				".Config::Get('db.table.blog')." as b
			WHERE 
				b.team_id = ? 		
				";
		if ($aRow=$this->oDb->selectRow($sql,$team_id)) {
			return $aRow['blog_id'];
		}
		return null;
	}
	
	public function UpdateTeam(ModuleBlog_EntityBlog $oBlog, $team_id) {
		$sql = "UPDATE ".Config::Get('db.table.blog')." 
			SET 
				team_id= ? 
			WHERE
				blog_id = ?d
		";
		if ($this->oDb->query($sql,$team_id, $oBlog->getId() )) {
			return true;
		}
		return false;
	}
		
	public function SetTeamLeague(ModuleBlog_EntityBlog $oBlog) {
		$sql = "UPDATE ".Config::Get('db.table.blog')." 
			SET 
				team = ?,
				league =? 
			WHERE
				blog_id = ?d
		";
		if ($this->oDb->query($sql, $oBlog->getTeam(), $oBlog->getLeague(), $oBlog->getId() )) {
			return true;
		}
		return false;
	}
	
	public function SetLogos(ModuleBlog_EntityBlog $oBlog, $type) {
	
		if($type=='small'){
			$logo = $oBlog->getLogoSmall();
		}elseif($type=='team'){
			$logo = $oBlog->getLogoTeam();
		}else{
			$logo = $oBlog->getLogoFull();
		}
		$sql = "UPDATE ".Config::Get('db.table.blog')." 
			SET 
				logo_".$type." = ? 
			WHERE
				blog_id = ?d
		";
		if ($this->oDb->query($sql, $logo,  $oBlog->getId() )) {
			return true;
		}
		return false;
	}
	
	public function GetLeagues() {

        $aCriteria = array(
            'filter' => array('in_url'=>Config::Get('plugin.vs.league_blogs')),
            'order'  => array(/*'blog_rating'=>'desc',*/'blog_id'=>'asc'),
        //    'limit'  => array(1, 20),
        );
		
		$aResult = $this->GetBlogsIdByCriteria($aCriteria);
		$aResult = $this->Blog_GetBlogsAdditionalData($aResult['data']);
        return $aResult;
    }
	public function GetBlogsIdByCriteria($aCriteria = array()) {

        if (isset($aCriteria['filter'])) {
            $aFilter = $aCriteria['filter'];
        } else {
            $aFilter = array();
        }
        if (isset($aFilter['not_blog_id'])) {
            if (!is_array($aFilter['not_blog_id'])) {
                $aFilter['not_blog_id'] = array(intval($aFilter['not_blog_id']));
            }
        }
        if (isset($aFilter['blog_title_like'])) {
            if (substr($aFilter['blog_title'], -1) !== '%') {
                $aFilter['blog_title'] .= '%';
            }
        }
		if (isset($aFilter['in_url']) and !is_array($aFilter['in_url'])) {
			$aFilter['in_url']=array($aFilter['in_url']);
		}
		
        // Сортировка
        $sSqlOrder = '';
        if (isset($aCriteria['order'])) {
            $aOrderAllow = array('blog_id', 'blog_title', 'blog_rating', 'blog_count_user', 'blog_count_topic');
            if (!is_array($aCriteria['order'])) {
                $aCriteria['order'] = array($aCriteria['order']);
            }
            $aOrders = F::Array_FlipIntKeys($aCriteria['order'], 'ASC');
            $aOrderList = array();
            foreach ($aOrders as $sField => $sWay) {
                $sField = strtolower(trim($sField));
                if (strpos($sField, ' ')) {
                    list($sField, $sWay) = explode(' ', $sField, 2);
                }
                if (in_array($sField, $aOrderAllow)) {
                    $aOrderList[] = $sField . ' ' . ((strtoupper($sWay) == 'DESC') ? 'DESC' : 'ASC');
                }
            }
            if ($aOrderList) {
                $sSqlOrder = 'ORDER BY ' . implode(',' , $aOrderList);
            }
        }

        // Установка лимита
        $sSqlLimit = '';
        if (isset($aCriteria['limit'])) {
            // Если массив, то первое значение - смещение, а второе - лимит
            if (is_array($aCriteria['limit'])) {
                $nOffset = intval(array_shift($aCriteria['limit']));
                $nLimit = intval(array_shift($aCriteria['limit']));
            } else {
                $nOffset = false;
                $nLimit = intval($aCriteria['limit']);
            }
        } else {
            $nOffset = false;
            $nLimit = false;
        }
        // Если задан ID блога, то всегда устанавливаем лимит
        if (isset($aFilter['blog_id']) && !is_array($aFilter['blog_id'])) {
            $nOffset = false;
            $nLimit = 1;
        }

        // Формируем строку лимита и автосчетчик общего числа записей
        if ($nOffset !== false && $nLimit !== false) {
            $sSqlLimit = 'LIMIT ' . $nOffset . ', ' . $nLimit;
            $nCalcTotal = static::CRITERIA_CALC_TOTAL_AUTO;
        } elseif ($nLimit != false && $nLimit != 1) {
            $sSqlLimit = 'LIMIT ' . $nLimit;
            $nCalcTotal = static::CRITERIA_CALC_TOTAL_AUTO;
        } else {
            $nCalcTotal = static::CRITERIA_CALC_TOTAL_SKIP;
        }

        // Обрабатываем опции
        if (isset($aCriteria['options']) && is_array($aCriteria['options'])) {
            if (array_key_exists('calc_total', $aCriteria['options'])) {
                if ($aCriteria['options']['calc_total'] != static::CRITERIA_CALC_TOTAL_AUTO) {
                    $nCalcTotal = $aCriteria['options']['calc_total'];
                }
                // Если требуется только подсчет записей, то строку лимита принудительно устанавливаем в 0
                // Запрос с LIMIT 0 отрабатывает моментально
                if ($aCriteria['options']['calc_total'] != static::CRITERIA_CALC_TOTAL_ONLY) {
                    $sSqlLimit = 'LIMIT 0';
                }
            }
        }
		$bBlogTypeJoin = false;
/*
        // Необходимость JOIN'а
        $aBlogTypeFields = array(
            'allow_add', 'min_rate_add', 'allow_list', 'min_rate_list', 'acl_read', 'min_rate_read', 'acl_write',
            'min_rate_write', 'acl_comment', 'min_rate_comment', 'index_ignore', 'membership',
        );
		print_r($aFilter);
        if ($aFilter 
			&& array_intersect($aFilter, $aBlogTypeFields)) {
            $bBlogTypeJoin = true;
        } else {
            $bBlogTypeJoin = false;
        }
*/
        $sql = "
            SELECT b.blog_id
            FROM ?_blog AS b
                { INNER JOIN ?_blog_type AS bt ON bt.type_code=b.blog_type AND 1=?d }
            WHERE
                1 = 1
                { AND (b.blog_id = ?d) }
                { AND (b.blog_id IN (?a)) }
                { AND (b.blog_id NOT IN (?a)) }
                { AND (b.user_owner_id = ?d) }
                { AND (b.user_owner_id IN (?a)) }
                { AND (b.blog_type = ?) }
                { AND (b.blog_type IN (?a)) }
                { AND (b.blog_type != ?) }
                { AND (b.blog_type NOT IN (?a)) }
                { AND blog_url = ? }
				{ AND blog_url IN ( ?a )}
                { AND blog_title = ? }
                { AND blog_title LIKE ? }
                { AND (bt.allow_add = ?d) }
                { AND (bt.min_rate_add >= ?d) }
                { AND (bt.allow_list = ?d) }
                { AND (bt.min_rate_list >= ?d) }
                { AND (bt.acl_read & ?d > 0) }
                { AND (bt.min_rate_read >= ?d) }
                { AND (bt.acl_write & ?d > 0) }
                { AND (bt.min_rate_write >= ?d) }
                { AND (bt.acl_comment & ?d > 0) }
                { AND (bt.min_rate_comment >= ?d) }
                { AND (bt.index_ignore = ?d) }
                { AND (bt.membership = ?d) }
        " . $sSqlOrder . ' ' . $sSqlLimit;
        $aData = $this->oDb->selectCol($sql,
            $bBlogTypeJoin ? 1 : DBSIMPLE_SKIP,
            (isset($aFilter['blog_id']) && !is_array($aFilter['blog_id'])) ? $aFilter['blog_id'] : DBSIMPLE_SKIP,
            (isset($aFilter['blog_id']) && is_array($aFilter['blog_id'])) ? $aFilter['blog_id'] : DBSIMPLE_SKIP,
            isset($aFilter['not_blog_id']) ? $aFilter['not_blog_id'] : DBSIMPLE_SKIP,
            (isset($aFilter['user_id']) && !is_array($aFilter['user_id'])) ? $aFilter['user_id'] : DBSIMPLE_SKIP,
            (isset($aFilter['user_id']) && is_array($aFilter['user_id'])) ? $aFilter['user_id'] : DBSIMPLE_SKIP,
            (isset($aFilter['blog_type']) && !is_array($aFilter['blog_type'])) ? $aFilter['blog_type'] : DBSIMPLE_SKIP,
            (isset($aFilter['blog_type']) && is_array($aFilter['blog_type'])) ? $aFilter['blog_type'] : DBSIMPLE_SKIP,
            (isset($aFilter['not_blog_type']) && !is_array($aFilter['not_blog_type'])) ? $aFilter['not_blog_type'] : DBSIMPLE_SKIP,
            (isset($aFilter['not_blog_type']) && is_array($aFilter['not_blog_type'])) ? $aFilter['not_blog_type'] : DBSIMPLE_SKIP,
            isset($aFilter['blog_url']) ? $aFilter['blog_url'] : DBSIMPLE_SKIP,
			isset($aFilter['in_url']) ? $aFilter['in_url'] : DBSIMPLE_SKIP,
            isset($aFilter['blog_title']) ? $aFilter['blog_title'] : DBSIMPLE_SKIP,
            isset($aFilter['blog_title_like']) ? $aFilter['blog_title_like'] : DBSIMPLE_SKIP,
            isset($aFilter['allow_add']) ? ($aFilter['allow_add'] ? 1 : 0) : DBSIMPLE_SKIP,
            isset($aFilter['min_rate_add']) ? $aFilter['min_rate_add'] : DBSIMPLE_SKIP,
            isset($aFilter['allow_list']) ? ($aFilter['allow_list'] ? 1 : 0) : DBSIMPLE_SKIP,
            isset($aFilter['min_rate_list']) ? $aFilter['min_rate_list'] : DBSIMPLE_SKIP,
            isset($aFilter['acl_read']) ? $aFilter['acl_read'] : DBSIMPLE_SKIP,
            isset($aFilter['min_rate_read']) ? $aFilter['min_rate_read'] : DBSIMPLE_SKIP,
            isset($aFilter['acl_write']) ? $aFilter['acl_write'] : DBSIMPLE_SKIP,
            isset($aFilter['min_rate_write']) ? $aFilter['min_rate_write'] : DBSIMPLE_SKIP,
            isset($aFilter['acl_comment']) ? $aFilter['acl_comment'] : DBSIMPLE_SKIP,
            isset($aFilter['min_rate_comment']) ? $aFilter['min_rate_comment'] : DBSIMPLE_SKIP,
            isset($aFilter['index_ignore']) ? ($aFilter['index_ignore'] ? 1 : 0) : DBSIMPLE_SKIP,
            isset($aFilter['membership']) ? ($aFilter['membership'] ? 1 : 0) : DBSIMPLE_SKIP
        );
        $aResult = array(
            'data' => $aData ? $aData : array(),
            'total' => -1,
        );
        if ($nCalcTotal) {
            $sLastQuery = trim($this->Database_GetLastQuery());
            $n = strpos($sLastQuery, ' LIMIT ');
            if ($n) {
                $sql = str_replace('SELECT b.blog_id', 'SELECT COUNT(*) AS cnt', substr($sLastQuery, 0, $n));
                $aData = $this->oDb->select($sql);
                if ($aData) {
                    $aResult['total'] = $aData[0]['cnt'];
                }
            }
        }
        return $aResult;
    }
/*	public function GetBlogsByFilter($aFilter,$aOrder,&$iCount,$iCurrPage,$iPerPage) {
		$aOrderAllow=array('blog_id','blog_title','blog_rating','blog_count_user','blog_count_topic');
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
			$sOrder=' blog_id desc ';
		}

		if (isset($aFilter['exclude_type']) and !is_array($aFilter['exclude_type'])) {
			$aFilter['exclude_type']=array($aFilter['exclude_type']);
		}
		if (isset($aFilter['type']) and !is_array($aFilter['type'])) {
			$aFilter['type']=array($aFilter['type']);
		}
		if (isset($aFilter['in_url']) and !is_array($aFilter['in_url'])) {
			$aFilter['in_url']=array($aFilter['in_url']);
		}

		$sql = "SELECT
					blog_id
				FROM
					".Config::Get('db.table.blog')."
				WHERE
					1 = 1
					{ AND blog_id = ?d }
					{ AND user_owner_id = ?d }
					{ AND blog_type IN (?a) }
					{ AND blog_type not IN (?a) }
					{ AND blog_url = ? }
					{ AND blog_url IN (?a) }
					{ AND blog_title LIKE ? }
				ORDER by {$sOrder}
				LIMIT ?d, ?d ;
					";
		$aResult=array();
		if ($aRows=$this->oDb->selectPage($iCount,$sql,
										  isset($aFilter['id']) ? $aFilter['id'] : DBSIMPLE_SKIP,
										  isset($aFilter['user_owner_id']) ? $aFilter['user_owner_id'] : DBSIMPLE_SKIP,
										  (isset($aFilter['type']) and count($aFilter['type']) ) ? $aFilter['type'] : DBSIMPLE_SKIP,
										  (isset($aFilter['exclude_type']) and count($aFilter['exclude_type']) ) ? $aFilter['exclude_type'] : DBSIMPLE_SKIP,
										  isset($aFilter['url']) ? $aFilter['url'] : DBSIMPLE_SKIP,
										  (isset($aFilter['in_url']) and count($aFilter['in_url']) ) ? $aFilter['in_url'] : DBSIMPLE_SKIP,
										  isset($aFilter['title']) ? $aFilter['title'] : DBSIMPLE_SKIP,
										  ($iCurrPage-1)*$iPerPage, $iPerPage
		)) {
			foreach ($aRows as $aRow) {
				$aResult[]=$aRow['blog_id'];
			}
		}
		return $aResult;
	}
*/	
	 public function increaseBlogCountComment($sBlogId) {
        $sql = "UPDATE   ".Config::Get('db.table.blog')."
			SET 
				blog_count_comment=blog_count_comment+1
			WHERE
				blog_id = ?
		";
        $bResult = $this->oDb->query($sql, $sBlogId);
        return $bResult !== false;
    }
	
	public function RecalculateCountTopic($iBlogId = null) {
        $sql = "
                UPDATE " . Config::Get('db.table.blog') . " b
                SET b.blog_count_comment = (
                    SELECT SUM(t.topic_count_comment)
                    FROM " . Config::Get('db.table.topic') . " t
                    WHERE
                        t.blog_id = b.blog_id
                    AND
                        t.topic_publish = 1
					GROUP BY t.blog_id	
                )
                WHERE 1=1
                    { AND b.blog_id = ?d }
            ";
        $bResult = $this->oDb->query($sql, is_null($iBlogId) ? DBSIMPLE_SKIP : $iBlogId);
        
		 $sql = "
                UPDATE " . Config::Get('db.table.blog') . " b
                SET b.last_topic_id = (
                    SELECT max(t.topic_id)
                    FROM " . Config::Get('db.table.topic') . " t
                    WHERE
                        t.blog_id = b.blog_id
                    AND
                        t.topic_publish = 1
					GROUP BY t.blog_id
                )
                WHERE 1=1
                    { AND b.blog_id = ?d }
            ";
        $bResult = $this->oDb->query($sql, is_null($iBlogId) ? DBSIMPLE_SKIP : $iBlogId);
        
		
		
		$sql = "
                UPDATE " . Config::Get('db.table.blog') . " b
                SET b.blog_count_topic = (
                    SELECT count(*)
                    FROM " . Config::Get('db.table.topic') . " t
                    WHERE
                        t.blog_id = b.blog_id
                    AND
                        t.topic_publish = 1
                )
                WHERE 1=1
                    { AND b.blog_id = ?d }
            ";
        $bResult = $this->oDb->query($sql, is_null($iBlogId) ? DBSIMPLE_SKIP : $iBlogId);
        return $bResult !== false;
    }
	
	
}

?>