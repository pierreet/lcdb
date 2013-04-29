
<div class="big-bloc">
	<a href="#" title="Retourner aux produits">&lt; Retourner aux produits</a>
	
	{if isset($adminActionDisplay) && $adminActionDisplay}
	<div id="admin-action">
		<p>{l s='This product is not visible to your customers.'}
		<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
		<input type="submit" value="{l s='Publish'}" class="exclusive" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad|escape:'htmlall':'UTF-8'}', 0, '{$smarty.get.adtoken|escape:'htmlall':'UTF-8'}')"/>
		<input type="submit" value="{l s='Back'}" class="exclusive" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad|escape:'htmlall':'UTF-8'}', 1, '{$smarty.get.adtoken|escape:'htmlall':'UTF-8'}')"/>
		</p>
		<p id="admin-action-result"></p>
		</p>
	</div>
	{/if}

	{if isset($confirmation) && $confirmation}
	<p class="confirmation">
		{$confirmation}
	</p>
	{/if}
	
	<div id="item" itemscope itemtype="http://schema.org/Product">
		<div class="clearfix">
			<div id="product-image">
				<img src="{$base_dir}themes/lcdb_theme/img/img_solo/product_boeuf.png" alt="Pavé (Rumsteak ou tende de tranche)" />
			</div>
			<div id="main-product-infos">
				<h1 itemprop="name">{$product->name|escape:'htmlall':'UTF-8'}</h1>
				{if isset($product->description_short)}
					<div itemprop="description">{$product->description_short}</div>
				{/if}
				{if isset($product->description)}
					<div class="full-description">{$product->description}</div>
				{/if}
			</div>
		</div>
		<div class="clearfix price-info">
			<div class="choix-race">
				<p>Race</p>
				<select class="meat-race">
					<option>Choisissez pour moi</option>
					<option>race 1</option>
					<option>race 2</option>
				</select>
			</div>
			<div class="add-to-basket-form">
				<div class="clearfix">
					<div class="label">
					</div>
					<div class="detailed-price">
						<p class="price" itemprop="price">8 €</p>
						<p class="price-kg">25,62€/kg</p>
					</div>
				</div>
				<div>
					<form class="form-panier clearfix" action="{$link->getPageLink('cart')}" method="post">
						<button type="button" name="minus" class="moreless minus">-</button>
						<input class="quantity" type="text" maxlength="2" value="0" name="quantity" disabled>
						<button type="button" name="plus" class="moreless plus">+</button>
						<button type="submit" name="submit" class="ajout-panier">ajouter au panier</button>

						<!-- hidden datas -->
						<p class="hidden">
							<input type="hidden" name="token" value="{$static_token}" />
							<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
							<input type="hidden" name="add" value="1" />
							<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
						</p>

						<!-- quantity wanted -->
						<p id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity <= 0) OR $virtual OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
							<label>{l s='Quantity:'}</label>
							<input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" size="2" maxlength="3" {if $product->minimal_quantity > 1}onkeyup="checkMinimalQuantity({$product->minimal_quantity});"{/if} />
						</p>

						<!-- availability -->
						<p id="availability_statut"{if ($product->quantity <= 0 && !$product->available_later && $allow_oosp) OR ($product->quantity > 0 && !$product->available_now) OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if}>
							<span id="availability_label">{l s='Availability:'}</span>
							<span id="availability_value"{if $product->quantity <= 0} class="warning_inline"{/if}>
							{if $product->quantity <= 0}{if $allow_oosp}{$product->available_later}{else}{l s='This product is no longer in stock'}{/if}{else}{$product->available_now}{/if}
							</span>
						</p>

						<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties OR $product->quantity <= 0) OR $allow_oosp OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none"{/if} >{l s='Warning: Last items in stock!'}</p>

						{if $product->show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}

							{if !$priceDisplay || $priceDisplay == 2}
								{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL, $priceDisplayPrecision)}
								{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}
							{elseif $priceDisplay == 1}
								{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL, $priceDisplayPrecision)}
								{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}
							{/if}

							<p class="our_price_display">
							{if $priceDisplay >= 0 && $priceDisplay <= 2}
								<span id="our_price_display">{convertPrice price=$productPrice}</span>
								<!--{if $tax_enabled  && ((isset($display_tax_label) && $display_tax_label == 1) OR !isset($display_tax_label))}
									{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
								{/if}-->
							{/if}
							</p>

							{if $priceDisplay == 2}
								<br />
								<span id="pretaxe_price"><span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span>&nbsp;{l s='tax excl.'}</span>
							{/if}

						<p id="reduction_percent" {if !$product->specificPrice OR $product->specificPrice.reduction_type != 'percentage'} style="display:none;"{/if}><span id="reduction_percent_display">{if $product->specificPrice AND $product->specificPrice.reduction_type == 'percentage'}-{$product->specificPrice.reduction*100}%{/if}</span></p>

						<p id="reduction_amount" {if !$product->specificPrice OR $product->specificPrice.reduction_type != 'amount' && $product->specificPrice.reduction|intval ==0} style="display:none"{/if}><span id="reduction_amount_display">{if $product->specificPrice AND $product->specificPrice.reduction_type == 'amount' && $product->specificPrice.reduction|intval !=0}-{convertPrice price=$product->specificPrice.reduction|floatval}{/if}</span></p>

						{if $product->specificPrice AND $product->specificPrice.reduction}
							<p id="old_price"><span class="bold">
							{if $priceDisplay >= 0 && $priceDisplay <= 2}
								{if $productPriceWithoutReduction > $productPrice}
									<span id="old_price_display">{convertPrice price=$productPriceWithoutReduction}</span>
									<!-- {if $tax_enabled && $display_tax_label == 1}
										{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
									{/if} -->
								{/if}
							{/if}
							</span>
							</p>
						{/if}

						{if $packItems|@count && $productPrice < $product->getNoPackPrice()}
							<p class="pack_price">{l s='instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
							<br class="clear" />
						{/if}

						{if $product->ecotax != 0}
							<p class="price-ecotax">{l s='include'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='for green tax'}
								{if $product->specificPrice AND $product->specificPrice.reduction}
								<br />{l s='(not impacted by the discount)'}
								{/if}
							</p>
						{/if}

						{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
							 {math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
							<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'htmlall':'UTF-8'}</p>
						{/if}

						{/if}

						{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}

						{if isset($HOOK_PRODUCT_FOOTER) && $HOOK_PRODUCT_FOOTER}{$HOOK_PRODUCT_FOOTER}{/if}

					</form>
					
					
					
					
					
					
					
				</div>
			</div><!-- / .add-to-basket-form -->
		</div>
		
		<hr />
		<div class="misc-infos">
			<p class="portions"><span class="img-portions"></span> 2 <span class="colis-portions">portions</span></p>
			<p class="jours"><span class="img-jours"></span> 10 <span class="colis-jours">jours</span></p>
			<p class="cuisson"><span class="img-cuisson"></span> <span class="mode-cuisson">à griller</span></p>
		</div>
		
		{if isset($product->tricks)}
			<hr />
			<div id="trucs-et-astuces">
				<h2><span class="img-trucs-astuces"></span>Trucs et astuces des Colis du Boucher</h2>
				<div>{$product->tricks}</div>
			</div>
		{/if}
		
		{if isset($product->breeder)}
			<hr />
			<div id="mot-eleveur">
				<h2><span class="img-mot-eleveur"></span>Le mot de l'éleveur</h2>
				<div>{$product->breeder}</div>
			</div>
		{/if}
		
		{if isset($product->description_short)}
			<hr />
			<div id="idees-recettes">
				<h2><span class="img-idees-recettes"></span>Idées recettes</h2>
				<ul>
					<li itemscope itemtype="http://schema.org/Recipe">
						<a href="#" title="voir la recette" class="recepe-link">voir la recette</a>
						<h3 itemprop="name">Queue de Boeuf aux olives et jambon de pays</h3>
						<p class="clearfix"><span class="intitule">difficulté</span> <span class="difficulte_level difficulte_3">3/5</span></p>
						<div class="recepe-details hidden">
							<h4>Ingrédients :</h4>
							<ul class="ingredients clearfix">
								<li itemprop="ingredients">2 kg de queue de boeuf en tronçons</li>
								<li itemprop="ingredients">3 oignons</li>
								<li itemprop="ingredients">2 gousses d’ail</li>
								<li itemprop="ingredients">4 tomates</li>
								<li itemprop="ingredients">100 g de jambon de pays</li>
								<li itemprop="ingredients">50 cl de bouillon de pot-au-feu</li>
								<li itemprop="ingredients">2 cuillières à soupe d’huile d’olive</li>
								<li itemprop="ingredients">125 g d’olives noires</li>
								<li itemprop="ingredients">1 feuille de laurier</li>
								<li itemprop="ingredients">1 branche de thym</li>
								<li itemprop="ingredients">Sel, poivre</li>
							</ul>
							<h4>Recette :</h4>
							<ul class="recette">
								<li itemprop="recipeInstructions">Plongez les tomates dans une casserole d’eau bouillante pendant 1min puis épluchez-les et concassez-les grossièrement. Hachez l’ail finement après l’avoir dégermé. découpez le jambon en fines lanières puis pelez et émincez les oignons.</li>
								<li itemprop="recipeInstructions">Dans une cocotte, faites revenir les morceaux de viande et les oignions dans l’huile bien chaude. Ajoutez l’ail, les lamelles de kambon, les tomates, le laurier et le thym. Ajoutez le bouillon. Goûtez l’assaisonement si besoin.</li>
							</ul>
						</div>
						<hr class="dashed" />
					</li>
					<li itemscope itemtype="http://schema.org/Recipe">
						<a href="#" title="voir la recette" class="recepe-link">voir la recette</a>
						<h3 itemprop="name">Queue de Boeuf aux olives et jambon de pays</h3>
						<p class="clearfix"><span class="intitule">difficulté</span> <span class="difficulte_level difficulte_0">0/5</span></p>
						<div class="recepe-details hidden">
							<h4>Ingrédients :</h4>
							<ul class="ingredients clearfix">
								<li itemprop="ingredients">2 kg de queue de boeuf en tronçons</li>
								<li itemprop="ingredients">3 oignons</li>
								<li itemprop="ingredients">2 gousses d’ail</li>
								<li itemprop="ingredients">4 tomates</li>
								<li itemprop="ingredients">100 g de jambon de pays</li>
								<li itemprop="ingredients">50 cl de bouillon de pot-au-feu</li>
								<li itemprop="ingredients">2 cuillières à soupe d’huile d’olive</li>
								<li itemprop="ingredients">125 g d’olives noires</li>
								<li itemprop="ingredients">1 feuille de laurier</li>
								<li itemprop="ingredients">1 branche de thym</li>
								<li itemprop="ingredients">Sel, poivre</li>
							</ul>
							<h4>Recette :</h4>
							<ul class="recette">
								<li itemprop="recipeInstructions">Plongez les tomates dans une casserole d’eau bouillante pendant 1min puis épluchez-les et concassez-les grossièrement. Hachez l’ail finement après l’avoir dégermé. découpez le jambon en fines lanières puis pelez et émincez les oignons.</li>
								<li itemprop="recipeInstructions">Dans une cocotte, faites revenir les morceaux de viande et les oignions dans l’huile bien chaude. Ajoutez l’ail, les lamelles de kambon, les tomates, le laurier et le thym. Ajoutez le bouillon. Goûtez l’assaisonement si besoin.</li>
							</ul>
						</div>
						<hr class="dashed" />
					</li>
					<li itemscope itemtype="http://schema.org/Recipe">
						<a href="#" title="voir la recette" class="recepe-link">voir la recette</a>
						<h3 itemprop="name">Queue de Boeuf aux olives et jambon de pays</h3>
						<p class="clearfix"><span class="intitule">difficulté</span> <span class="difficulte_level difficulte_5">5/5</span></p>
						<div class="recepe-details hidden">
							<h4>Ingrédients :</h4>
							<ul class="ingredients clearfix">
								<li itemprop="ingredients">2 kg de queue de boeuf en tronçons</li>
								<li itemprop="ingredients">3 oignons</li>
								<li itemprop="ingredients">2 gousses d’ail</li>
								<li itemprop="ingredients">4 tomates</li>
								<li itemprop="ingredients">100 g de jambon de pays</li>
								<li itemprop="ingredients">50 cl de bouillon de pot-au-feu</li>
								<li itemprop="ingredients">2 cuillières à soupe d’huile d’olive</li>
								<li itemprop="ingredients">125 g d’olives noires</li>
								<li itemprop="ingredients">1 feuille de laurier</li>
								<li itemprop="ingredients">1 branche de thym</li>
								<li itemprop="ingredients">Sel, poivre</li>
							</ul>
							<h4>Recette :</h4>
							<ul class="recette">
								<li itemprop="recipeInstructions">Plongez les tomates dans une casserole d’eau bouillante pendant 1min puis épluchez-les et concassez-les grossièrement. Hachez l’ail finement après l’avoir dégermé. découpez le jambon en fines lanières puis pelez et émincez les oignons.</li>
								<li itemprop="recipeInstructions">Dans une cocotte, faites revenir les morceaux de viande et les oignions dans l’huile bien chaude. Ajoutez l’ail, les lamelles de kambon, les tomates, le laurier et le thym. Ajoutez le bouillon. Goûtez l’assaisonement si besoin.</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		{/if}
		
	</div>
</div>

