<?php
/**
* Profile Manager
*
* Overrules group edit form to support options (radio, dropdown, multiselect)
*
* @package profile_manager
* @author ColdTrick IT Solutions
* @copyright Coldtrick IT Solutions 2009
* @link http://www.coldtrick.com/
*/

$group = elgg_extract('entity', $vars);

$name = elgg_extract('name', $vars);
$group_profile_fields = (array) elgg_extract('fields', profile_manager_get_categorized_group_fields());

echo elgg_view_field([
	'#type' => 'file',
	'#label' => elgg_echo('groups:icon'),
	'name' => 'icon',
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('groups:name'),
	'required' => true,
	'name' => 'name',
	'value' => $name,
]);

// show the configured group profile fields
foreach ($group_profile_fields as $field) {
	$shortname = $field->metadata_name;
	
	$options = [
		'#type' => $field->metadata_type,
		'#help' => $field->getHint(),
		'name' => $shortname,
		'value' => elgg_extract($shortname, $vars),
		'options' => $field->getOptions(),
		'placeholder' => $field->getPlaceholder(),
	];
	
	if ($valtype !== 'hidden') {
		$options['#label'] = $field->getDisplayName();
	}
	
	echo elgg_view_field($options);
}
