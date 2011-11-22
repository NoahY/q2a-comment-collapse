<?php

	class qa_html_theme_layer extends qa_html_theme_base {
		function head_custom()
		{
			qa_html_theme_base::head_custom();
			if (qa_opt('collapse_comment_enable')) 
				$this->output('<style>','.qa-comment-collapsed{display:none} .qa-comment-collapser{font-weight:bold} .qa-comment-collapser .qa-c-item-footer{display:none} .qa-comment-collapser .qa-c-item-link{margin:0 !important}','</style>');
		}	
		function c_list($c_list, $class)
		{
			if (qa_opt('collapse_comment_enable') && count($c_list) > qa_opt('collapse_comment_max_comments')) {
				foreach ($c_list as $idx => $c_item)
					if((qa_opt('collapse_comment_prev') && (count($c_list)-$idx)>qa_opt('collapse_comment_max_comments')) || (!qa_opt('collapse_comment_prev') && $idx>=qa_opt('collapse_comment_max_comments')))
						$c_list[$idx]['classes'] = @$c_list[$idx]['classes'].' qa-comment-collapsed';
				$left = count($c_list)-qa_opt('collapse_comment_max_comments');
				$text = str_replace('#',$left,qa_opt('collapse_comment_text'));
				if($left == 1)
					$text = preg_replace('|`([^/]+)/[^`]+`|','$1',$text);
				else
					$text = preg_replace('|`[^/]+/([^`]+)`|','$1',$text);
				if(qa_opt('collapse_comment_prev'))
					array_unshift($c_list, array(
							'title' => $text,
							'url' => 'javascript:void(0)" onclick="jQuery(this).parent().siblings().show(200); jQuery(this).parent().hide(200)',
							'classes' => 'qa-comment-collapser'
						)
					);
				else
					$c_list[] = array(
						'title' => $text,
						'url' => 'javascript:void(0)" onclick="jQuery(this).parent().siblings().show(200); jQuery(this).parent().hide(200)',
						'classes' => 'qa-comment-collapser'
					);
						
			}
						
			qa_html_theme_base::c_list($c_list, $class);
		}	
		
	}
	
