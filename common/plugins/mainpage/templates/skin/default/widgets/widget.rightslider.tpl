 <section class="block">
{* <header class="block-header">
		<h3><a href="http://consolehockey.com/en/comments/" title="All comments">Leagues</a></h3>
	</header>*}
 <div class="slim-scroll" data-height="125">
 
            <ul class="nav nav-list custom">
{if $aLeagueBlogs} 
{foreach from=$aLeagueBlogs item=oLeague}
	{if $oLeague->getLogoSmall()}
		<li>
			<a href="#" class="dropdown-toggle">
				<img src="{cfg name='path.root.web'}/images/blog/{$oLeague->getUrl()}/{$oLeague->getLogoSmall()}" alt="" height="23"/>
				<span>{$oLeague->getTitle()}</span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li><a href="{$oLeague->getLeagueUrlFull()}"><i class="icon-double-angle-right"></i> Страница лиги</a></li>
				{foreach from=$oLeague->getTournaments() item=oTournament}
					<li>
						<a href="#" class="dropdown-toggle">
							{if $oTournament->getLogoSmall()}<img src="{cfg name='path.root.web'}/images/tournament/{$oTournament->getUrl()}/{$oTournament->getLogoSmall()}" alt="" height="23"/>{/if}
							<span>{$oTournament->getName()}</span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li><a href="{$oTournament->getUrlFull()}"><i class="icon-double-angle-right"></i> {$aLang.plugin.vs.blog}</a></li>
							<li><a href="{$oTournament->getUrlFull()}players/"><i class="icon-double-angle-right"></i> {$aLang.plugin.vs.players}</a></li>
							<li><a href="{$oTournament->getUrlFull()}stats/"><i class="icon-double-angle-right"></i> {$aLang.plugin.vs.standings}</a></li>
							<li><a href="{$oTournament->getUrlFull()}shedule/"><i class="icon-double-angle-right"></i> {$aLang.plugin.vs.schelude}</a></li>
							<li><a href="{$oTournament->getUrlFull()}events/"><i class="icon-double-angle-right"></i> {$aLang.plugin.vs.games}</a></li>
							<li><a href="{$oTournament->getUrlFull()}rules/"><i class="icon-double-angle-right"></i> {$aLang.plugin.vs.rules}</a></li>
						</ul>
					</li>
				{/foreach}
			</ul>
		</li>
			   
		{*<a href="{$oLeague->getUrlFull()}" title="{$oLeague->getTitle()}" >
		<img src="{cfg name='path.root.web'}/images/blog/{$oLeague->getUrl()}/{$oLeague->getLogoSmall()}" alt="" height="23"/>
		</a>*}
	{/if}
{/foreach}
{/if}
{*
               <li class="active open">
                  <a href="#" class="dropdown-toggle">
                  <i class="icon-desktop"></i>
                  <span>Elite</span>
                  <b class="arrow icon-angle-down"></b>
                  </a>
                  <ul class="submenu">
                     <li class="active"><a href="elements.html"><i class="icon-double-angle-right"></i> Standings</a></li>
                     <li><a href="buttons.html"><i class="icon-double-angle-right"></i> Playoff</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#" class="dropdown-toggle">
                  <i class="icon-edit"></i>
                  <span>1 Div</span>
                  <b class="arrow icon-angle-down"></b>
                  </a>
                  <ul class="submenu">
                     <li><a href="form-elements.html"><i class="icon-double-angle-right"></i> Form Elements</a></li>
                     <li><a href="form-wizard.html"><i class="icon-double-angle-right"></i> Wizard &amp; Validation</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#" class="dropdown-toggle">
                  <i class="icon-file"></i>
                  <span>Xbox</span>
                  <b class="arrow icon-angle-down"></b>
                  </a>
                  <ul class="submenu">
                     <li><a href="pricing.html"><i class="icon-double-angle-right"></i> Pricing Tables</a></li>
                     <li><a href="invoice.html"><i class="icon-double-angle-right"></i> Invoice</a></li>
                     <li><a href="login.html"><i class="icon-double-angle-right"></i> Login &amp; Register</a></li>
                     <li><a href="error-404.html"><i class="icon-double-angle-right"></i> Error 404</a></li>
                     <li><a href="error-500.html"><i class="icon-double-angle-right"></i> Error 500</a></li>
                     <li><a href="blank.html"><i class="icon-double-angle-right"></i> Blank Page</a></li>
                  </ul>
               </li>
			   *}
            </ul>

      </div>
</section>