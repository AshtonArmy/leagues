<div class="block block-tour-page">
	<div class="block-content">	
		<div class="block-tour-page-content">
            <div class="logo" >
				{if $oTournament->getLogoFull()}
				<img src="{cfg name='path.root.web'}/images/tournament/{$oTournament->getUrl()}/{$oTournament->getLogoFull()}" alt="" />
                {else}
				<img src="http://virtualsports.ru/templates/skin/virtsports/images/module/top_block/logo.jpg">
				{/if}
            </div>
            <h2>{$oTournament->getName()}</h2>						
			<p><b>Date start: </b>{$oTournament->getDatestart()|date_format:"%e %B %Y"}</p>
		{if $oTournament->getDatezayavki()!='0000-00-00' and $oTournament->getDatezayavki()|date_format:"%Y%m%d" >= $smarty.now|date_format:"%Y%m%d"}<p><b>Registration end: </b>{$oTournament->getDatezayavki()|date_format:"%e %B %Y"}</p>{/if}
			{if $aTournamentAdmins}
			<p><b>Admins: </b>
			{foreach from=$aTournamentAdmins item=oTournamentAdmins name=el2}
				{assign var=oAdmins value=$oTournamentAdmins->getUser()}
				<a class="authors" target="_blank" href="{$oAdmins->getUserWebPath()}"> {$oAdmins->getLogin()}</a>
			{/foreach}
			</p>
			{/if}
			{if $aTournamentAssists}
			<p><b>Ассистенты: </b>
			{foreach from=$aTournamentAssists item=oTournamentAssists name=el2}
				{assign var=oAdmins value=$oTournamentAssists->getUser()}
				<a class="authors" target="_blank" href="{$oAdmins->getUserWebPath()}"> {$oAdmins->getLogin()}</a>
			{/foreach}
			</p>
			{/if}
			{if $myteam}
			{if $oTournament->getLeagueName()!=''}
			<p>
				<b>Title</b>: {$oTournament->getLeagueName()}
			</p>
			{/if}
			{if $oTournament->getLeaguePass()!=''}
			<p>
				<b>Пароль</b>: {$oTournament->getLeaguePass()}
			</p>	
			{/if}
			{/if}	
			{if isset($matches_total)}
			<p>
				<b>Played</b>: {$matches_played} / {$matches_total} matches
			</p>
			{/if}
			{if $oTournament->getFond() != 0}
			<p>
				<b>Призовой фонд</b>: {$oTournament->getFond()|string_format:"%.2f"}
			</p>
			{/if}
			{if $oTournament->getWaitlistTopicId() != 0}
			{assign var=oTopic value=$oTournament->getWaitlist()}
			<p>
				<b>Лист ожидания</b>: <a target="_blank" href="{$oTopic->getUrl()}">ссылка</a>
			</p>			
			{/if}
			{if $oTournament->getProlongTopicId() != 0}
			{assign var=oTopic value=$oTournament->getProlong()}
			<p>
				<b>Продление матчей</b>: <a target="_blank" href="{$oTopic->getUrl()}">ссылка</a>
			</p>			
			{/if}

		</div>
	</div>
</div>

<div class="modal modal-login jqmWindow" id="teamplay_form">
    <a href="#" class="close jqmClose"></a>
</div>

<div class="modal modal-login jqmWindow" id="otchetmatch_form">
    <a href="#" class="close jqmClose"></a>
    <div id="divmatchotchet" class="modal-content"></div>
</div>
 
<div class="modal modal-login jqmID4" id="video_form">
	<header class="modal-header">
		<h3>Add video</h3>
		<a href="#" class="close jqmClose"></a>
	</header>
	<div class="modal-content">	
		<form action="javascript:video_save();" >
			<p>
				<input id="video_url" type="text" SIZE="70" maxlength="100"/>
			</p>
			<p>
				<input type="submit" class="button" value="Add video" />
			</p>
		</form>
	</div>
</div>

<div class="modal modal-login jqmWindow" id="prolongmatch_form">
    <a href="#" class="close jqmClose"></a>
    <h3>Продлить матч</h3>
    <form action="javascript:prolong_save();" >
        <select id="srok" class="w70">
            <option value="-3">-3</option>
            <option value="-2">-2</option>
            <option value="-1">-1</option>
            <option value="1" selected="selected">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <p>
            <textarea id="prichina" class="comment_textarea" cols="1" rows="1"></textarea>
        </p>
        <input type="submit" class="button" value="Внести" /><br />

        <div id="divmatchprolong"></div>
    </form>
</div>

<div class="modal modal-login jqmWindow" id="perenos_form">

	<header class="modal-header">
		<h3>Change match day</h3>
		<a href="#" class="close jqmClose"></a>
	</header>
	<div class="modal-content">
		<form action="javascript:perenos_save();" >
			<p>
				<input data-format="dd.MM.yyyy" name="perenos_time" type='text' id="perenos_time" value='' class='date demo_ranged'/>
			</p>
			<p>
				<input type="submit" class="button" value="Change" />
			</p>
		</form>
	</div>
</div>

<div id="dialog-confirm" style="display:none;" title="Внимание!">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        <span id="error_text"></span></p>
</div>


{if $oTournament->getGametypeId()!=3 and $oTournament->getDatezayavki()!='0000-00-00' and $oTournament->getDatezayavki()|date_format:"%Y%m%d" >= $smarty.now|date_format:"%Y%m%d"}

<section class="block">
    <h2><p align="center"><a href="{$oTournament->getUrlFull()}players/enter/">Прими участие, подай заявку</a></p></h1>
</section>

{/if}


<script type="text/javascript"> 
var tournament_for_hover={$oTournament->getTournamentId()};
var miniturnir_game_for_hover=0;
var miniturnir_gametype_for_hover=0;
 
  {*{literal}
  $(document).ready(function()
	{
		turn_on_hover_team();
	});

{/literal}*}
</script> 	
