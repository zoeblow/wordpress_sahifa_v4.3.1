<?php
function panel_options() { 

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	
	
$save='
	<div class="mpanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
        <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="mpanel-save" type="submit" value="保存设置" />    
	</div>'; 
?>
		
		
<div id="save-alert"></div>

<div class="mo-panel">

	<div class="mo-panel-tabs">
		<div class="logo"></div>
		<ul>
			<li class="tie-tabs general"><a href="#tab1"><span></span>全局设置</a></li>
			<li class="tie-tabs homepage"><a href="#tab2"><span></span>主页设置</a></li>
			<li class="tie-tabs header"><a href="#tab9"><span></span>头部设置</a></li>
			<li class="tie-tabs archives"><a href="#tab12"><span></span>归档设置</a></li>
			<li class="tie-tabs article"><a href="#tab6"><span></span>文章设置</a></li>
			<li class="tie-tabs sidebars"><a href="#tab11"><span></span>边栏设置</a></li>
			<li class="tie-tabs footer"><a href="#tab7"><span></span>底部设置</a></li>
			<li class="tie-tabs slideshow"><a href="#tab5"><span></span>幻灯片设置</a></li>
			<li class="tie-tabs banners"><a href="#tab8"><span></span>广告设置</a></li>
			<li class="tie-tabs styling"><a href="#tab13"><span></span>风格设置</a></li>
			<li class="tie-tabs typography"><a href="#tab14"><span></span>字体设置</a></li>
			<li class="tie-tabs Social"><a href="#tab4"><span></span>社交网络</a></li>
			<li class="tie-tabs advanced"><a href="#tab10"><span></span>高级设置</a></li>
		</ul>
		<div class="clear"></div>
	</div> <!-- .mo-panel-tabs -->
	
	
	<div class="mo-panel-content">
	<form action="/" name="tie_form" id="tie_form">
		<div id="tab1" class="tabs-wrap">
			<h2>全局设置</h2> <?php echo $save ?>
			<?php if(class_exists( 'bbPress' )): ?>
			<div class="tiepanel-item">
				<h3>bbPress设置</h3>
				<?php
					tie_options(
						array(	"name" => "bbPress Full width",
								"id" => "bbpress_full",
								"type" => "checkbox"));
				?>
			</div>
			<?php endif; ?>
			<div class="tiepanel-item">
				<h3>自定义小图标</h3>
				<?php
					tie_options(
						array(	"name" => "自定义小图标",
								"id" => "favicon",
								"type" => "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3>自定义用户头像</h3>
				<?php
					tie_options(
						array(	"name" => "自定义用户头像",
								"id" => "gravatar",
								"type" => "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3>苹果设备图标</h3>
				<?php
					tie_options(
						array(	"name" => "苹果Iphone设备图标",
								"id" => "apple_iphone",
								"type" => "upload",
								"extra_text" => '苹果iphone设备图标 (57px x 57px)')); 			

					tie_options(
						array(	"name" => "苹果视网膜设备图标 ",
								"id" => "apple_iphone_retina",
								"type" => "upload",
								"extra_text" => '苹果视网膜设备图标 (120px x 120px)')); 			

					tie_options(
						array(	"name" => "苹果ipad设备图标",
								"id" => "apple_iPad",
								"type" => "upload",
								"extra_text" => '苹果ipad设备图标 (72px x 72px)')); 			

					tie_options(
						array(	"name" => "ipad视网膜设备图标",
								"id" => "apple_iPad_retina",
								"type" => "upload",
								"extra_text" => 'ipad视网膜设备图标 (144px x 144px)')); 			

				?>
			</div>	
			<div class="tiepanel-item">
				<h3>时间格式</h3>
				<?php
					tie_options(
						array( 	"name" => "博客文章的时间格式",
								"id" => "time_format",
								"type" => "radio",
								"options" => array( "traditional"=>"传统" ,
													"modern"=>"若干天以前",
													"none"=>"无 " )));
				?>									
			</div>	
			
			<div class="tiepanel-item">
				<h3>面包屑导航设置</h3>
				<?php
					tie_options(
						array(	"name" => "开启面包屑导航 ",
								"id" => "breadcrumbs",
								"type" => "checkbox")); 
					
					tie_options(
						array(	"name" => "面包屑导航分隔符",
								"id" => "breadcrumbs_delimiter",
								"type" => "short-text"));
				?>
			</div>
						
			<div class="tiepanel-item">
				<h3>头部自定义代码</h3>
				<div class="option-item">
					<small>如果你需要在头部head标签添加css或者js代码，请在这里添加</small>
					<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>				
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>底部自定义代码</h3>
				<div class="option-item">
					<small>如果你需要在底部head标签添加css或者js代码，请在这里添加</small>

					<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
				</div>
			</div>	
			
		</div>
		
		<div id="tab9" class="tabs-wrap">
			<h2>头部设置</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>Logo</h3>
				<?php
					tie_options(
						array( 	"name" => "Logo设置",
								"id" => "logo_setting",
								"type" => "radio",
								"options" => array( "logo"=>"自定义图片Logo" ,
													"title"=>"展示站点标题" )));

					tie_options(
						array(	"name" => "Logo图片",
								"id" => "logo",
								"help" => "上传Logo图片或者输入Logo网址，如果没有更换，将会用主题默认图片代替",
								"type" => "upload",
								"extra_text" => '建议最大尺寸 : 190px x 60px')); 
								
					tie_options(
						array(	"name" => "Logo图片 (视网膜版本 @2x)",
								"id" => "logo_retina",
								"type" => "upload",
								"extra_text" => '请选择一个适用于视网膜屏幕的Logo. 应该为主Logo的两倍。')); 			
					
					tie_options(
						array(	"name" => "标准 Logo 宽度 与 视网膜 Logo",
								"id" => "logo_retina_width",
								"type" => "short-text",
								"extra_text" => '如果视网膜Logo已经上传, 请输入标准Logo的宽度, 不要输入视网膜Logo的宽度。')); 			

					tie_options(
						array(	"name" => "标准 Logo 高度 与 视网膜a Logo",
								"id" => "logo_retina_height",
								"type" => "short-text",
								"extra_text" => '如果视网膜图标上传, 请输入标准标志(1 x) 版本的高度, 不要进入视网膜标志的高度。')); 			
								
					tie_options(
						array(	"name" => "Logo 上边距",
								"id" => "logo_margin",
								"type" => "slider",
								"help" => "输入数据涉足Logo的顶部距离",
								"unit" => "px",
								"max" => 100,
								"min" => 0 ));

					tie_options(
						array(	"name" => "全宽 Logo",
								"id" => "full_logo",
								"type" => "checkbox",
								"extra_text" => '建议 Logo 宽度 : 1045px')); 

					tie_options(
						array(	"name" => "居中 Logo",
								"id" => "center_logo",
								"type" => "checkbox")); 			
				?>

			</div>
			

			<div class="tiepanel-item">
				<h3>头部目录设置</h3>
				<?php
					tie_options(
						array(	"name" => "隐藏头部目录",
								"id" => "top_menu",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "隐藏主导航",
								"id" => "main_nav",
								"type" => "checkbox"));	

					tie_options(
						array(	"name" => "今天日期",
								"id" => "top_date",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "日期格式 ",
								"id" => "todaydate_format",
								"type" => "text",
								"extra_text" => '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">文档的日期和时间格式。</a>')); 			
					tie_options(
						array(	"name" => "顶部目录右部区域",
								"id" => "top_right",
								"type" => "radio",
								"options" => array( ""=>"无" ,
													"search"=>"搜索" ,
													"social"=>"社交网站图标" ))); 
													
					tie_options(
						array(	"name" => "随机文章按钮",
								"id" => "random_article",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "锁定导航目录",
								"id" => "stick_nav",
								"type" => "checkbox")); 			
				?>		
			</div>
			

			<div class="tiepanel-item">
				<h3>即时新闻（头部滚动文字）</h3>
				<?php
					tie_options(
						array(	"name" => "启用",
								"id" => "breaking_news",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "仅在首页显示",
								"id" => "breaking_home",
								"type" => "checkbox")); 
												
					tie_options(
						array(	"name" => "即时新闻标题",
								"id" => "breaking_title",
								"type" => "text"));
																
					tie_options(
						array(	"name" => "动画风格",
								"id" => "breaking_effect",
								"type" => "select",
								"options" => array(
									'fade' => 'Fade',
									'slide' => 'Slide',
									'ticker' => 'Ticker',
								)));
								
					tie_options(
						array(	"name" => "滚动速度",
								"id" => "breaking_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

								
					tie_options(
						array(	"name" => "滚动间隔",
								"id" => "breaking_time",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				
				?>
				
				<?php				
					tie_options(
						array(	"name" => "即时新闻来源",
								"id" => "breaking_type",
								"options" => array( "category"	=>	"分类目录" ,
													"tag"		=>	"标签",
													"custom"	=>	"自定义文本"),
								"type" => "radio")); 
															
					
					tie_options(
						array(	"name" => "显示文章数量",
								"id" => "breaking_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "即时新闻标签",
								"help" => "输入标签名，用逗号（,）隔开 ",
								"id" => "breaking_tag",
								"type" => "text"));
								
				?>
					
				
					<div class="option-item" id="breaking_cat-item">
						<span class="label">即时新闻标签</span>
							<select multiple="multiple" name="tie_options[breaking_cat][]" id="tie_breaking_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , tie_get_option('breaking_cat') ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
		
			</div>
			
			<div class="tiepanel-item" id="breaking_custom-item">
				<h3>即时新闻自定义文本</h3>
					<div class="option-item" >
					
						<span class="label" style="width:40px">Text</span>
						<input id="custom_text" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_text" value="" />
						<span class="label" style="width:40px; margin-left:10px;">Link</span>
						<input id="custom_link" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_link" value="" />
						<input id="TextAdd"  class="small_button" type="button" value="Add" />
							
						<ul id="customList" style="margin-top:15px;">
						<?php $breaking_custom = tie_get_option( 'breaking_custom' ) ;
							$custom_count = 0 ;
							if($breaking_custom){
								foreach ($breaking_custom as $custom_text) { $custom_count++; ?>
							<li>
								<div class="widget-head">
									<a href="<?php echo $custom_text['link'] ?>" target="_blank"><?php echo $custom_text['text'] ?></a>
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][link]" type="hidden" value="<?php echo $custom_text['link'] ?>" />
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][text]" type="hidden" value="<?php echo $custom_text['text'] ?>" />
									<a class="del-custom-text"></a></div>
							</li>
								<?php }
							}
						?>
						</ul>
						<script>
							var customnext = <?php echo $custom_count+1 ?> ;
						</script>
					</div>	
				</div>
		</div> <!-- Header Settings -->
		
		
		
		<div id="tab2" class="tabs-wrap">
			<h2>主页设置</h2> <?php echo $save ?>
		
			<div class="tiepanel-item">
				<h3>主页显示：</h3>
				<?php
					tie_options(
						array( 	"name" => "主页显示",
								"id" => "on_home",
								"type" => "radio",
								"options" => array( "latest"=>"最新文章——博客风格" ,
													"boxes"=>" 新闻框——使用主页编辑器" )));
				?>
			</div>	
			
		<div id="主页编辑器" style="width:100%;">

			<div class="tiepanel-item">
				<h3>新闻框设置</h3>
				<?php
					tie_options(
						array( 	"name" => "文章摘要长度",
								"id" => "home_exc_length",
								"type" => "short-text"));	
					tie_options(
						array(	"name" => "文章投票",
								"id" => "box_meta_score",
								"type" => "checkbox" )); 			
					tie_options(
						array(	"name" => "作者信息",
								"id" => "box_meta_author",
								"type" => "checkbox",
								"extra_text" => '这个选项不应用于滚动框和最近的博客文章的风格。')); 			
					tie_options(
						array(	"name" => "日期",
								"id" => "box_meta_date",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "标签信息",
								"id" => "box_meta_cats",
								"type" => "checkbox",
								"extra_text" => '这个选项不应用于滚动框和最近的博客文章的风格。')); 
					tie_options(
						array(	"name" => "评论信息",
								"id" => "box_meta_comments",
								"type" => "checkbox",
								"extra_text" => '这个选项不应用于滚动框和最近的博客文章的风格。')); 
				?>
			</div>	
			
			
			<div class="tiepanel-item"  style=" overflow: visible; ">
				<h3>主页编辑器 					<a id="collapse-all">[-] 全部收起</a>
					<a id="expand-all">[+] 全部展开</a></h3>
				<div class="option-item">

					<select style="display:none" id="cats_defult">
						<?php foreach ($categories as $key => $option) { ?>
						<option value="<?php echo $key ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
				
					
					<div style="clear:both"></div>
					<div class="home-builder-buttons">
						<a id="add-cat" >新闻框</a>
						<a id="add-slider" >滚动新闻框</a>
						<a id="add-ads" >广告/自定义文本</a>
						<a id="add-news-picture" >新闻图片</a>
						<a id="add-news-videos" >视频</a>
						<a id="add-recent" >最新文章</a>
						<a id="add-divider" >分割线</a>
					</div>
										
					<ul id="cat_sortable">
						<?php
							$cats = get_option( 'tie_home_cats' ) ;
							if($cats){
							$i=0;
								foreach ($cats as $cat) { 
									$i++;
									?>
									<li id="listItem_<?php echo $i ?>" class="ui-state-default">
			
								<?php 
									if( $cat['type'] == 'n' ) :	?>
										<div class="widget-head"> 添加新闻框 : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新闻框分类目录 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label><span>文章排序 : </span><select name="tie_home_cats[<?php echo $i ?>][order]" id="tie_home_cats[<?php echo $i ?>][order]"><option value="latest" <?php if( $cat['order'] == 'latest' || $cat['order']=='' ) echo 'selected="selected"'; ?>>最新文章</option><option  <?php if( $cat['order'] == 'rand' ) echo 'selected="selected"'; ?> value="rand">随即文章</option></select></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>显示文章数 :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">新闻框风格 : </span>
												<ul class="tie-cats-options tie-options">
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="li" <?php if( $cat['style'] == 'li' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/li.png" /></a>
													</li>
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="2c" <?php if( $cat['style'] == '2c' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/2c.png" /></a>
													</li>
													<li style="margin-right:0 !important;">
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="1c" <?php if( $cat['style'] == '1c') echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/1c.png" /></a>
													</li>
												</ul>
											</label>
								<?php 
									elseif( $cat['type'] == 'recent' ) :	?>
										<div class="widget-head"> 最新文章
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span style="float:left;">除了这个分类 : </span><select multiple="multiple" name="tie_home_cats[<?php echo $i ?>][exclude][]" id="tie_home_cats[<?php echo $i ?>][exclude][]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['exclude'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>新闻框标题:</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>显示文章数 :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][display]"><span>显示模式:</span>
												<select id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]">
													<option value="default" <?php if ( $cat['display'] == 'default') { echo ' selected="selected"' ; } ?>>默认风格</option>
													<option value="blog" <?php if ( $cat['display'] == 'blog') { echo ' selected="selected"' ; } ?>>博客风格</option>
												</select>
											</label>
											<label for="tie_home_cats[<?php echo $i ?>][pagi]"><span>显示分页:</span>
												<select id="tie_home_cats[<?php echo $i ?>][pagi]" name="tie_home_cats[<?php echo $i ?>][pagi]">
													<option value="n" <?php if ( $cat['pagi'] == 'n') { echo ' selected="selected"' ; } ?>>否</option>
													<option value="y" <?php if ( $cat['pagi'] == 'y') { echo ' selected="selected"' ; } ?>>是</option>
												</select>
											</label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
										
									<?php elseif( $cat['type'] == 's' ) : ?>
										<div class="widget-head scrolling-box">滚动新闻框 : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新闻框分类目录 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>新闻框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>显示的文章数 :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
									<?php elseif( $cat['type'] == 'ads' ) : ?>
										<div class="widget-head ads-box"> 广告/自定义文本
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<textarea cols="36" rows="5" name="tie_home_cats[<?php echo $i ?>][text]" id="tie_home_cats[<?php echo $i ?>][text]"><?php echo stripslashes($cat['text']) ; ?></textarea>
											<small>支持 <strong>文本，THML和短代码</strong> .</small>

										
									<?php elseif( $cat['type'] == 'news-pic' ) : ?>
										<div class="widget-head news-pic-box">  图片新闻
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新闻框分类目录 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>新闻框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">Box Style : </span>
												<ul class="tie-cats-options tie-options">
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="default" <?php if( $cat['style'] == 'default' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic1.png" /></a>
													</li>
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="row" <?php if( $cat['style'] == 'row' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic2.png" /></a>
													</li>
												</ul>
											</label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
								<?php elseif( $cat['type'] == 'videos' ) : ?>
										<div class="widget-head news-pic-box">Videos
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>新闻框分类目录 : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>新闻框标题 :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
									<?php elseif( $cat['type'] == 'divider' ) : ?>
										<div class="widget-head news-pic-box">  分割线
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label for="tie_home_cats[<?php echo $i ?>][height]"><span>高度 :</span><input id="tie_home_cats[<?php echo $i ?>][height]" name="tie_home_cats[<?php echo $i ?>][height]" value="<?php  echo $cat['height']  ?>" type="text" style="width:50px;" /> px</label>

									<?php endif; ?>
									
									
											<input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
											<a class="del-cat"></a>
										
										</div>
									</li>
							<?php } 
							} else{?>
							<?php } ?>
					</ul>

					<script>
						var nextCell = <?php echo $i+1 ?> ;
						var templatePath =' <?php echo get_template_directory_uri(); ?>';
					</script>
				</div>	
			</div>
			
			<div class="tiepanel-item">
				<h3>分类分页框</h3>
				
				<?php
				tie_options(
					array(	"name" => "Show 分类目录 Tabs Box",
							"id" => "home_tabs_box",
							"type" => "checkbox")); 
							
					if( tie_get_option('home_tabs') )
						$tie_home_tabs = tie_get_option('home_tabs') ;
					else 
						$tie_home_tabs = array();
					
					$tie_home_tabs_new = array();					
					
					foreach ($tie_home_tabs as $key1 => $option1) {
						if ( array_key_exists( $option1 , $categories) )
							$tie_home_tabs_new[$option1] = $categories[$option1];
					}
					foreach ($categories as $key2 => $option2) {
						if ( !in_array( $key2 , $tie_home_tabs) )
							$tie_home_tabs_new[$key2] = $option2;
					}
				?>
					
				<div class="option-item">
					<span class="label">选择一个分类 : </span>
					<div class="clear"></div> <p></p>
					<ul id="tabs_cats">
						<?php foreach ($tie_home_tabs_new as $key => $option) { ?>
						<li><input id="tie_home_tabs" name="tie_options[home_tabs][]" type="checkbox" <?php if ( in_array( $key , $tie_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
						<span><?php echo $option; ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		</div> <!-- Homepage Settings -->
		
	
		
		<div id="tab4" class="tabs-wrap">
			<h2> 社交网络</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>自定义Feed地址</h3>
							
				<?php
					tie_options(
						array(	"name" => "隐藏RSS图标",
								"id" => "rss_icon",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "自定义Feed地址",
								"id" => "rss_url",
								"help" => "e.g. http://feedburner.com/userid",
								"type" => "text"));
				?>
			</div>
			
		<div class="tiepanel-item">
				<h3>社交网络</h3>
				<p class="tie_message_hint">链接前不要忘加上http://</p>
						
				<?php						
					tie_options(
						array(	"name" => "Facebook URL",
								"id" => "social",
								"key" => "facebook",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Twitter URL",
								"id" => "social",
								"key" => "twitter",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Google+ URL",
								"id" => "social",
								"key" => "google_plus",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "新浪微博",//MySpace
								"id" => "social",
								"key" => "myspace",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "腾讯微博",//Orkut
								"id" => "social",
								"key" => "orkut",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "网易微博",//dribbble
								"id" => "social",
								"key" => "dribbble",
								"type" => "arrayText"));
												
					tie_options(
						array(	"name" => "QQ空间",//linkedin
								"id" => "social",
								"key" => "linkedin",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "evernote URL",
								"id" => "social",
								"key" => "evernote",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Dropbox URL",
								"id" => "social",
								"key" => "dropbox",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Flickr URL",
								"id" => "social",
								"key" => "flickr",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Picasa Web URL",
								"id" => "social",
								"key" => "picasa",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "DeviantArt URL",
								"id" => "social",
								"key" => "deviantart",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "YouTube URL",
								"id" => "social",
								"key" => "youtube",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "grooveshark URL",
								"id" => "social",
								"key" => "grooveshark",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Vimeo URL",
								"id" => "social",
								"key" => "vimeo",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "ShareThis URL",
								"id" => "social",
								"key" => "sharethis",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "yahoobuzz URL",
								"id" => "social",
								"key" => "yahoobuzz",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "500px URL",
								"id" => "social",
								"key" => "px500",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Skype URL",
								"id" => "social",
								"key" => "skype",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Digg URL",
								"id" => "social",
								"key" => "digg",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Reddit URL",
								"id" => "social",
								"key" => "reddit",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Delicious URL",
								"id" => "social",
								"key" => "delicious",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "StumbleUpon  URL",
								"key" => "stumbleupon",
								"id" => "social",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "FriendFeed URL",
								"id" => "social",
								"key" => "friendfeed",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Tumblr URL",
								"id" => "social",
								"key" => "tumblr",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Blogger URL",
								"id" => "social",
								"key" => "blogger",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Wordpress URL",
								"id" => "social",
								"key" => "wordpress",
								"type" => "arrayText"));						
					tie_options(
						array(	"name" => "Yelp URL",
								"id" => "social",
								"key" => "yelp",
								"type" => "arrayText"));							
					tie_options(
						array(	"name" => "posterous URL",
								"id" => "social",
								"key" => "posterous",
								"type" => "arrayText"));																														
					tie_options(
						array(	"name" => "Last.fm URL",
								"id" => "social",
								"key" => "lastfm",
								"type" => "arrayText"));						
					tie_options(
						array(	"name" => "Apple URL",
								"id" => "social",
								"key" => "apple",
								"type" => "arrayText"));											
					tie_options(
						array(	"name" => "FourSquare URL",
								"id" => "social",
								"key" => "foursquare",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Github URL",
								"id" => "social",
								"key" => "github",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "openid URL",
								"id" => "social",
								"key" => "openid",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "SoundCloud URL",
								"id" => "social",
								"key" => "soundcloud",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "xing.me URL",
								"id" => "social",
								"key" => "xing",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Google Play URL",
								"id" => "social",
								"key" => "google_play",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Pinterest URL",
								"id" => "social",
								"key" => "Pinterest",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Instagram URL",
								"id" => "social",
								"key" => "instagram",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Spotify URL",
								"id" => "social",
								"key" => "spotify",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "PayPal URL",
								"id" => "social",
								"key" => "paypal",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Forrst URL",
								"id" => "social",
								"key" => "forrst",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Behance URL",
								"id" => "social",
								"key" => "behance",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Viadeo URL",
								"id" => "social",
								"key" => "viadeo",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "VK.com URL",
								"id" => "social",
								"key" => "vk",
								"type" => "arrayText"));
				?>
			</div>			
		</div><!-- 社交网络 -->
		
		
		<div id="tab5" class="tab_content tabs-wrap">
			<h2>幻灯片设置</h2> <?php echo $save; ?>
			<div class="tiepanel-item">
				<h3>幻灯片设置</h3>
				<?php
					tie_options(
						array(	"name" => "启用",
								"id" => "slider",
								"type" => "checkbox")); 
		
					tie_options(
						array(	"name" => "幻灯片类型",
								"id" => "slider_type",
								"options" => array( "flexi"=>"Flexi Slider" ,
													"elastic"=>"Elastic Slideshow " ),
								"type" => "radio")); 

					tie_options(
						array(	"name" => "显示幻灯片属性",
								"id" => "slider_caption",
								"type" => "checkbox")); 

					tie_options(
						array(	"name" => "幻灯片属性长度",
								"id" => "slider_caption_length",
								"type" => "short-text"));
								
				?>
				<div class="option-item">
					<span class="label">幻灯片位置</span>
					<div style="float:left; width: 338px;">
						<?php
							$checked = 'checked="checked"';
							$tie_slider_pos = tie_get_option('slider_pos');
						?>
						<ul id="sidebar-position-options" class="tie-options">
							<li style="margin:5px 20px 5px 0 ">
								<input id="tie_slider_pos"  name="tie_options[slider_pos]" type="radio" value="small" <?php if($tie_slider_pos == 'small' || !$tie_slider_pos ) echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/small-slider.png" /></a>
							</li>
							<li>
								<input id="tie_slider_pos"  name="tie_options[slider_pos]" type="radio" value="big" <?php if($tie_slider_pos == 'big') echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/big-slider.png" /></a>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
			<div id="elastic" class="tiepanel-item">
			<h3>Elastic Slideshow Settings</h3>
				<?php
					tie_options(
						array(	"name" => "动画效果",
								"id" => "elastic_slider_effect",
								"type" => "select",
								"options" => array(
									'center' => '居中',
									'sides' => 'Sides'
								)));

					tie_options(
						array(	"name" => "自动播放",
								"id" => "elastic_slider_autoplay",
								"type" => "checkbox"));
					
					
					tie_options(
						array(	"name" => "幻灯片速度",
								"id" => "elastic_slider_interval",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					tie_options(
						array(	"name" => "动画速度",
								"id" => "elastic_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>

			<div id="flexi" class="tiepanel-item">
			<h3>Flexi 幻灯片设置</h3>
				<?php
					if( is_rtl() ){
						tie_options(
							array(	"name" => "动画效果",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => 'Fade',
										'slideV' => 'Slide Vertical',
									)));
					}else{
						tie_options(
							array(	"name" => "动画效果",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => 'Fade',
										'slideV' => 'Slide Vertical',
										'slideH' => 'Slide Horizontal',
									)));
					}
								
					tie_options(
						array(	"name" => "幻灯片速度",
								"id" => "flexi_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					tie_options(
						array(	"name" => "动画速度",
								"id" => "flexi_slider_time",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Query Settings</h3>
			<?php
					tie_options(
						array(	"name" => "显示的文章数",
								"id" => "slider_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "询问类型",
								"id" => "slider_query",
								"options" => array( "category"=>"分类目录" ,
													"tag"=>"标签",
													"post"=>"选定的文章",
													"page"=>"选定的页面" ,
													"custom"=>"自定义幻灯片" ),
								"type" => "radio")); 
								
					tie_options(
						array(	"name" => "标签",
								"help" => "Enter a tag name, or names seprated by comma. ",
								"id" => "slider_tag",
								"type" => "text"));
			?>
				<?php $slider_cat = tie_get_option('slider_cat') ; ?>
					<div class="option-item" id="slider_cat-item">
						<span class="label">分类目录</span>
							<select multiple="multiple" name="tie_options[slider_cat][]" id="tie_slider_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $slider_cat ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
						<a class="mo-help tooltip" title="Enter a category ID, or IDs seprated by comma. "></a>
					</div>
					
			<?php
																
					tie_options(
						array(	"name" => "选定的文章ID",
								"help" => "输入文章ID，以逗号隔开 ",
								"id" => "slider_posts",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "选定的页面ID",
								"help" => "输入页面ID，用逗号隔开 ",
								"id" => "slider_pages",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "自定义幻灯片",
								"help" => "选择自定义幻灯片",
								"id" => "slider_custom",
								"type" => "select",
								"options" => $sliders));
			?>
			
			</div>
		</div> <!-- Slideshow -->
		
				
		<div id="tab6" class="tab_content tabs-wrap">
			<h2>文章设置</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>投票系统设置</h3>
				<?php
					tie_options(
						array( 	"name" => '谁被允许投票 ?',
								"id" => "allowtorate",
								"type" => "radio",
								"options" => array( "none"=> '禁用' ,
													"both"=> '注册用户和游客',
													"guests"=>'仅游客',
													"users"=>'仅注册用户') ));
				?>									
			</div>
			
			<div class="tiepanel-item">
				<h3>文章元素</h3>
				<?php
					tie_options(
						array(	"name" => "显示特色图片",
								"desc" => "",
								"id" => "post_featured",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "文章作者信息",
								"desc" => "",
								"id" => "post_authorbio",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "下一篇/前一篇文章",
								"desc" => "",
								"id" => "post_nav",
								"type" => "checkbox")); 

					tie_options(
						array(	"name" => "OG Meta",
								"desc" => "",
								"id" => "post_og_cards",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">

				<h3>文章信息设置</h3>
				<?php
					tie_options(
						array(	"name" => "文章信息 :",
								"id" => "post_meta",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "作者信息",
								"id" => "post_author",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "日期",
								"id" => "post_date",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "分类信息",
								"id" => "post_cats",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "评论信息",
								"id" => "post_comments",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "标签信息",
								"id" => "post_tags",
								"type" => "checkbox"));

								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>分享文章设置</h3>
				<?php
					tie_options(
						array(	"name" => "显示在文章下方的分享按钮 :",
								"id" => "share_post",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "顶部的文章分享按钮 :",
								"id" => "share_post_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Tweet 按钮",
								"id" => "share_tweet",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Twitter 用户名 <small>(可选)</small>",
								"id" => "share_twitter_username",
								"type" => "text"));
						
					tie_options(
						array(	"name" => "Facebook Like 按钮",
								"id" => "share_facebook",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Google+ 按钮",
								"id" => "share_google",
								"type" => "checkbox"));
								
																
					tie_options(
						array(	"name" => "Linkedin 按钮",
								"id" => "share_linkdin",
								"type" => "checkbox"));
																					
					tie_options(
						array(	"name" => "StumbleUpon 按钮",
								"id" => "share_stumble",
								"type" => "checkbox"));
								
																			
					tie_options(
						array(	"name" => "Pinterest 按钮",
								"id" => "share_pinterest",
								"type" => "checkbox"));
								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>相关文章设置</h3>
				<?php
					tie_options(
						array(	"name" => "相关文章",
								"id" => "related",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "相关文章 新闻框标题",
								"id" => "related_title",
								"type" => "text")); 
								
					tie_options(
						array(	"name" => "显示的文章数",
								"id" => "related_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "询问类型",
								"id" => "related_query",
								"options" => array( "category"=>"分类目录" ,
													"tag"=>"标签",
													"author"=>"作者" ),
								"type" => "radio")); 
				?>
			</div>

			
			<div class="tiepanel-item">

				<h3>评论验证设置</h3>
				<?php
					tie_options(
						array(	"name" => "需要验证评论 ",
								"id" => "comment_validation",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- 文章设置 -->
		
		
		<div id="tab7" class="tabs-wrap">
			<h2>底部设置</h2> <?php echo $save ?>

			<div class="tiepanel-item">

				<h3>底部元素</h3>
				<?php
					tie_options(
						array(	"name" => "'回到顶部' 图标",
								"id" => "footer_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "社交网站图标",
								"desc" => "",
								"id" => "footer_social",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>底部自定义边栏</h3>
					<div class="option-item">

					<?php
						$checked = 'checked="checked"';
						$tie_footer_widgets = tie_get_option('footer_widgets');
					?>
					<ul id="footer-widgets-options" class="tie-options">
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-1c" <?php if($tie_footer_widgets == 'footer-1c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-1c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-2c" <?php if($tie_footer_widgets == 'footer-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="narrow-wide-2c" <?php if($tie_footer_widgets == 'narrow-wide-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-narrow-wide.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-narrow-2c" <?php if($tie_footer_widgets == 'wide-narrow-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-wide-narrow.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-3c" <?php if($tie_footer_widgets == 'footer-3c' || !$tie_footer_widgets ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-left-3c" <?php if($tie_footer_widgets == 'wide-left-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-left.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-right-3c" <?php if($tie_footer_widgets == 'wide-right-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-right.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-4c" <?php if($tie_footer_widgets == 'footer-4c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-4c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="disable" <?php if($tie_footer_widgets == 'disable') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-no.png" /></a>
						</li>

					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>底部文本框一</h3>
				<div class="option-item">
					<textarea id="tie_footer_one" name="tie_options[footer_one]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_one'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">Variables</strong>
						这些标签可以包含在上面的文本区和显示一个页面时将被替换。
						<br />
						<strong>%year%</strong> : <em>被当前的 年 所取代，</em><br />
						<strong>%site%</strong> : <em>R被网站的名字所取代，</em><br />
						<strong>%url%</strong>  : <em>被网站的 URI取代。</em>
					</span>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>底部文本框二</h3>
				<div class="option-item">
					<textarea id="tie_footer_two" name="tie_options[footer_two]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_two'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">Variables</strong>
						这些标签可以包含在上面的文本区和显示一个页面时将被替换。
						<br />
						<strong>%year%</strong> : <em>被当前的 年 所取代，</em><br />
						<strong>%site%</strong> : <em>R被网站的名字所取代，</em><br />
						<strong>%url%</strong>  : <em>被网站的 URI取代。</em>
					</span>
				</div>
			</div>

		</div><!-- 底部设置 -->

		
		<div id="tab8" class="tab_content tabs-wrap">
			<h2>横幅设置</h2> <?php echo $save ?>
			<div class="tiepanel-item">
				<h3>背景图片广告</h3>
				<?php
					tie_options(				
						array(	"name" => "启用 背景图片广告",
								"id" => "banner_bg",
								"type" => "checkbox")); 	
							
					tie_options(					
						array(	"name" => "背景图片广告 Link",
								"id" => "banner_bg_url",
								"type" => "text"));
				?>
				<p class="tie_message_hint">
					到"风格" 选项卡设置“背景类型”设置为“自定义背景” 然后上传您的自定义图像并且启用 <strong>"全屏背景"</strong> 选项 ...  <a href="http://themes.tielabs.com/docs/sahifa/#!/setting_up_a_background" target="_blank">点击这里</a> 查看更多信息。
				</p>
			</div>
			<div class="tiepanel-item">
				<h3>顶部横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "顶部横幅",
								"id" => "banner_top",
								"type" => "checkbox"));
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "顶部横幅 Image",
								"id" => "banner_top_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "顶部横幅 Link",
								"id" => "banner_top_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图片替换文字",
								"id" => "banner_top_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新标签页中打开链接",
								"id" => "banner_top_tab",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_top_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应式谷歌广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "谷歌Adsense ID",
								"id" => "banner_top_publisher",
								"type" => "text"));

					tie_options(					
						array(	"name" => "728x90 (Leaderboard) - ad ID",
								"id" => "banner_top_728",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_top_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_top_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Custom Ad Code",
								"id" => "banner_top_adsense",
								"extra_text" => '支持 <strong>文本，THML和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3>底部横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "底部横幅",
								"id" => "banner_bottom",
								"type" => "checkbox")); 
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "底部横幅 Image",
								"id" => "banner_bottom_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "底部横幅链接",
								"id" => "banner_bottom_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图片替换文字",
								"id" => "banner_bottom_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新标签页中打开链接",
								"id" => "banner_bottom_tab",
								"type" => "checkbox"));
						
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_bottom_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应式谷歌广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "谷歌Adsense ID",
								"id" => "banner_bottom_publisher",
								"type" => "text"));

					tie_options(					
						array(	"name" => "728x90 (Leaderboard) - ad ID",
								"id" => "banner_bottom_728",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_bottom_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_bottom_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_bottom_adsense",
								"extra_text" => '支持 <strong>文本，THML和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
	
			<div class="tiepanel-item">
				<h3>文章上方横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "文章上方横幅",
								"id" => "banner_above",
								"type" => "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "文章上方横幅 Image",
								"id" => "banner_above_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "文章上方横幅 Link",
								"id" => "banner_above_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图片替换文字",
								"id" => "banner_above_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新标签页中打开链接",
								"id" => "banner_above_tab",
								"type" => "checkbox"));
					
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_above_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应式谷歌广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "谷歌Adsense ID",
								"id" => "banner_above_publisher",
								"type" => "text"));
	
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_above_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_above_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_above_adsense",
								"extra_text" => '支持 <strong>文本，THML和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
			
			<div class="tiepanel-item">
				<h3>文章下方横幅区域</h3>
				<?php
					tie_options(				
						array(	"name" => "文章下方横幅",
								"id" => "banner_below",
								"type" => "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">图片广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "文章下方横幅 Image",
								"id" => "banner_below_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "文章下方横幅 Link",
								"id" => "banner_below_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "图片替换文字",
								"id" => "banner_below_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "在新标签页中打开链接",
								"id" => "banner_below_tab",
								"type" => "checkbox"));
							
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_below_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">响应式谷歌广告</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "谷歌Adsense ID",
								"id" => "banner_below_publisher",
								"type" => "text"));
	
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_below_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_below_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">自定义代码</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "自定义广告代码",
								"id" => "banner_below_adsense",
								"extra_text" => '支持 <strong>文本，THML和短代码</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3>商家广告</h3>
				<?php
					tie_options(				
						array(	"name" => "[广告1] 商家Banner",
								"id" => "ads1_shortcode",
								"type" => "textarea")); 
	
					tie_options(
						array(	"name" => "[广告2] 商家Banner",
								"id" => "ads2_shortcode",
								"type" => "textarea")); 
				?>
			</div>
		</div> <!-- 横幅设置 -->
		
			

		<div id="tab11" class="tab_content tabs-wrap">
			<h2>幻灯片</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>幻灯片位置</h3>
				<div class="option-item">
					<?php
						$checked = 'checked="checked"';
						$tie_sidebar_pos = tie_get_option('sidebar_pos');
					?>
					<ul id="sidebar-position-options" class="tie-options">
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' || !$tie_sidebar_pos ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
						</li>
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>添加幻灯片</h3>
				<div class="option-item">
					<span class="label">幻灯片名称</span>
					
					<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="" />
					<input id="sidebarAdd"  class="small_button" type="button" value="Add" />
					
					<ul id="sidebarsList">
					<?php $sidebars = tie_get_option( 'sidebars' ) ;
						if($sidebars){
							foreach ($sidebars as $sidebar) { ?>
						<li>
							<div class="widget-head"><?php echo $sidebar ?>  <input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="del-sidebar"></a></div>
						</li>
							<?php }
						}
					?>
					</ul>
				</div>				
			</div>

			<div class="tiepanel-item" id="custom-sidebars">
				<h3>Custom 幻灯片</h3>
				<?php
				
				$new_sidebars = array(''=> 'Default');
				if (class_exists('Woocommerce'))
					$new_sidebars ['shop-widget-area'] = __( 'Shop - For WooCommerce Pages', 'tie' ) ;

				if($sidebars){
					foreach ($sidebars as $sidebar) {
						$new_sidebars[$sidebar] = $sidebar;
					}
				}
				
				
				tie_options(				
					array(	"name" => "首页幻灯片",
							"id" => "sidebar_home",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "页面幻灯片",
							"id" => "sidebar_page",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Single Article Sidebar",
							"id" => "sidebar_post",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "分类页面幻灯片",
							"id" => "sidebar_archive",
							"type" => "select",
							"options" => $new_sidebars ));

				if(class_exists( 'bbPress' ))
				tie_options(				
					array(	"name" => "bbPress Sidebar",
							"id" => "sidebar_bbpress",
							"type" => "select",
							"options" => $new_sidebars )); 

				?>
				<p class="tie_message_hint">
				You can Set Custom 幻灯片 for Your Categories from category's edit page .. Go to <strong><a target="Blank" href="edit-tags.php?taxonomy=category">Categories Page</a></strong> - edit the 分类目录 you want and choose your custom sidebar from <strong><?php echo theme_name;?> - 分类目录 Settings</strong> box  .
				</p>
			</div>
		</div> <!-- 幻灯片 -->
		
		
		<div id="tab12" class="tab_content tabs-wrap">
			<h2>分类页面设置</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>全局设置</h3>
				<p class="tie_message_hint">以下设置将应用主页博客上的布局和所有页面的博客列表模板。</p>
				<?php
					tie_options(
						array(	"name" => "显示",
								"id" => "blog_display",
								"help" => "will appears in all archives pages like categories / tags / search and in homepage blog style .",
								"type" => "radio",
								"options" => array( "excerpt"=>"摘要和特色图片" ,
													"full_thumb"=>"摘要和完整尺寸特色图片" ,
													"content"=>"文章" )));
								
					tie_options(
						array(	"name" => "显示社交按钮",
								"id" => "archives_socail",
								"type" => "checkbox",
								"help" => "if checked Facebook , Twitter , Google plus and Pinterest social buttons will appear in all archives pages like categories / tags / search and in homepage blog style ." ));
					
					tie_options(
						array( 	"name" => "摘要长度",
								"id" => "exc_length",
								"type" => "short-text"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>分类目录文章信息</h3>
				<p class="tie_message_hint">F以下设置将应用主页博客上的布局和所有页面的博客列表模板。</p>
				<?php
					tie_options(
						array(	"name" => "投票分数",
								"id" => "arc_meta_score",
								"type" => "checkbox" )); 			
					tie_options(
						array(	"name" => "作者信息",
								"id" => "arc_meta_author",
								"type" => "checkbox")); 			
					tie_options(
						array(	"name" => "日期",
								"id" => "arc_meta_date",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "标签信息",
								"id" => "arc_meta_cats",
								"type" => "checkbox")); 
					tie_options(
						array(	"name" => "评论信息",
								"id" => "arc_meta_comments",
								"type" => "checkbox")); 
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>分类目录 页面设置</h3>
				<?php
					tie_options(
						array(	"name" => "分类目录描述",
								"id" => "category_desc",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "RSS 图标",
								"id" => "category_rss",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>标签页面设置</h3>
				<?php
					tie_options(
						array(	"name" => "RSS 图标",
								"id" => "tag_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>作者页面设置</h3>
				<?php
					tie_options(
						array(	"name" => "作者简介",
								"id" => "author_bio",
								"type" => "checkbox"));
				?>
				<?php
					tie_options(
						array(	"name" => "RSS 图标",
								"id" => "author_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Search 页面设置</h3>
				<?php
					tie_options(
						array(	"name" => "用分类目录ID搜索",
								"id" => "search_cats",
								"help" => "Use minus sign (-) to exclude categories. Example: (1,4,-7) = search only in 分类目录 1 & 4, and exclude 分类目录 7.",
								"type" => "text"));
				?>
				<?php
					tie_options(
						array(	"name" => "搜索中显示页面结果",
								"id" => "search_exclude_pages",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Archives -->
				
				
		<div id="tab13" class="tab_content tabs-wrap">
			<h2>风格设置</h2>	<?php echo $save ?>	
			<div class="tiepanel-item">
				<h3>主题颜色设置</h3>

				<div class="option-item">
					<span class="label">选择主题颜色</span>
			
					<?php
						$checked = 'checked="checked"';
						$theme_color = tie_get_option('theme_skin');
					?>
					<ul style="clear:both" id="theme-skins" class="tie-options">
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="0" <?php if(!$theme_color) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-none.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ef3636" <?php if($theme_color == '#ef3636' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-red.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#37b8eb" <?php if($theme_color == '#37b8eb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-blue.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#81bd00" <?php if($theme_color == '#81bd00') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-green.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#e95ca2" <?php if($theme_color == '#e95ca2') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-pink.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#000" <?php if($theme_color == '#000') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-black.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ffbb01" <?php if($theme_color == '#ffbb01' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-yellow.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#7b77ff" <?php if($theme_color == '#7b77ff') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-purple.png" /></a>
						</li>
					</ul>
				</div>

				<?php
					tie_options(
						array(	"name" => "自定义主题颜色",
								"id" => "global_color",
								"type" => "color"));

					tie_options(				
						array(	"name" => "暗色",
								"id" => "dark_skin",
								"type" => "checkbox")); 
								
					tie_options(				
						array(	"name" => "彩色的滚动条",
								"id" => "modern_scrollbar",
								"type" => "checkbox",
								"extra_text" => '仅供Chrome和Safari浏览器。'));
				?>
			</div>	
			<div class="tiepanel-item">

				<h3>背景类型</h3>
				<?php
					tie_options(
						array( 	"name" => "背景类型",
								"id" => "background_type",
								"type" => "radio",
								"options" => array( "pattern"=>"系统背景" ,
													"custom"=>"自定义背景" )));
				?>
			</div>

			<div class="tiepanel-item" id="pattern-settings">
				<h3>选择样式</h3>
				
				<?php
					tie_options(
						array( 	"name" => "背景样式",
								"id" => "background_pattern_color",
								"type" => "color" ));
				?>
				
				<?php
					$checked = 'checked="checked"';
					$theme_pattern = tie_get_option('background_pattern');
				?>
				<ul id="theme-pattern" class="tie-options">
					<?php for($i=1 ; $i<=36 ; $i++ ){ 
					 $pattern = 'body-bg'.$i; ?>
					<li>
						<input id="tie_background_pattern"  name="tie_options[background_pattern]" type="radio" value="<?php echo $pattern ?>" <?php if($theme_pattern == $pattern ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/pattern<?php echo $i ?>.png" /></a>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="tiepanel-item" id="bg_image_settings">
				<h3>自定义背景</h3>
				<?php
					tie_options(
						array(	"name" => "自定义背景",
								"id" => "background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "全屏背景",
								"id" => "background_full",
								"type" => "checkbox"));
				?>

			</div>	
			<div class="tiepanel-item">
				<h3>Body 风格设置</h3>
				<?php
				
					tie_options(
						array(	"name" => "高亮文本颜色",
								"id" => "highlighted_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "链接颜色",
								"id" => "links_color",
								"type" => "color"));
					tie_options(
						array(	"name" => "链接修饰",
								"id" => "links_decoration",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));

					tie_options(
						array(	"name" => "鼠标经过的链接颜色",
								"id" => "links_color_hover",
								"type" => "color"));
	
					tie_options(
						array(	"name" => "鼠标经过的链接修饰",
								"id" => "links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>顶部导航风格设置</h3>
				<?php
					tie_options(
						array(	"name" => "背景",
								"id" => "topbar_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "链接颜色",
								"id" => "topbar_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "鼠标经过的链接颜色",
								"id" => "topbar_links_color_hover",
								"type" => "color"));
				?>

				<?php
					tie_options(
						array(	"name" => "今天日期背景",
								"id" => "todaydate_background",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "今天日期颜色",
								"id" => "todaydate_color",
								"type" => "color"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>头部背景</h3>
				<?php
					tie_options(
						array(	"name" => "背景",
								"id" => "header_background",
								"type" => "background"));
				?>
			</div>
			
						
			<div class="tiepanel-item">
				<h3>主导航风格设置</h3>
				<p class="tie_message_hint">改变的主要导航背景您需要编辑图片<strong>images/main-menu-bg</strong>通过照片编辑软件和改变它的颜色。</p>
				<?php
					tie_options(
						array(	"name" => "子菜单背景",
								"id" => "sub_nav_background",
								"type" => "color"));

					tie_options(
						array(	"name" => "链接颜色",
								"id" => "nav_links_color",
								"type" => "color"));
										
					tie_options(
						array(	"name" => "链接文字阴影颜色",
								"id" => "nav_shadow_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "鼠标经过的链接颜色",
								"id" => "nav_links_color_hover",
								"type" => "color"));

					tie_options(
						array(	"name" => "鼠标在链接上文本阴影颜色",
								"id" => "nav_shadow_color_hover",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "当前项链接颜色",
								"id" => "nav_current_links_color",
								"type" => "color"));
										
					tie_options(
						array(	"name" => "当前项链接文本阴影颜色",
								"id" => "nav_current_shadow_color",
								"type" => "color"));

					tie_options(
						array(	"name" => "Seprator Line1 颜色",
								"id" => "nav_sep1",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "Seprator Line2 颜色",
								"id" => "nav_sep2",
								"type" => "color"));
				?>
			</div>
			
			
			<div class="tiepanel-item">
				<h3>突发新闻 风格设置</h3>
				<?php
					tie_options(
						array(	"name" => "突发新闻 背景 ",
								"id" => "breaking_title_bg",
								"type" => "color"));
				?>		
			</div>

			<div class="tiepanel-item">
				<h3>文章风格设置</h3>
				<?php
					tie_options(
						array(	"name" => "Main 文章 Box 背景 ",
								"id" => "main_content_bg",
								"type" => "background"));

					tie_options(
						array(	"name" => "Boxes / Widgets 背景 ",
								"id" => "boxes_bg",
								"type" => "background"));

				?>		
			</div>
			<div class="tiepanel-item">
				<h3>Post 风格设置</h3>
				<?php
					tie_options(
						array(	"name" => "Post 链接颜色",
								"id" => "post_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Post 链接修饰",
								"id" => "post_links_decoration",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
				<?php
					tie_options(
						array(	"name" => "Post 鼠标经过的链接颜色",
								"id" => "post_links_color_hover",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Post 鼠标经过的链接修饰",
								"id" => "post_links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"默认" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
			</div>
			<div class="tiepanel-item">
				<h3>Footer 背景</h3>
				<?php
					tie_options(
						array(	"name" => "背景",
								"id" => "footer_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "Footer 小部件标题颜色",
								"id" => "footer_title_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "链接颜色",
								"id" => "footer_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "鼠标经过的链接颜色",
								"id" => "footer_links_color_hover",
								"type" => "color"));
				?>
			</div>				
						
			<div class="tiepanel-item">
				<h3>自定义CSS</h3>	
				<div class="option-item">
					<p><strong>全局CSS :</strong></p>
					<textarea id="tie_css" name="tie_options[css]" style="width:100%" rows="7"><?php echo tie_get_option('css');  ?></textarea>
				</div>	
				<div class="option-item">
					<p><strong>屏蔽 CSS :</strong> 宽度从768px 到 985px</p>
					<textarea id="tie_css" name="tie_options[css_tablets]" style="width:100%" rows="7"><?php echo tie_get_option('css_tablets');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>大屏手机 CSS :</strong>宽度从480px 到 767px</p>
					<textarea id="tie_css" name="tie_options[css_wide_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_wide_phones');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>手机 CSS :</strong> 宽度从320px 到 479px</p>
					<textarea id="tie_css" name="tie_options[css_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_phones');  ?></textarea>
				</div>	
			</div>	

		</div> <!-- 风格设置 -->

	
		
		<div id="tab14" class="tab_content tabs-wrap">
			<h2>字体</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>字符设定</h3>
				<p class="tie_message_hint"><strong>提示:</strong>如果你只选择您需要的语言,你会帮助防止缓慢在你的网页。</p>
				<?php
					tie_options(
						array(	"name" => "Latin Extended",
								"id" => "typography_latin_extended",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Cyrillic",
								"id" => "typography_cyrillic",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Cyrillic Extended",
								"id" => "typography_cyrillic_extended",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Greek",
								"id" => "typography_greek",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Greek Extended",
								"id" => "typography_greek_extended",
								"type" => "checkbox"));	
								
					tie_options(
						array(	"name" => "Khmer",
								"id" => "typography_khmer",
								"type" => "checkbox"));		
								
					tie_options(
						array(	"name" => "Vietnamese",
								"id" => "typography_vietnamese",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>字体预览</h3>
					<?php 	global $options_fonts;
					tie_options(
						array( 	"name" => "",
								"id" => "typography_test",
								"type" => "typography"));
						?>
	
				<div id="font-preview" class="option-item">Grumpy wizards make toxic brew for the evil Queen and Jack.</div>		

			</div>
			<div class="tiepanel-item">
				<h3>Main 字体</h3>
				<?php
					tie_options(
						array( 	"name" => "常规字体",
								"id" => "typography_general",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "网站头部标题",
								"id" => "typography_site_title",
								"type" => "typography"));	

					tie_options(
						array( 	"name" => "头部标语",
								"id" => "typography_tagline",
								"type" => "typography"));	
								
					tie_options(
						array( 	"name" => "顶部菜单",
								"id" => "typography_top_menu",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "主导航",
								"id" => "typography_main_nav",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "侧边栏文章标题",
								"id" => "typography_slider_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "页面标题",
								"id" => "typography_page_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "单独的文章标题",
								"id" => "typography_post_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "在首页文章标题框和文章标题在博客布局",
								"id" => "typography_post_title_boxes",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "S小文章在主页框",
								"id" => "typography_post_title2_boxes",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "文章信息",
								"id" => "typography_post_meta",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "文章条目",
								"id" => "typography_post_entry",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "消息框标题",
								"id" => "typography_boxes_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Widgets 标题",
								"id" => "typography_widgets_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Footer Widgets 标题",
								"id" => "typography_footer_widgets_title",
								"type" => "typography"));
				?>
			</div>			
		</div> <!-- 字体 -->
		
		
		<div id="tab10" class="tab_content tabs-wrap">
			<h2>高级设置</h2>	<?php echo $save ?>	

			<div class="tiepanel-item">
				<h3>禁用响应式</h3>
				<?php
					tie_options(
						array(	"name" => "禁用响应式",
								"id" => "disable_responsive",
								"type" => "checkbox"));
				?>
				<p class="tie_message_hint">此选项只适用于平板电脑和手机上. .禁用桌面上的响应行动. .编辑style.css文件和删除所有媒体Quries从文件的末尾。</p>
			</div>	
			
			<div class="tiepanel-item">
				<h3>禁用主题 [Gallery] Shortcode</h3>
				<?php
					tie_options(
						array(	"name" => "禁用 Theme [Gallery]",
								"id" => "disable_gallery_shortcode",
								"type" => "checkbox"));
				?>
				<p class="tie_message_hint">将其设置为<strong>ON</strong> 如果你想使用Jetpack平铺的画廊或如果你使用定制的lightbox插件【画廊】短码。</p>
			</div>	
			
			
			
			<div class="tiepanel-item">
				<h3>图像缩放</h3>
				
				<?php
					tie_options(
						array(	"name" => "TimThumb <small style='font-weight:bold;'>(不推荐)</small>",
								"id" => "timthumb",
								"type" => "checkbox"));
				?>
			</div>	
				
			<div class="tiepanel-item">
				<h3>主题更新</h3>
				<?php
					tie_options(
						array(	"name" => "通知主题更新.",
								"id" => "notify_theme",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Wordpress登录界面Logo</h3>
				<?php
					tie_options(
						array(	"name" => "Wordpress登录界面Logo",
								"id" => "dashboard_logo",
								"type" => "upload"));

					tie_options(
						array(	"name" => "Wordpress登录界面Logo图片地址",
								"id" => "dashboard_logo_url",
								"type" => "text"));
				?>
			
			</div>
			<?php
				global $array_options ;
				
				$current_options = array();
				foreach( $array_options as $option ){
					if( get_option( $option ) )
						$current_options[$option] =  get_option( $option ) ;
				}
			?>
			
			<div class="tiepanel-item">
				<h3>导出</h3>
				<div class="option-item">
					<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
				</div>
			</div>
			<div class="tiepanel-item">
				<h3>导入</h3>
				<div class="option-item">
					<textarea id="tie_import" name="tie_import" style="width:100%" rows="7"></textarea>
				</div>
			</div>


		</div> <!-- Advanced -->
		
		
		<div class="mo-footer">
			<?php echo $save; ?>
		</form>

			<form method="post">
				<div class="mpanel-reset">
					<input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
					<input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('All settings will be rest .. Are you sure ?')) return true ; else return false; " value="重置设置" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div>

	</div><!-- .mo-panel-content -->
	<div class="clear"></div>
</div><!-- .mo-panel -->
<?php 
}
?>
