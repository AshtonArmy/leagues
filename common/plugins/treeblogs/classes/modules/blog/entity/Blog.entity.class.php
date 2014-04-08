<?php

/* ---------------------------------------------------------------------------
 * @Plugin Name: Treeblogs
 * @Plugin Id: Treeblogs
 * @Plugin URI:
 * @Description: Дерево блогов
 * @Author: mackovey@gmail.com
 * @Author URI: http://stfalcon.com
 * @LiveStreet Version: 0.4.2
 * @License: GNU GPL v2, http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * ----------------------------------------------------------------------------
 */

class PluginTreeblogs_ModuleBlog_EntityBlog extends PluginTreeblogs_Inherit_ModuleBlog_EntityBlog
{

    public function getParentId()
    {
        return $this->_aData['parent_id'];
    }

    public function getOrderNum()
    {
        return $this->_aData['order_num'];
    }

    public function getBlogsOnly()
    {
        return $this->_aData['blogs_only'];
    }

    public function setParentId($data)
    {
        if ($data == 0) {
            $this->_aData['parent_id'] = null;
        } else {
            $this->_aData['parent_id'] = $data;
        }
    }

    public function getParentBlog()
    {
        if (!isset($this->_aData['parent_blog'])) {
            if ($this->_aData['parent_id']) {
                $this->_aData['parent_blog'] = $this->Blog_GetBlogById($this->_aData['parent_id']);
            } else {
                $this->_aData['parent_blog'] = null;
            }
        }

        return $this->_aData['parent_blog'];
    }

    public function setOrderNum($data)
    {
        $this->_aData['order_num'] = $data;
    }

    public function setBlogsOnly($data)
    {
        $this->_aData['blogs_only'] = (bool) $data;
    }

    public function getBlogsUrl()
    {
        return Router::GetPath('blogs').$this->getUrl().'/';
    }
	
	public function getSubForums()
    {
        return $this->Blog_GetSubBlogs($this->getId());
    }
	
	public function getLastForumTopic()
    {
        //return $this->Topic_GetTopicsByFilter($this->getId());
		$aIds=$this->getId();


		$aFilter=array(
			'blog_type' => array(
				'open',
			),
			'topic_publish' => 1,
			'blog_id'=>$aIds,
		'order'=>' t.topic_last_update desc'
		);

		$aReturn = $this->Topic_GetTopicsByFilter($aFilter,1,1,array('user','blog','comment_new'));
		return reset($aReturn['collection']); 
		
    }
	
	public function getTopics($iPage=1,$iPerPage=3) {

		$aIds=array($this->getId());

 
			$aFilter=array(
				'blog_type' => array(
					'open',
				),
				'topic_publish' => 1,
				'blog_id'=>$aIds,
			'order'=>' t.topic_last_update desc'
			);

			$aReturn = $this->Topic_GetForumTopicsByFilter($aFilter,$iPage,$iPerPage,array('user','blog','comment_new'));
			return $aReturn['collection'];
			
 
		
		return array();
	}
	public function getSubTopics($iPage=1,$iPerPage=3) {

		$aIds=array($this->getId());

 
			$aFilter=array(
				'blog_type' => array(
					'open',
				),
				'topic_publish' => 1,
				'top_blog_id'=>$aIds,
			'order'=>' t.topic_last_update desc'
			);

			$aReturn = $this->Topic_GetTopicsByFilter($aFilter,$iPage,$iPerPage,array('user','blog','comment_new'));
			return $aReturn['collection'];
			
 
		
		return array();
	}
	
		public function getTopic($iPage=1,$iPerPage=1) {

		$aIds=array($this->getId());

 
			$aFilter=array(
				'blog_type' => array(
					'open',
				),
				'topic_publish' => 1,
				'blog_id'=>$aIds,
			'order'=>' t.topic_last_update desc'
			);

			$aReturn = $this->Topic_GetForumTopicsByFilter($aFilter,$iPage,$iPerPage,array('user','blog','comment_new'));
			return reset($aReturn['collection']);		
		return array();
	}
	
	
	public function getLastForumTopics($iPerPage)
    {
        //return $this->Topic_GetTopicsByFilter($this->getId());
		$aIds=$this->getId();


		$aFilter=array(
			'blog_type' => array(
				'open',
			),
			'topic_publish' => 1,
			'blog_id'=>$aIds,
		'order'=>' t.topic_last_update desc'
		);

		$aReturn = $this->Topic_GetTopicsByFilter($aFilter,1,$iPerPage,array('user','blog','comment_new'));
		return $aReturn['collection']; 
		
    }
	
}
