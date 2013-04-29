<div class="register-basket">
	<div id="connection-register">
		{if !$logged}
			<a href="{$link->getPageLink('my-account', true)}" title="se connecter">Connexion</a> / <a href="{$link->getPageLink('authentification', true)}" title="s'inscrire">Inscription</a>
		{else}
			<a href="{$link->getPageLink('my-account', true)}" title="mon compte">Mon compte</a>
		{/if}
	</div>
	<div id="basket">
		<span class="illustration"></span>
		<p>Panier (
			<span class="price ajax_cart_total{if $cart_qties == 0}{/if}">
				{if $cart_qties > 0}
					{if $priceDisplay == 1}
						{assign var='blockuser_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
						{convertPrice price=$cart->getOrderTotal(false, $blockuser_cart_flag)}
					{else}
						{assign var='blockuser_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
						{convertPrice price=$cart->getOrderTotal(true, $blockuser_cart_flag)}
					{/if}
				{/if}
			</span>
		)</p>
	</div>
</div>
