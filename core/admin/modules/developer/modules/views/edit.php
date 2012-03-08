<?	
	$view = $admin->getModuleView(end($path));
	$action = $admin->getModuleActionForView(end($path));
	$module = $admin->getModule($action["module"]);

	$breadcrumb[] = array("title" => $module["name"], "link" => "developer/modules/edit/".$module["id"]."/");
	$breadcrumb[] = array("title" => "Edit View", "link" => "#");
?>
<h1><span class="icon_developer_modules"></span>Edit View</h1>
<? include bigtree_path("admin/modules/developer/modules/_nav.php") ?>

<div class="form_container">
	
	<form method="post" action="<?=$developer_root?>modules/views/update/<?=end($path)?>/" class="module">
		<section>
			<? if ($action["route"]) { ?>
			<div class="alert">
				<img src="<?=$admin_root?>images/alert.png" alt="" />
				<p><strong>This is not the default view:</strong>  You may specify an action suffix below.</p>
			</div>
			<fieldset>
				<label>Add/Edit Suffix</label>
				<input type="text" name="suffix" value="<?=$view["suffix"]?>" />
			</fieldset>
			<? } ?>
			
			<fieldset>
				<label>Preview URL <small>(optional, i.e. http://www.website.com/news/preview/ &mdash; the item's id will be entered as the final route)</small></label>
				<input type="text" name="preview_url" value="<?=htmlspecialchars($view["preview_url"])?>" />
			</fieldset>
			
			<div class="left">
				<fieldset>
					<label class="required">Item Title <small>(for example, "Questions" to make the title "Viewing Questions")</small></label>
					<input type="text" name="title" value="<?=$view["title"]?>" class="required" />
				</fieldset>
				<fieldset>
					<label class="required">Data Table</label>
					<select name="table" id="view_table" class="required" >
						<? bigtree_table_select($view["table"]); ?>
					</select>
				</fieldset>
				<fieldset>
					<label>View Type</label>
					<select name="type" id="view_type" class="left" >
						<? foreach ($admin->ViewTypes as $key => $type) { ?>
						<option value="<?=$key?>"<? if ($key == $view["type"]) { ?> selected="selected"<? } ?>><?=htmlspecialchars($type)?></option>
						<? } ?>
					</select>
					&nbsp; <a href="#" class="options icon_settings"></a>
					<input type="hidden" name="options" id="view_options" value="<?=htmlspecialchars(json_encode($view["options"]))?>" />
				</fieldset>
			</div>
			
			<div class="right">
				<fieldset>
					<label>Page Description <small>(instructions for the user)</small></label>
					<textarea name="description" ><?=$view["description"]?></textarea>
				</fieldset>
				
				<fieldset>
					<input type="checkbox" name="uncached" <? if ($view["uncached"]) { ?>checked="checked" <? } ?>/>
					<label class="for_checkbox">Don't Cache View Data <small>(removes parsers, pending changes)</small></label>
				</fieldset>
			</div>
			
			
		</section>
		<section class="sub" id="field_area">
			<?
				$table = $view["table"];
				$fields = $view["fields"];
				$actions = $view["actions"];
				include bigtree_path("admin/ajax/developer/load-view-fields.php");
			?>
		</section>
		<footer>
			<input type="submit" class="button blue" value="Update" />
		</footer>
	</form>
</div>

<? include bigtree_path("admin/modules/developer/modules/views/_js.php") ?>