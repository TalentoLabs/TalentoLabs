(function() {	
	tinymce.create('tinymce.plugins.etshortcodestm', {
		init : function(ed, url){
			tinymce.plugins.etshortcodestm.theurl = url;
		},
		createControl : function(btn, e) {
			if ( btn == "et_shortcodes_button" ) {
				var a = this;	
				var btn = e.createSplitButton('et_button', {
	                title: "Insert Shortcode",
					image: tinymce.plugins.etshortcodestm.theurl +"/images/icon.png",
					icons: false,
	            });
	            btn.onRenderMenu.add(function (c, b) {
					
					b.add({title : 'Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
					
					
					// Columns
					c = b.addMenu({title:"Columns"});
					
						
						a.render( c, "1 Columns", "one" );
						a.render( c, "2 Columns", "two" );
						a.render( c, "3 Columns", "three" );
						a.render( c, "4 Columns", "four" );
						a.render( c, "12 Columns", "twelve" ) 
						 
					b.addSeparator();
					
					
					// Elements
					c = b.addMenu({title:"Elements"});
									
						a.render( c, "Button", "button" );
						a.render( c, "Service box", "servicebox" ); 
						a.render( c, "Team Person Box", "teamperson" );
						// a.render( c, "Pricing Table", "pricing" );
						// a.render( c, "Skill circle", "skillcircle" );
						a.render( c, "Brand fact", "brandfact" );	
						a.render( c, "Heading style", "headingstyle" );
						a.render( c, "Heading style 2", "headingstyle2" );
						a.render( c, "Big title", "bigtitle" );
						a.render( c, "Number list style", "nolist" );
						a.render( c, "Icons", "icons" );						

						c = c.addMenu({title:"Alert Boxs"}); 
						  a.render( c, "Warning notification", "error" ); 
						  a.render( c, "Error notification", "alert" ); 
						  a.render( c, "Success notification", "success" ); 
						  a.render( c, "Info notification", "info" ); 

					
					b.addSeparator();
					
					// Dividers
					c = b.addMenu({title:"Dividers"});
					
						a.render( c, "Solid", "solidDivider" );
						a.render( c, "Dashed", "dashedDivider" );
						a.render( c, "Dotted", "dottedDivider" );
						a.render( c, "Double", "doubleDivider" );
						a.render( c, "FadeIn", "fadeinDivider" );
						a.render( c, "FadeOut", "fadeoutDivider" );
						
					b.addSeparator();
					
					
					// jQuery
					c = b.addMenu({title:"jQuery"});
					
						a.render( c, "Collapse", "collapse" );
						a.render( c, "Tabs", "tabs" ); 
					
					b.addSeparator();
					
					
					// Helpers
					c = b.addMenu({title:"Other"});
					
						a.render( c, "Spacing", "spacing" );
						

				});
	            
	          return btn;
			}
			return null;               
		},
		render : function(ed, title, id) {
			ed.add({
				title: title,
				onclick: function () {
					
					// Selected content
					var mceSelected = tinyMCE.activeEditor.selection.getContent();
					
					// Add highlighted content inside the shortcode when possible - yay!
					if ( mceSelected ) {
						var sympleDummyContent = mceSelected;
					} else {
						var sympleDummyContent = 'Sample Content';
					}
					
					
					// Button
					if(id == "button") {
						tinyMCE.activeEditor.selection.setContent('[et_button btn_color="#b92429" font_size="15" text_color="#fff" url="http://www.google.com" ]Button[/et_button]');
					}
					
					// Serivce Box
					if(id == "servicebox") {
						tinyMCE.activeEditor.selection.setContent('[et_service_box title="Your title" icon="rocket" icon_color="#ffd600"] Your text here[/et_service_box]');
					}
					

					// Team person box
					if(id == "teamperson") {
						tinyMCE.activeEditor.selection.setContent('[et_team_person img="Image url" url="url for more info" name="" jobtitle="Job Title" ] Your text here[/et_team_person]');
					}

					// skill circle
					if(id == "skillcircle") {
						tinyMCE.activeEditor.selection.setContent('[et_skill_circle persent="60" title="JavaScript Development" ] Your text here[/et_skill_circle]');
					}

					// brand fact
					if(id == "brandfact") {
						tinyMCE.activeEditor.selection.setContent('[et_brand_fact score="690" color="#ffd600"]Awards Have Won[/et_brand_fact]');
					}

					// heading style 
					if(id == "headingstyle") {
						tinyMCE.activeEditor.selection.setContent('[et_heading_style fontsize="55" color="#333" link="" heading="Your heading here" ]heading dec here[/et_heading_style]');
					}
					// heading style 2
					if(id == "headingstyle2") {
						tinyMCE.activeEditor.selection.setContent('[et_heading_style2 type="h3" align="left" color="#333" bg_color="#fff"]heading dec here[/et_heading_style2]');
					}

					// Icons
					if(id == "icons") {
						tb_show('Custom Grid', '../wp-content/themes/superior/library/shortcodes/inc/icons.html?TB_iframe=1');
					}

					// Alert boxs
					if(id == "error") {
						tinyMCE.activeEditor.selection.setContent(' [et_notification type="warning"]Warning! Best check yo self, youre not looking too good. [/et_notification]');
					}
					if(id == "alert") {
						tinyMCE.activeEditor.selection.setContent(' [et_notification type="danger"]Alert! Best check yo self, youre not looking too good. [/et_notification]');
					}
					if(id == "success") {
						tinyMCE.activeEditor.selection.setContent(' [et_notification type="success"]Success! Best check yo self, youre not looking too good. [/et_notification]');
					}
					if(id == "info") {
						tinyMCE.activeEditor.selection.setContent(' [et_notification type="info"]Info! Best check yo self, youre not looking too good. [/et_notification]');
					}

					// Columns
					if(id == "one") {
						tinyMCE.activeEditor.selection.setContent('[row class="row"]<br class="nc"/>[col class="col-sm-12"]Text[/col]<br class="nc"/>[/row]');
					}
					if(id == "two") {
						tinyMCE.activeEditor.selection.setContent('[row class="row"]<br class="nc"/>[col class="col-sm-6"]Text[/col]<br class="nc"/>[col class="col-sm-6"]Text[/col]<br class="nc"/>[/row]');
					}
					if(id == "three") {
						tinyMCE.activeEditor.selection.setContent('[row class="row"]<br class="nc"/>[col class="col-sm-3"]Text[/col]<br class="nc"/>[col class="col-sm-3"]Text[/col]<br class="nc"/>[col class="col-sm-3"]Text[/col]<br class="nc"/>[col class="col-sm-3"]Text[/col]<br class="nc"/>[/row]');
					}
					if(id == "four") {
						tinyMCE.activeEditor.selection.setContent('[row class="row"]<br class="nc"/>[col class="col-sm-4"]Text[/col]<br class="nc"/>[col class="col-sm-4"]Text[/col]<br class="nc"/>[col class="col-sm-4"]Text[/col]<br class="nc"/>[/row]');
					}
					if(id == "twelve") {
						tinyMCE.activeEditor.selection.setContent('[row class="row"]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[col class="col-sm-1"]Text[/col]<br class="nc"/>[/row]');
					}
					 

					// Divider
					if(id == "solidDivider") {
						tinyMCE.activeEditor.selection.setContent('[et_divider style="solid" margin_top="20px" margin_bottom="20px"]');
					}
					if(id == "dashedDivider") {
						tinyMCE.activeEditor.selection.setContent('[et_divider style="dashed" margin_top="20px" margin_bottom="20px"]');
					}
					if(id == "dottedDivider") {
						tinyMCE.activeEditor.selection.setContent('[et_divider style="dotted" margin_top="20px" margin_bottom="20px"]');
					}
					if(id == "doubleDivider") {
						tinyMCE.activeEditor.selection.setContent('[et_divider style="double" margin_top="20px" margin_bottom="20px"]');
					}
					if(id == "fadeinDivider") {
						tinyMCE.activeEditor.selection.setContent('[et_divider style="fadein" margin_top="20px" margin_bottom="20px"]');
					}
					if(id == "fadeoutDivider") {
						tinyMCE.activeEditor.selection.setContent('[et_divider style="fadeout" margin_top="20px" margin_bottom="20px"]');
					}
					 
					// Google Map
					if(id == "googlemap") {
						tinyMCE.activeEditor.selection.setContent('[symple_googlemap title="Envato Office" location="2 Elizabeth St, Melbourne Victoria 3000 Australia" zoom="10" height=250]');
					}
					 
					// bigtitle
					if(id == "bigtitle") {
						tinyMCE.activeEditor.selection.setContent('[et_big_title fontsize="55" align="left" textcolor="#000" make_underline="yes" title="Your title goes here" ]');
					}			

					//Spacing
					if(id == "spacing") {
						tinyMCE.activeEditor.selection.setContent('[et_spacing size="40px"]');
					}
					 
					//nolist
					if(id == "nolist") {
						tinyMCE.activeEditor.selection.setContent('[no_list_holder]<br class="nc"/>[no_list number="1"]Your text here[/no_list] <br class="nc"/>[no_list number="2"]Your text here[/no_list]  <br class="nc"/>[/no_list_holder]');
					}

					//Tabs
					if(id == "tabs") {
						tb_show('Custom Grid', '../wp-content/themes/superior/library/shortcodes/inc/tabs.html?TB_iframe=1');
					}

					//Collapse
					if(id == "collapse") {
						tinyMCE.activeEditor.selection.setContent('[collapse id="accordion"] <br class="nc" />[citem citem_open="in" title="Collapsible Group Item 1" id="citem_1" parent="accordion"]<br class="nc" />Collapse content goes here....<br class="nc" />[/citem] <br class="nc" />[citem citem_open="" title="Collapsible Group Item 2" id="citem_2" parent="accordion"]<br class="nc" />Collapse content goes here....<br class="nc" />[/citem] <br class="nc" />[/collapse]');
					}
					
					
					return false;
				}
			})
		}
	
	});
	tinymce.PluginManager.add("et_shortcodes", tinymce.plugins.etshortcodestm);
})();