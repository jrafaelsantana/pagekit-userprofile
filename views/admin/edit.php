<?php
$view->script('field-edit', 'bixie/userprofile:app/bundle/field-edit.js', ['bixie-fieldtypes', 'uikit-nestable'],
    ['version' => $app->module('bixie/pk-framework')->getVersionKey($app->package('bixie/userprofile')->get('version'))]); ?>

<form id="field-edit" class="uk-form" v-validator="form" @submit.prevent="save | valid" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div data-uk-margin>

			<h2 class="uk-margin-remove" v-if="field.id">{{ 'Edit %type%' | trans {type:type.label} }} <em>{{
					field.label | trans }}</em></h2>
			<h2 class="uk-margin-remove" v-else>{{ 'Add %type%' | trans {type:type.label} }}</h2>

		</div>
		<div data-uk-margin>

			<a class="uk-button uk-margin-small-right" :href="$url.route('admin/userprofile')">
				{{ field.id ? 'Close' : 'Cancel' | trans }}</a>
			<button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>

		</div>
	</div>

	<ul class="uk-tab" v-el:tab>
		<li><a>{{ type.label | trans }}</a></li>
		<li v-if="type.hasOptions"><a>{{ 'Options' | trans }}</a></li>
		<li><a>{{ 'Appearance' | trans }}</a></li>
	</ul>

	<div class="uk-switcher uk-margin" v-el:content>
		<div>
			<field-basic :field.sync="field" :type="type" :form="form" :roles="roles"></field-basic>
		</div>
		<div v-if="type.hasOptions">
			<field-options v-show="type.hasOptions" :field.sync="field" :form="form"></field-options>
		</div>
		<div>
			<field-appearance :field.sync="field" :form="form"></field-appearance>
		</div>
	</div>

</form>
