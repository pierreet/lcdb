
<div id="columns" class="content clearfix">
	<div id="left_column">
		{include file="./account-left-col.tpl"}
	</div><!-- / #left_column -->
	<div id="center_column">
		<div class="big-bloc">
			<h1>{l s='Page not available'}</h1>
			<p>
				{l s='We\'re sorry, but the Web address you entered is no longer available'}
			</p>

			<h3>{l s='To find a product, please type its name in the field below'}</h3>
			<form action="{$link->getPageLink('search')}" method="post" class="std">
				<fieldset>
					<p>
						<label for="search">{l s='Search our product catalog:'}</label>
						<input id="search_query" name="search_query" type="text" />
						<input type="submit" name="Submit" value="OK" class="button_small" />
					</p>
				</fieldset>
			</form>

			<p><a href="{$base_dir}" title="{l s='Home'}"><img src="{$img_dir}icon/home.gif" alt="{l s='Home'}" class="icon" /> {l s='Home'}</a></p>
		</div>
	</div><!-- / #center_column -->
</div><!-- / .content -->