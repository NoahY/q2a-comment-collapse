<?php
	class qa_collapse_admin {
		
		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {

			switch($option) {
				case 'collapse_comment_max_comments':
					return 5;
				case 'collapse_comment_text':
					return 'show # more comments';
				default:
					return null;
			}
		}

		function admin_form(&$qa_content)
		{

		//	Process form input

			$ok = null;
			if (qa_clicked('collapse_button')) {
				
				qa_opt('collapse_comment_enable',(bool)qa_post_text('collapse_comment_enable'));
				qa_opt('collapse_comment_max_comments',(int)qa_post_text('collapse_comment_max_comments'));
				qa_opt('collapse_comment_text',qa_post_text('collapse_comment_text'));
				
				$ok = qa_lang('admin/options_saved');
			}
			else if (qa_clicked('collapse_reset_button')) {
				foreach($_POST as $i => $v) {
					$def = $this->option_default($i);
					if($def !== null) qa_opt($i,$def);
				}
				$ok = qa_lang('admin/options_reset');
			}	
					
		//	Create the form for display
			
		
			$fields = array();

			$fields[] = array(
				'label' => 'Enable comment collapsing',
				'tags' => 'NAME="collapse_comment_enable"',
				'value' => qa_opt('collapse_comment_enable'),
				'type' => 'checkbox',
			);

			$fields[] = array(
				'label' => 'Number of comments to show',
				'tags' => 'NAME="collapse_comment_max_comments"',
				'value' => qa_opt('collapse_max_comments'),
				'type' => 'number',
			);

			$fields[] = array(
				'label' => 'Text to show more comments',
				'tags' => 'NAME="collapse_comment_text"',
				'value' => qa_opt('collapse_comment_text'),
				'note' => '# is replaced by number of remaining comments',
			);
						
			return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,
				
				'fields' => $fields,
				
				'buttons' => array(
					array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'NAME="collapse_button"',
					),
					array(
					'label' => qa_lang_html('admin/reset_options_button'),
					'tags' => 'NAME="collapse_reset_button"',
					),
				),
			);
		}
	}
