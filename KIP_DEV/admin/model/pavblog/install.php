<?php 

/******************************************************
 * @package Pav blog module for Opencart 1.5.x
 * @version 1.1
 * @author http://www.pavothemes.com
 * @copyright	Copyright (C) Feb 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/

/**
 * class ModelPavbloginstall 
 */
class ModelPavbloginstall extends Model { 
	public function checkInstall(){
		
		$sql = " SHOW TABLES LIKE '".DB_PREFIX."pavblog_blog'";
		$query = $this->db->query( $sql );
		
		if( count($query->rows) <=0 ){ 
			$this->createTables();		
			$this->createDataSample();
			$this->createDefaultConfig();
		}
	}
	
	public function createTables(){
		$sql =array();
		$sql[] = "
			
			CREATE TABLE IF NOT EXISTS `".DB_PREFIX."pavblog_blog` (
			   `blog_id` int(11) NOT NULL AUTO_INCREMENT,
			   `category_id` int(11) NOT NULL,
			   `position` int(11) NOT NULL,
			   `created` date NOT NULL,
			   `status` tinyint(1) NOT NULL,
			   `user_id` int(11) NOT NULL,
			   `hits` int(11) NOT NULL,
			   `image` varchar(255) NOT NULL,
			   `meta_keyword` varchar(255) NOT NULL,
			   `meta_description` varchar(255) NOT NULL,
			   `meta_title` varchar(255) NOT NULL,
			   `date_modified` date NOT NULL,
			   `video_code` varchar(255) NOT NULL,
			   `params` text NOT NULL,
			   `tags` varchar(255) NOT NULL,
			   `featured` tinyint(1) NOT NULL,
			   `keyword` varchar(255) NOT NULL,
			  PRIMARY KEY (`blog_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;
		
		";
		
		$sql[] = "
		
			
			CREATE TABLE IF NOT EXISTS `".DB_PREFIX."pavblog_blog_description` (
			  `blog_id` int(11) NOT NULL,
			  `language_id` int(11) NOT NULL,
			  `title` varchar(255) NOT NULL,
			  `description` text NOT NULL,
			  `content` text NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		";
		
		$sql[] = "
						
			CREATE TABLE IF NOT EXISTS `".DB_PREFIX."pavblog_category` (
			   `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `image` varchar(255) NOT NULL DEFAULT '',
			  `parent_id` int(11) NOT NULL DEFAULT '0',
			  `is_group` smallint(6) NOT NULL DEFAULT '2',
			  `width` varchar(255) DEFAULT NULL,
			  `submenu_width` varchar(255) DEFAULT NULL,
			  `colum_width` varchar(255) DEFAULT NULL,
			  `submenu_colum_width` varchar(255) DEFAULT NULL,
			  `item` varchar(255) DEFAULT NULL,
			  `colums` varchar(255) DEFAULT '1',
			  `type` varchar(255) NOT NULL,
			  `is_content` smallint(6) NOT NULL DEFAULT '2',
			  `show_title` smallint(6) NOT NULL DEFAULT '1',
			  `meta_keyword` varchar(255) NOT NULL DEFAULT '1',
			  `level_depth` smallint(6) NOT NULL DEFAULT '0',
			  `published` smallint(6) NOT NULL DEFAULT '1',
			  `store_id` smallint(5) unsigned NOT NULL DEFAULT '0',
			  `position` int(11) unsigned NOT NULL DEFAULT '0',
			  `show_sub` smallint(6) NOT NULL DEFAULT '0',
			  `url` varchar(255) DEFAULT NULL,
			  `target` varchar(25) DEFAULT NULL,
			  `privacy` smallint(5) unsigned NOT NULL DEFAULT '0',
			  `position_type` varchar(25) DEFAULT 'top',
			  `menu_class` varchar(25) DEFAULT NULL,
			  `description` text,
			  `meta_description` text,
			  `meta_title` varchar(255) DEFAULT NULL,
			  `level` int(11) NOT NULL,
			  `left` int(11) NOT NULL,
			  `right` int(11) NOT NULL,
			  `keyword` varchar(255) NOT NULL,
			  PRIMARY KEY (`category_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

		";
		$sql[] = "
		
			
				CREATE TABLE IF NOT EXISTS `".DB_PREFIX."pavblog_category_description` (
				  `category_id` int(11) NOT NULL,
				  `language_id` int(11) NOT NULL,
				  `title` varchar(255) NOT NULL,
				  `description` text NOT NULL,
				  PRIMARY KEY (`category_id`,`language_id`),
				  KEY `name` (`title`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		";
		
		$sql[] = "
			
					CREATE TABLE IF NOT EXISTS `".DB_PREFIX."pavblog_comment` (
					  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `blog_id` int(11) unsigned NOT NULL,
					  `comment` text NOT NULL,
					  `status` tinyint(1) NOT NULL DEFAULT '0',
					  `created` datetime DEFAULT NULL,
					  `user` varchar(255) NOT NULL,
					  `email` varchar(255) NOT NULL,
					  PRIMARY KEY (`comment_id`),
					  KEY `FK_blog_comment` (`blog_id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
		";
		foreach( $sql as $q ){
			$query = $this->db->query( $q );
		}
		return ;
	}
	
	public function createDataSample(){
		$sql = array();
		
		$sql[] = "
		
INSERT INTO `".DB_PREFIX."pavblog_blog` (`blog_id`, `category_id`, `position`, `created`, `status`, `user_id`, `hits`, `image`, `meta_keyword`, `meta_description`, `meta_title`, `date_modified`, `video_code`, `params`, `tags`, `featured`, `keyword`) VALUES
(7, 21, 2, '2013-03-09', 1, 1, 47, 'data/pavblog/pav-i1.jpg', '', '', '', '2013-04-04', '', '', 'joomla, prestashop, magento', 1, ''),
(9, 21, 0, '2013-03-09', 1, 1, 74, 'data/pavblog/pav-i1.jpg', '', '', '', '2013-04-04', '', '', 'prestashop, magento', 0, ''),
(10, 21, 0, '2013-03-09', 1, 1, 227, 'data/pavblog/pav-i1.jpg', 'test test', '', 'Custom SEO Titlte', '2013-04-04', '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;http://www.youtube.com/embed/-ZsFrs2O8pI&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;', '', 'prestashop', 0, ''),
(11, 21, 0, '2013-03-11', 1, 1, 58, 'data/pavblog/pav-i1.jpg', '', '', '', '2013-04-04', '', '', 'opencart', 0, '');
 

		";
		$sql[] = "


INSERT INTO  `".DB_PREFIX."pavblog_blog_description`  (`blog_id`, `language_id`, `title`, `description`, `content`) VALUES
(7, 1, 'Ac tincidunt Suspendisse malesuada', '&lt;p&gt;Ac tincidunt Suspendisse malesuada velit in Nullam elit magnis netus Vestibulum. Praesent Nam adipiscing Aliquam elit accumsan wisi sit semper scelerisque convallis. Sed quisque cum velit&lt;/p&gt;\r\n', '&lt;div class=&quot;itemFullText&quot;&gt;\r\n&lt;p&gt;Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Suspendisse tortor ante adipiscing risus Aenean Lorem vitae id. Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor Aenean nulla lacinia Nullam elit vel vel. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.&lt;/p&gt;\r\n\r\n&lt;p&gt;Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Sed mauris Pellentesque elit Aliquam at lacus interdum nascetur elit ipsum. Enim ipsum hendrerit Suspendisse turpis laoreet fames tempus ligula pede ac. Et Lorem penatibus orci eu ultrices egestas Nam quam Vivamus nibh. Morbi condimentum molestie Nam enim odio sodales pretium eros sem pellentesque. Sit tellus Integer elit egestas lacus turpis id auctor nascetur ut. Ac elit vitae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.&lt;/p&gt;\r\n&lt;/div&gt;\r\n'),
(7, 2, '', '', ''),
(7, 3, '', '', ''),
(9, 1, 'Commodo laoreet semper tincidunt lorem ', '&lt;p&gt;Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Suspendisse tortor ante adipiscing risus Aenean Lorem vitae id. Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor Aenean nulla lacinia Nullam elit vel vel. At risus pretium urna tortor metus fringilla interdum mauris tempor congue&lt;/p&gt;\r\n', '&lt;div class=&quot;itemFullText&quot;&gt;\r\n&lt;p&gt;Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Suspendisse tortor ante adipiscing risus Aenean Lorem vitae id. Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor Aenean nulla lacinia Nullam elit vel vel. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.&lt;/p&gt;\r\n\r\n&lt;p&gt;Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Sed mauris Pellentesque elit Aliquam at lacus interdum nascetur elit ipsum. Enim ipsum hendrerit Suspendisse turpis laoreet fames tempus ligula pede ac. Et Lorem penatibus orci eu ultrices egestas Nam quam Vivamus nibh. Morbi condimentum molestie Nam enim odio sodales pretium eros sem pellentesque. Sit tellus Integer elit egestas lacus turpis id auctor nascetur ut. Ac elit vitae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.&lt;/p&gt;\r\n&lt;/div&gt;\r\n'),
(9, 2, '', '', ''),
(9, 3, '', '', ''),
(10, 1, 'Neque porro quisquam est, qui dolorem ipsum', '&lt;p&gt;&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.&lt;/p&gt;\r\n', '&lt;p&gt;&lt;img align=&quot;left&quot; alt=&quot;&quot; src=&quot;http://localhost/opencart-work/opencart-1.5.5.1/upload/image/data/demo/htc_touch_hd_3.jpg&quot; style=&quot;width: 350px; height: 350px;&quot; /&gt;Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&lt;/p&gt;\r\n'),
(10, 2, '', '', ''),
(10, 3, '', '', ''),
(11, 1, 'Donec tellus Nulla lorem Nullam elit id ut', '&lt;p&gt;Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.&lt;/p&gt;\r\n', '&lt;div class=&quot;itemFullText&quot;&gt;\r\n&lt;p&gt;Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Euismod euismod Suspendisse tortor ante adipiscing risus Aenean Lorem vitae id. Odio ut pretium ligula quam Vestibulum consequat convallis fringilla Vestibulum nulla. Accumsan morbi tristique auctor Aenean nulla lacinia Nullam elit vel vel. At risus pretium urna tortor metus fringilla interdum mauris tempor congue.&lt;/p&gt;\r\n\r\n&lt;p&gt;Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Phasellus tristique justo. Justo Pellentesque Donec lobortis faucibus Vestibulum Praesent mauris volutpat vitae metus. Ipsum cursus vestibulum at interdum Vivamus nunc fringilla Curabitur ac quis. Nam lacinia wisi tortor orci quis vitae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Sed mauris Pellentesque elit Aliquam at lacus interdum nascetur elit ipsum. Enim ipsum hendrerit Suspendisse turpis laoreet fames tempus ligula pede ac. Et Lorem penatibus orci eu ultrices egestas Nam quam Vivamus nibh. Morbi condimentum molestie Nam enim odio sodales pretium eros sem pellentesque. Sit tellus Integer elit egestas lacus turpis id auctor nascetur ut. Ac elit vitae.&lt;/p&gt;\r\n\r\n&lt;p&gt;Mi vitae magnis Fusce laoreet nibh felis porttitor laoreet Vestibulum faucibus. At Nulla id tincidunt ut sed semper vel Lorem condimentum ornare. Laoreet Vestibulum lacinia massa a commodo habitasse velit Vestibulum tincidunt In. Turpis at eleifend leo mi elit Aenean porta ac sed faucibus. Nunc urna Morbi fringilla vitae orci convallis condimentum auctor sit dui. Urna pretium elit mauris cursus Curabitur at elit Vestibulum.&lt;/p&gt;\r\n&lt;/div&gt;\r\n'),
(11, 2, '', '', ''),
(11, 3, '', '', '');
		
		";
		$sql[] = "
	
INSERT INTO `".DB_PREFIX."pavblog_category`(`category_id`, `image`, `parent_id`, `is_group`, `width`, `submenu_width`, `colum_width`, `submenu_colum_width`, `item`, `colums`, `type`, `is_content`, `show_title`, `meta_keyword`, `level_depth`, `published`, `store_id`, `position`, `show_sub`, `url`, `target`, `privacy`, `position_type`, `menu_class`, `description`, `meta_description`, `meta_title`, `level`, `left`, `right`, `keyword`) VALUES
(1, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, '1', 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, NULL, NULL, NULL, -5, 34, 47, ''),
(20, 'data/pavblog/pav-c3.jpg', 22, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, '1', 0, 1, 0, 3, 0, NULL, NULL, 0, 'top', 'test test', NULL, NULL, NULL, 0, 0, 0, ''),
(21, 'data/pavblog/pav-c1.jpg', 22, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, '1', 0, 1, 0, 1, 0, NULL, NULL, 0, 'top', '', NULL, NULL, NULL, 0, 0, 0, ''),
(22, 'data/demo/canon_eos_5d_1.jpg', 1, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, '1', 0, 1, 0, 1, 0, NULL, NULL, 0, 'top', '', NULL, NULL, NULL, 0, 0, 0, ''),
(23, 'data/pavblog/pav-c2.jpg', 22, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, '1', 0, 1, 0, 2, 0, NULL, NULL, 0, 'top', '', NULL, NULL, NULL, 0, 0, 0, ''),
(24, 'data/logo.png', 1, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, '1', 0, 1, 0, 2, 0, NULL, NULL, 0, 'top', '', NULL, NULL, NULL, 0, 0, 0, '');

	
		";
		$sql[] = "

INSERT INTO  `".DB_PREFIX."pavblog_category_description`  (`category_id`, `language_id`, `title`, `description`) VALUES
(1, 1, 'ROOT', 'Menu Root'),
(22, 1, 'Demo Category 1', '&lt;p&gt;Enter your Category 1 Description Here&lt;/p&gt;\r\n'),
(24, 1, 'Demo Category 2', '&lt;p&gt;Description Here&lt;/p&gt;\r\n'),
(21, 2, '', ''),
(20, 2, '', ''),
(23, 2, 'French language', ''),
(20, 1, 'Demo Category 1-2', '&lt;p&gt;Ac tincidunt Suspendisse malesuada velit in Nullam elit magnis netus Vestibulum. Praesent Nam adipiscing Aliquam elit accumsan wisi sit semper scelerisque convallis&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n'),
(23, 1, 'Demo Category 1-2-2', '&lt;p&gt;Ac tincidunt Suspendisse malesuada velit in Nullam elit magnis netus Vestibulum. Praesent Nam adipiscing Aliquam elit accumsan wisi sit semper scelerisque convallis&lt;/p&gt;\r\n'),
(21, 1, 'Demo Category 1 2-1', '&lt;p&gt;Ac tincidunt Suspendisse malesuada velit in Nullam elit magnis netus Vestibulum. Praesent Nam adipiscing Aliquam elit accumsan wisi sit semper scelerisque convallis&lt;/p&gt;\r\n'),
(21, 3, '', ''),
(23, 3, '', ''),
(20, 3, '', '');		
		
		";
		
		$sql[] = "
		
INSERT INTO `".DB_PREFIX."pavblog_comment` (`comment_id`, `blog_id`, `comment`, `status`, `created`, `user`, `email`) VALUES
(6, 10, 'Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur mag Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur mag', 1, '2013-03-12 14:23:09', 'ha cong tien', 'hatuhn@gmail.com'),
(7, 10, 'Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur mag', 1, '2013-03-12 14:25:19', 'ha cong tien', 'hatuhn@gmail.com'),
(8, 10, 'Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur mag Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur mag', 1, '2013-03-12 14:30:17', 'Test Test ', 'ngoisao@aa.com');
		";
		
		foreach( $sql as $q ){
			$query = $this->db->query( $q );
		}
		
		return ;
	}
	
	public function createDefaultConfig(){
	 
		$sql  = "
			INSERT INTO  `".DB_PREFIX."layout` (
					`layout_id` ,
					`name`
					)
					VALUES (
					NULL , 'Pav Blog'
					);
		
		";
		$query = $this->db->query( $sql );
		
		$id = $this->db->getLastId();
		
		$sql = "
			INSERT INTO `".DB_PREFIX."layout_route` (
				`layout_route_id` ,
				`layout_id` ,
				`store_id` ,
				`route`
				)
				VALUES (
				NULL , '".$id."', '0', 'pavblog/');
		
		";
		$query = $this->db->query( $sql );
		
		
		
		///
		$d['pavblog'] = array(
			'children_columns' => '3',
			'general_cwidth' => '250',
			'general_cheight' => '250',
			'general_lwidth'=> '620',
			'general_lheight'=> '300',
			'general_sheight'=> '250',
			'general_swidth'=> '250',
			'general_xwidth' => '80',
			'general_xheight' => '80',
			'cat_show_hits' => '1',
			'cat_limit_leading_blog'=> '1',
			'cat_limit_secondary_blog'=> '5',
			'cat_leading_image_type'=> 'l',
			'cat_secondary_image_type'=> 's',
			'cat_show_title'=> '1',
			'cat_show_image'=> '1',
			'cat_show_author'=> '1',
			'cat_show_category'=> '1',
			'cat_show_created'=> '1',
			'cat_show_readmore' => 1,
			'cat_show_description' => '1',
			'cat_show_comment_counter'=> '1',
			
			'blog_image_type'=> 'l',
			'blog_show_title'=> '1',
			'blog_show_image'=> '1',
			'blog_show_author'=> '1',
			'blog_show_category'=> '1',
			'blog_show_created'=> '1',
			'blog_show_comment_counter'=> '1',
			'blog_show_comment_form'=>'1',
			'blog_show_hits' => 1,
			'cat_columns_leading_blogs'=> 1,
			'cat_columns_secondary_blogs' => 2,
			'comment_engine' => 'local',
			'diquis_account' => 'pavothemes',
			'facebook_appid' => '100858303516',
			'facebook_width'=> '600',
			'comment_limit'=> '10',
			'auto_publish_comment'=>0,
			'enable_recaptcha' => 1,
			'recaptcha_public_key'=>'6LcoLd4SAAAAADoaLy7OEmzwjrf4w7bf-SnE_Hvj',
			'recaptcha_private_key'=>'6LcoLd4SAAAAAE18DL_BUDi0vmL_aM0vkLPaE9Ob',
			'rss_limit_item' => 12,
			'keyword_listing_blogs_page'=>'blogs'
	
		);
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('pavblog', $d );	
		
		return ;
	}
}

?>