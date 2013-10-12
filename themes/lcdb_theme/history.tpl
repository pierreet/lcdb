


{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My account'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Orders'}{/capture}

<div id="columns" class="content clearfix">
	<div id="left_column">
		{include file="./account-left-col.tpl"}
	</div><!-- / #left_column -->
	<div id="center_column">
		<div class="big-bloc">
			<h1>{l s='Orders'}</h1>
			{include file="$tpl_dir./errors.tpl"}
			
			{if $slowValidation}
				<p id="empty-command"><span class="img-warning"></span>l s='If you have just placed an order, it may take a few minutes for it to be validated. Please refresh this page if your order is missing.'}</p>
			{/if}
			
			{if $orders && count($orders) && "test" == "test"}
				<hr />

				{foreach from=$orders item=order}
					{if (isset($order.id_order_state) && ($order.id_order_state == 5)) && !isset($last_delivered_order) }
						{$last_delivered_order = $order}
					{/if}
					{if (!isset($order.id_order_state) || ($order.id_order_state != 5)) && !isset($last_order_done) }
						{$last_order_done = $order}
					{/if}
				{/foreach}

				<div class="clearfix" id="mes-commandes">
					{if isset($last_delivered_order)}
						<div class="left-side">
							<h3>Dernières commande</h3>
							<hr />
							<p>Numéro de commande : <span class="bold">{$last_delivered_order.reference}</span></p>
							<p>Commande réalisée le : <span class="bold">{dateFormat date=$last_delivered_order.date_add full=0}</span></p>
							<p>Montant total : <span class="bold">{displayPrice price=$last_delivered_order.total_paid currency=$last_delivered_order.id_currency no_utf8=false convert=false}</span></p>
							<p>Mode de règlement : <span class="bold">{$last_delivered_order.payment|escape:'htmlall':'UTF-8'}</span></p>
							<p>État du paiement : <span class="bold">
								{if isset($last_delivered_order.order_state)}
									{$last_delivered_order.order_state|escape:'htmlall':'UTF-8'}
								{else}
									{l s='En cours de traitement'}
								{/if}
							</span></p>
							<div class="clearfix commande-adresse">
								<p>Adresse de livraison :</p>
								<ul>
									<li>Jean-Baptiste Poquelin</li>
									<li>3 rue du chène</li>
									<li>Bat. A, appt 34, code : 7899</li>
									<li>69000 Lyon</li>
									<li>0148354756</li>
								</ul>
							</div>
							<hr />
							<a href="javascript:showOrder(1, {$last_delivered_order.id_order|intval}, '{$link->getPageLink('order-detail', true)}');" title="Voir le détail">
								&rarr;&nbsp;<span>Voir le détail</span>
							</a>
							<a href="#" title="Télécharger la facture">&rarr;&nbsp;<span>Télécharger la facture</span></a>
						</div>
					{/if}
					{if isset($last_order_done)}
						<div class="right-side">
							<h3>Prochaine commande</h3>
							<hr />
							<p>Numéro de commande : <span class="bold">{$last_order_done.reference}</span></p>
							<p>Commande réalisée le : <span class="bold">{dateFormat date=$last_order_done.date_add full=0}</span></p>
							<p>Montant total : <span class="bold">{displayPrice price=$last_order_done.total_paid currency=$last_order_done.id_currency no_utf8=false convert=false}</span></p>
							<p>Mode de règlement : <span class="bold">{$last_order_done.payment|escape:'htmlall':'UTF-8'}</span></p>
							<p>État du paiement : <span class="bold">
								{if isset($last_order_done.order_state)}
									{$last_order_done.order_state|escape:'htmlall':'UTF-8'}
								{else}
									{l s='En cours de traitement'}
								{/if}
							</span></p>
							<div class="clearfix commande-adresse">
								<p>Adresse de livraison :</p>
								<ul>
									<li>Jean-Baptiste Poquelin</li>
									<li>3 rue du chène</li>
									<li>Bat. A, appt 34, code : 7899</li>
									<li>69000 Lyon</li>
									<li>0148354756</li>
								</ul>
							</div>
							<hr />
							<a href="javascript:showOrder(1, {$last_order_done.id_order|intval}, '{$link->getPageLink('order-detail', true)}');" title="Voir le détail">
								&rarr;&nbsp;<span>Voir le détail</span>
							</a>
							<a href="#" title="Télécharger la facture">&rarr;&nbsp;<span>Télécharger la facture</span></a>
						</div>
					{/if}

				</div>
				<hr />
				<div id="block-order-detail" class="hidden"></div>
			{else}
				<p id="empty-command"><span class="img-warning"></span>{l s='You have not placed any orders.'}</p>
			{/if}
			
		</div>
	</div><!-- / #center_column -->
</div><!-- / .content -->
