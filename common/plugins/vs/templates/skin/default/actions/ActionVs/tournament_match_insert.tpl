{include file='header.tpl' menu='blog'}
{include file="$sTemplatePathPlugin/actions/ActionVs/tournament_menu.tpl"  whats="raspisanie"}
<br/>
{if $oMatch->getGametypeId()==3}
<form action="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}/_match_insert/{$oMatch->getMatchId()}{if $team_result!=$myteam}/{$team_result}{/if}" onsubmit="return checkForm(this);"  method="post" id="form1" name="form1">
 
<p align="center">
			<span id="match_teams_teamplay"></span>
		</p>
		<p align="center">
			<input id="inputaway_teamplay" name="inputaway_teamplay" {if $team_result==$oMatch->getAway()}onKeyUp="MyAdd(this.value)"{/if} type="text" SIZE="2" maxlength="2" {if $oMatchResult}value="{$oMatchResult->getAway()}"{/if}/>:<input id="inputhome_teamplay"  name="inputhome_teamplay" type="text" {if $team_result==$oMatch->getHome()}onKeyUp="MyAdd(this.value)"{/if} SIZE="2" maxlength="2" {if $oMatchResult}value="{$oMatchResult->getHome()}"{/if}/> <span id="span_exist_o_teamplay" {if $oTournament->getExistO()==0}style="display:none;"{/if}>
			<input id="ot_teamplay" name="ot_teamplay" type="checkbox" value="1" {if $oMatchResult && $oMatchResult->getOt()==1}CHECKED="CHECKED"{/if}/>ОТ </span><span id="span_exist_b_teamplay" {if $oTournament->getExistB()==0}style="display:none;"{/if}> <input id="so_teamplay" name="so_teamplay" type="checkbox" value="1"/>/ SO</span> <span id="vvel_teamplay"></span>
		</p>
				<p>
			<div id="divTxt">

{if $aMatchgoal}
{assign var=num value=1}	
{foreach from=$aMatchgoal item=oMatchgoal}
<p class="result_scorer" id="row{$num}">
P.<select id="period{$num}" name="period{$num}">
	<option value="1" {if $oMatchgoal->getPeriod()==1}SELECTED{/if}>1</option>
	<option value="2" {if $oMatchgoal->getPeriod()==2}SELECTED{/if}>2</option>
	<option value="3" {if $oMatchgoal->getPeriod()==3}SELECTED{/if}>3</option>
	<option value="4" {if $oMatchgoal->getPeriod()==4}SELECTED{/if}>OT</option>
</select> 
M.<select id="minute{$num}" name="minute{$num}"><option value="{$oMatchgoal->getMinute()}">{$oMatchgoal->getMinute()}</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option></select> 
S. <select id="secunde{$num}" name="secunde{$num}"><option value="{$oMatchgoal->getSecunde()}">{$oMatchgoal->getSecunde()}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select> 
G. <select id="goal{$num}" name="goal{$num}"><option value="0" {if $oMatchgoal->getGoal()==0}SELECTED{/if}>{$aLang.plugin.vs.bot}</option>

{foreach from=$aPlayercards item=oPlayercards name=el2}
{assign var=oUser value=$oPlayercards->getUser()}
<option value="{$oPlayercards->getPlayercardId()}" {if $oMatchgoal->getGoal()==$oPlayercards->getPlayercardId()}SELECTED{/if}>{$oPlayercards->getFamily()} {$oPlayercards->getName()|truncate:2:'.'}({$oUser->getLogin()})</option>
{/foreach}
</select>

1a. <select id="assist_{$num}" name="assist_{$num}"><option value="0" {if $oMatchgoal->getAssist()==0}SELECTED{/if}>{$aLang.plugin.vs.bot}</option><option value="-1" {if $oMatchgoal->getAssist()==-1}SELECTED{/if}>-</option>

{foreach from=$aPlayercards item=oPlayercards name=el2}
{assign var=oUser value=$oPlayercards->getUser()}
<option value="{$oPlayercards->getPlayercardId()}" {if $oMatchgoal->getAssist()==$oPlayercards->getPlayercardId()}SELECTED{/if}>{$oPlayercards->getFamily()} {$oPlayercards->getName()|truncate:2:'.'}({$oUser->getLogin()})</option>
{/foreach}
</select>

2a. <select id="assist__{$num}" name="assist__{$num}"><option value="0" {if $oMatchgoal->getAssist2()==0}SELECTED{/if}>{$aLang.plugin.vs.bot}</option><option value="-1" {if $oMatchgoal->getAssist2()==-1}SELECTED{/if}>-</option>

{foreach from=$aPlayercards item=oPlayercards name=el2}
{assign var=oUser value=$oPlayercards->getUser()}
<option value="{$oPlayercards->getPlayercardId()}" {if $oMatchgoal->getAssist2()==$oPlayercards->getPlayercardId()}SELECTED{/if}>{$oPlayercards->getFamily()} {$oPlayercards->getName()|truncate:2:'.'}({$oUser->getLogin()})</option>
{/foreach}
</select>

<select id="sostav{$num}" name="sostav{$num}">
	<option value="0" {if $oMatchgoal->getType()==0}SELECTED{/if}>Normal </option>
	<option value="1" {if $oMatchgoal->getType()==1}SELECTED{/if}>Powerplay</option>
	<option value="2" {if $oMatchgoal->getType()==2}SELECTED{/if}>Short-handed</option>
	<option value="3" {if $oMatchgoal->getType()==3}SELECTED{/if}>Penalty shot</option>
</select> 
En?<input type="checkbox" id="PSH" name="PSH1" value="1" {if $oMatchgoal->getEmptyNet()==1}CHECKED="CHECKED"{/if}></p>
{assign var=num value=$num+1}	
{/foreach}
{/if}
			</div>
		</p>

{if $aPlayercards}
<input type="hidden" name="id" id="id" {if $aMatchgoal}value="{$aMatchgoal|@count}"{else} value="0"{/if}>
<table>  
 <tr>
  <td colspan="4"><h1>{$aLang.plugin.vs.players}</h1></td>
  </tr>
{foreach from=$positions item=position name=el2}
<tr>
	<td class="td_team_center">{$position.brief}{if $position.brief!='Bot'}:<select id="player{$position.num}" name="{$position.brief}">
									<option value="0">{$aLang.plugin.vs.bot}</option>
									{foreach from=$aPlayercards item=oPlayercards name=el2}
									{assign var=oUser value=$oPlayercards->getUser()}									
									<option value="{$oPlayercards->getPlayercardId()}"  
									
									{if $aMatchplayerstat}
										{foreach from=$aMatchplayerstat item=oMatchplayerstat}
										{if $position.brief==$oMatchplayerstat->getPosition() && 
										$oPlayercards->getPlayercardId()==$oMatchplayerstat->getPlayercardId()}
										SELECTED
										{/if}
										{/foreach}
									{/if}
									>{$oPlayercards->getFullFio()} ({$oUser->getLogin()})</option>
									{/foreach}
									
								</select>{else}<input type="hidden" name="{$position.brief}" id="player{$position.num}" value="0">{/if}</td>
</tr>
<tr>
	<td class="td_team_center">
		{foreach from=$position.params item=param key=key name=el2}
		
			{$param}:<input name="{$key}{$position.num}" type="text" id="{$key}{$position.num}" size="5" 
			{if $aMatchplayerstat}
				{foreach from=$aMatchplayerstat item=oMatchplayerstat}
				{if $position.brief==$oMatchplayerstat->getPosition() }
				{if $key=="shots"}value="{$oMatchplayerstat->getShots()}"{/if}
				{if $key=="penalty"}value="{$oMatchplayerstat->getPenalty()}"{/if}
				{if $key=="hits"}value="{$oMatchplayerstat->getHits()}"{/if}
				{/if}
				{/foreach}
			{else}
				
			{/if}
			
			
			>
		
		{/foreach}
	</td>
  </tr> 
  <tr>
  <td><br/></td>
   </tr> 
{/foreach}
 <tr>
  <td colspan="4"><h1>{$aLang.plugin.vs.team_stats}</h1></td>
  </tr>
 
  <tr class="odd">
   <td class="td_team_center">{$aLang.plugin.vs.powerplay} (scored/all)</td>
   <td colspan="3" class="td_team_center"><input name="pp_r" type="text" id="pp_r" size="2" {if $oMatchResult}value="{$oMatchResult->getPowerplayRealize()}"{/if}/>/<input name="pp" type="text" id="pp" {if $oMatchResult}value="{$oMatchResult->getPp()}"{/if} size="2" />
<input name="penalties" type="hidden" id="penalties" value="0" size="2" /></td>

  </tr>

  <tr class="even">
   <td class="td_team_center">{$aLang.plugin.vs.faceoff} (won)</td>
   <td class="td_team_center" colspan="3"><input name="faceoff_win" type="text" id="faceoff_win" {if $oMatchResult}value="{$oMatchResult->getFaceoffWin()}"{/if} size="2" /></td>
<tr class="odd">
   <td class="td_team_center">{$aLang.plugin.vs.tia}</td>
   <td class="td_team_center" colspan="3">Minutes<SELECT id="minute_at" NAME="minute_at">{if $oMatchResult}<OPTION value={$oMatchResult->getMinuteAt()}>{$oMatchResult->getMinuteAt()}</OPTION>{/if}<OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION><OPTION value=20>20</OPTION><OPTION value=21>21</OPTION><OPTION value=22>22</OPTION><OPTION value=23>23</OPTION><OPTION value=24>24</OPTION><OPTION value=25>25</OPTION><OPTION value=26>26</OPTION><OPTION value=27>27</OPTION><OPTION value=28>28</OPTION><OPTION value=29>29</OPTION><OPTION value=30>30</OPTION><OPTION value=31>31</OPTION><OPTION value=32>32</OPTION><OPTION value=33>33</OPTION><OPTION value=34>34</OPTION><OPTION value=35>35</OPTION><OPTION value=36>36</OPTION><OPTION value=37>37</OPTION><OPTION value=38>38</OPTION><OPTION value=39>39</OPTION><OPTION value=40>40</OPTION><OPTION value=41>41</OPTION><OPTION value=42>42</OPTION><OPTION value=43>43</OPTION><OPTION value=44>44</OPTION><OPTION value=45>45</OPTION><OPTION value=46>46</OPTION><OPTION value=47>47</OPTION><OPTION value=48>48</OPTION><OPTION value=49>49</OPTION><OPTION value=50>50</OPTION><OPTION value=51>51</OPTION><OPTION value=52>52</OPTION><OPTION value=53>53</OPTION><OPTION value=54>54</OPTION><OPTION value=55>55</OPTION><OPTION value=56>56</OPTION><OPTION value=57>57</OPTION><OPTION value=58>58</OPTION><OPTION value=59>59</OPTION></SELECT>seconds<SELECT id="secunde_at" NAME="secunde_at">{if $oMatchResult}<OPTION value={$oMatchResult->getSecundeAt()}>{$oMatchResult->getSecundeAt()}</OPTION>{/if}<OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION><OPTION value=20>20</OPTION><OPTION value=21>21</OPTION><OPTION value=22>22</OPTION><OPTION value=23>23</OPTION><OPTION value=24>24</OPTION><OPTION value=25>25</OPTION><OPTION value=26>26</OPTION><OPTION value=27>27</OPTION><OPTION value=28>28</OPTION><OPTION value=29>29</OPTION><OPTION value=30>30</OPTION><OPTION value=31>31</OPTION><OPTION value=32>32</OPTION><OPTION value=33>33</OPTION><OPTION value=34>34</OPTION><OPTION value=35>35</OPTION><OPTION value=36>36</OPTION><OPTION value=37>37</OPTION><OPTION value=38>38</OPTION><OPTION value=39>39</OPTION><OPTION value=40>40</OPTION><OPTION value=41>41</OPTION><OPTION value=42>42</OPTION><OPTION value=43>43</OPTION><OPTION value=44>44</OPTION><OPTION value=45>45</OPTION><OPTION value=46>46</OPTION><OPTION value=47>47</OPTION><OPTION value=48>48</OPTION><OPTION value=49>49</OPTION><OPTION value=50>50</OPTION><OPTION value=51>51</OPTION><OPTION value=52>52</OPTION><OPTION value=53>53</OPTION><OPTION value=54>54</OPTION><OPTION value=55>55</OPTION><OPTION value=56>56</OPTION><OPTION value=57>57</OPTION><OPTION value=58>58</OPTION><OPTION value=59>59</OPTION></SELECT></td>

 <tr class="even">
   <td class="td_team_center">{$aLang.plugin.vs.pass_perc}</td>
   <td class="td_team_center" colspan="3"><input name="pass_prc" type="pass" id="pass_prc" {if $oMatchResult}value="{$oMatchResult->getPassPrc()}"{/if} size="3" /></td>

  </tr>
 <tr class="odd">
    <td class="td_team_center">1st star</td>
	 <td colspan="3" class="td_team_center"><SELECT id="star1" NAME="star1"><option value="-1">-</option><option value="0">Бот</option>
									{foreach from=$aPlayercards item=oPlayercards name=el2}
									{assign var=oUser value=$oPlayercards->getUser()}									
									<option value="{$oPlayercards->getPlayercardId()}" {if $oMatchResult && $oMatchResult->getStar1()==$oPlayercards->getPlayercardId()}SELECTED{/if} >{$oPlayercards->getFullFio()} ({$oUser->getLogin()})</option>
									{/foreach}</SELECT></td>
</tr>
<tr class="even">
    <td class="td_team_center">2nd star</td>
	 <td colspan="3" class="td_team_center"><SELECT id="star2" NAME="star2"><option value="-1">-</option><option value="0">Бот</option>
									{foreach from=$aPlayercards item=oPlayercards name=el2}
									{assign var=oUser value=$oPlayercards->getUser()}									
									<option value="{$oPlayercards->getPlayercardId()}" {if $oMatchResult && $oMatchResult->getStar2()==$oPlayercards->getPlayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()} ({$oUser->getLogin()})</option>
									{/foreach}</SELECT></td>
</tr>
<tr class="odd">
    <td class="td_team_center">3rd star</td>
	 <td colspan="3" class="td_team_center"><SELECT id="star3" NAME="star3"><option value="-1">-</option><option value="0" {if $oMatchResult && $oMatchResult->getStar3()==0}SELECTED{/if}>Бот</option>
									{foreach from=$aPlayercards item=oPlayercards name=el2}
									{assign var=oUser value=$oPlayercards->getUser()}									
									<option value="{$oPlayercards->getPlayercardId()}" {if $oMatchResult && $oMatchResult->getStar3()==$oPlayercards->getPlayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()} ({$oUser->getLogin()})</option>
									{/foreach}</SELECT></td>
</tr>
</table> 

{/if}
 <tr>
  <td colspan="4"><h1>{$aLang.plugin.vs.press}</h1></td>
  </tr>

		<p>
			<textarea id="comment" name="comment" class="comment_textarea" cols="1" rows="1">{if $oMatchResult}{$oMatchResult->getComment()}{/if}</textarea>
		</p>
<p>
	<input type="submit" value="Submit" name="submit">
</p>

</form>		
{literal}
<style>
.comment_textarea{
width: 99%;
height: 200px;
}
</style>
<script>
$(document).ready(function() {
	var params = {};
	params['match_id']={/literal}{$oMatch->getMatchId()}{literal};
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	$('#team_id').val({/literal}{$team_result}{literal});
	$('#match_id').val(params['match_id']);
	params['team_id']=$('#team_id').val(); 
	
	$('#result_edit').val(0); 
	
	ls.ajax(aRouter['ajax']+'match/resultgetadmin/', params, function(result){
				if (!result) {
					ls.msg.error('Error15','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error('Error16','Please try again later');
				} else {
					if(result.away_team!==undefined){
						$("#match_teams_teamplay").html(result.away_team+" - " +result.home_team);
					}else{
						$("#match_teams_teamplay").html(result.away_user+" - " +result.home_user);
					}
					if(result.yess){
						ot="";
						so="";
						if(result.ot==1)ot=" OT";
						if(result.so==1)so=" SO";
						$("#vvel_teamplay").html("(" +result.away+" : " +result.home+ot+so+")");									 
					}
					
				}
			});
});
var players='{/literal}<option value="0">Бот</option>{foreach from=$aPlayercards item=oPlayercards name=el2}{assign var=oUser value=$oPlayercards->getUser()}<option value="{$oPlayercards->getPlayercardId()}">{*{$oPlayercards->getFio()} *}{$oPlayercards->getFamily()} {$oPlayercards->getName()|truncate:2:'.'}({$oUser->getLogin()})</option>{/foreach}{literal}';

function MyAdd(number) {
	var id = document.getElementById("id").value;
	if (number=='') number=0;

	id=parseInt(id);
	number=parseInt(number);
	if (number>id){
		id=parseInt(id)+1;
		for ( var i = id; i <=number; i++ ){
			$("#divTxt").append("<p class='result_scorer' id='row" + i + "'>P.<SELECT id='period" + i + "' NAME='period" + i + "'><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>OT</OPTION></SELECT> M.<SELECT id='minute" + i + "' NAME='minute" + i + "'><OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION></SELECT> S. <SELECT id='secunde" + i + "' NAME='secunde" + i + "'><OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION><OPTION value=20>20</OPTION><OPTION value=21>21</OPTION><OPTION value=22>22</OPTION><OPTION value=23>23</OPTION><OPTION value=24>24</OPTION><OPTION value=25>25</OPTION><OPTION value=26>26</OPTION><OPTION value=27>27</OPTION><OPTION value=28>28</OPTION><OPTION value=29>29</OPTION><OPTION value=30>30</OPTION><OPTION value=31>31</OPTION><OPTION value=32>32</OPTION><OPTION value=33>33</OPTION><OPTION value=34>34</OPTION><OPTION value=35>35</OPTION><OPTION value=36>36</OPTION><OPTION value=37>37</OPTION><OPTION value=38>38</OPTION><OPTION value=39>39</OPTION><OPTION value=40>40</OPTION><OPTION value=41>41</OPTION><OPTION value=42>42</OPTION><OPTION value=43>43</OPTION><OPTION value=44>44</OPTION><OPTION value=45>45</OPTION><OPTION value=46>46</OPTION><OPTION value=47>47</OPTION><OPTION value=48>48</OPTION><OPTION value=49>49</OPTION><OPTION value=50>50</OPTION><OPTION value=51>51</OPTION><OPTION value=52>52</OPTION><OPTION value=53>53</OPTION><OPTION value=54>54</OPTION><OPTION value=55>55</OPTION><OPTION value=56>56</OPTION><OPTION value=57>57</OPTION><OPTION value=58>58</OPTION><OPTION value=59>59</OPTION></SELECT> G. <SELECT id='goal" + i + "' NAME='goal" + i + "'>"+ players +"</SELECT> 1a. <SELECT id='assist_" + i + "' NAME='assist_" + i + "'><OPTION value='-1'>-</OPTION>"+ players +"</SELECT> 2a. <SELECT id='assist__" + i + "' NAME='assist__" + i + "'><OPTION value='-1'>-</OPTION>"+ players +"</SELECT><SELECT id='sostav" + i + "' NAME='sostav" + i + "'><OPTION value=0>Normal </OPTION><OPTION value=1>Powerplay</OPTION><OPTION value=2>Penalty Kill</OPTION><OPTION value=3>Penalty shot</OPTION></SELECT> En?<input type='checkbox' id='PSH' name='PSH" + i + "' value='1'>");
		}
		
		id = parseInt(number);
		document.getElementById("id").value = id;
	}
	else if(number<id) 
	{
		for ( var i = id; i >number; i-- ){
			removeFormField("#row" + i);
		}
		id = parseInt(number);
		document.getElementById("id").value = id;
	}
}

function removeFormField(id) {
	$(id).remove();
}
 
function checkForm(form) {
//alert("Проверьте правильность ввода информации! Check that your input are right!");
if (1==1 /*confirm("Вы уверены, что все заполнили правильно? Are you sure that you right?")*/) 
{
var value, 
type,
ipp,
goal,
assist_,
assist__,
sostav,
bot=0; 
var errorList = [];
var t=0;
var errorText = {
1 : "Таки овертайм? Really, overtime? =))",
2 : "Сам себе пас отдал? Красавчег! C'mon, man! Pass to yourself =)",
3 : "Пас при штрафном броске? Pass at penalty shot?",
4 : "Один человек на нескольких позициях? One-man army, dude? =)",
5 : "Что ещё за ничья? What a draw?",
6 : "Вы слишком халатно отнеслись к пресс-конференции. More words and expression for press conference, please",
7 : "Введите правильно время забитых голов. Sumbit goal's time right",
8 : "Вы невнимательно или некорректно ввели игроков в составе или забивших(ассистировавших) или в звездах. You choose wrong players at roster or scoring or assisting or stars.",
9 : "Проверьте звезд. Check your stars.",
10 : "Проверьте вбрасывания. Check your faceoffs.",
11 : "А первый пас? Where is first pass?",
12 : "А время в атаке? Where is time in attack?"
}
if(parseInt(document.getElementById("inputaway_teamplay").value) == parseInt(document.getElementById("inputhome_teamplay").value)) errorList.push(5);
if(Math.abs(parseInt(document.getElementById("inputaway_teamplay").value) - parseInt((document.getElementById("inputhome_teamplay").value)))>1 && (document.getElementById("ot_teamplay").checked==true)) errorList.push(1);

var id = document.getElementById("id").value;
res=0;
for (var i = 0; i <parseInt(id); i++) {
ipp=i+1;
goal=document.getElementById("goal"+ipp+"").value;
assist_=document.getElementById("assist_"+ipp+"").value;
assist__=document.getElementById("assist__"+ipp+"").value;
sostav=document.getElementById("sostav"+ipp+"").value;

period=document.getElementById("period"+ipp+"").value;
minute=document.getElementById("minute"+ipp+"").value;
secunde=document.getElementById("secunde"+ipp+"").value;
if(parseInt(minute)==0 && parseInt(secunde)==0) errorList.push(7);
if(parseInt(document.getElementById("inputaway_teamplay").value)>parseInt(document.getElementById("inputhome_teamplay").value) && (document.getElementById("ot_teamplay").checked==true) && period==4)res=res+1;
if(ipp<parseInt(id)){
for (var r = ipp+1; r <=parseInt(id); r++) {
if(period==document.getElementById("period"+r+"").value && minute == document.getElementById("minute"+r+"").value && secunde == document.getElementById("secunde"+r+"").value) errorList.push(7);

}
}
tes=0;
if(goal!=bot){
for (pl = 1; pl <=7; pl++) {
if(goal==document.getElementById("player"+pl+"").value) tes=tes+1; 
}
if(tes==0)errorList.push(8);
}
tes=0;
if(assist_!=bot && assist_!=-1){
for (pl = 1; pl <=7; pl++) {
if(assist_==document.getElementById("player"+pl+"").value) tes=tes+1; 
}
if(tes==0)errorList.push(8);
}
tes=0;
if(assist__!=bot && assist__!=-1){
for (pl = 1; pl <=7; pl++) {
if(assist__==document.getElementById("player"+pl+"").value) tes=tes+1; 
}
if(tes==0)errorList.push(8);
}
if(assist__!=bot && assist__!=-1 && assist_==-1)errorList.push(11);

if(goal==assist_ && assist_ !=bot && assist_ !=-1) errorList.push(2);
if(goal==assist__ && assist__ !=bot && assist__ !=-1) errorList.push(2);
if(assist__==assist_ && assist_ !=bot && assist_ !=-1) errorList.push(2);
if ((sostav=="3") && (assist_ !="0")) errorList.push(3);
if ((sostav=="3") && (assist__ !="0")) errorList.push(3);
}
minute_at=document.getElementById("minute_at").value;
secunde_at=document.getElementById("secunde_at").value;
if(parseInt(minute_at)==0 && parseInt(secunde_at)==0) errorList.push(12);
for (i = 1; i <=3; i++) {
star=document.getElementById("star"+i+"").value;
tes=0;
	for (var k = 1; k <=7; k++) {
		if(star==document.getElementById("player"+k+"").value) tes=tes+1;
		if(star==-1) tes=tes+1;
		if(star==bot) tes=tes+1;
	}
if(tes==0)errorList.push(8);
	for (var k = 2; k <=3; k++) {
		if(i!=k){
		if(star==document.getElementById("star"+k+"").value && star!=-1 ) errorList.push(9);
		}
	}
}

for (i = 1; i <=7; i++) {
for (var k = 2; k <=7; k++) {
if(i!=k)
	{
	if((document.getElementById("player"+i+"").value == document.getElementById("player"+k+"").value) && (document.getElementById("player"+k+"").value!=bot))t=t+1;
	}
}
}
//if((document.getElementById("ot_teamplay").checked==true) && res==0 && parseInt(document.getElementById("inputaway_teamplay").value)>parseInt(document.getElementById("inputhome_teamplay").value))errorList.push(1);
//if(parseInt(document.getElementById("faceoff_win").value)>parseInt(document.getElementById("faceoff_all").value))errorList.push(10);
if (t!=0) errorList.push(4);
//if(document.getElementById("comment").value.length<10) errorList.push(6);
if (!errorList.length) return true;

var errorMsg = "Warning! Error:\n\n";
for (i = 0; i < errorList.length; i++) {
errorMsg += errorText[errorList[i]] + "\n";
}
alert(errorMsg);
return false;
}
else {
return false;
}
}
function text1Change()
{
 /*a=document.getElementById("comment").value.length;
 if((a)>11){document.form1.t2.value=0; 
 }else{document.form1.t2.value=11-a; }
*/

}
</script>
{/literal}
{/if}

{if $oMatch->getGametypeId()==7}
<form action="{$oBlog->getUrlFull()}turnir/{$oTournament->getUrl()}/_match_insert/{$oMatch->getMatchId()}{if $team_result!=$myteam}/{$team_result}{/if}" onsubmit="return checkForm(this);"  method="post" id="form1" name="form1">
 
<p align="center">
			<span id="match_teams_teamplay"></span>
		</p>
		<p align="center">
			<input id="inputaway_teamplay" name="inputaway_teamplay" {if $team_result==$oMatch->getAway()}onKeyUp="MyAdd(this.value)"{/if} type="text" SIZE="2" maxlength="2" {if $oMatchResult}value="{$oMatchResult->getAway()}"{/if}/>:<input id="inputhome_teamplay"  name="inputhome_teamplay" type="text" {if $team_result==$oMatch->getHome()}onKeyUp="MyAdd(this.value)"{/if} SIZE="2" maxlength="2" {if $oMatchResult}value="{$oMatchResult->getHome()}"{/if}/> <span id="span_exist_o_teamplay" {if $oTournament->getExistO()==0}style="display:none;"{/if}>
			<input id="ot_teamplay" name="ot_teamplay" type="checkbox" value="1" {if $oMatchResult && $oMatchResult->getOt()==1}CHECKED="CHECKED"{/if}/>ОТ </span><span id="span_exist_b_teamplay" {if $oTournament->getExistB()==0}style="display:none;"{/if}> <input id="so_teamplay" name="so_teamplay" type="checkbox" value="1"/>/ SO</span> <span id="vvel_teamplay"></span>
		</p>
				<p>
			<div id="divTxt">

{if $aMatchgoal}
{assign var=num value=1}	
{foreach from=$aMatchgoal item=oMatchgoal}
<p class="result_scorer" id="row{$num}">
P.<select id="period{$num}" name="period{$num}">
	<option value="1" {if $oMatchgoal->getPeriod()==1}SELECTED{/if}>1</option>
	<option value="2" {if $oMatchgoal->getPeriod()==2}SELECTED{/if}>2</option>
	<option value="3" {if $oMatchgoal->getPeriod()==3}SELECTED{/if}>3</option>
	<option value="4" {if $oMatchgoal->getPeriod()==4}SELECTED{/if}>OT</option>
</select> 
M.<select id="minute{$num}" name="minute{$num}"><option value="{$oMatchgoal->getMinute()}">{$oMatchgoal->getMinute()}</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option></select> 
S. <select id="secunde{$num}" name="secunde{$num}"><option value="{$oMatchgoal->getSecunde()}">{$oMatchgoal->getSecunde()}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select> 
G. <select id="goal{$num}" name="goal{$num}"><option value="0" {if $oMatchgoal->getGoal()==0}SELECTED{/if}>Бот</option>

{foreach from=$aPlayercards item=oPlayercards name=el2} 
<option value="{$oPlayercards->getNhlplayercardId()}" {if $oMatchgoal->getGoal()==$oPlayercards->getNhlplayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()}</option>
{/foreach}
</select>

1a. <select id="assist_{$num}" name="assist_{$num}"><option value="0" {if $oMatchgoal->getAssist()==0}SELECTED{/if}>Бот</option><option value="-1" {if $oMatchgoal->getAssist()==-1}SELECTED{/if}>-</option>

{foreach from=$aPlayercards item=oPlayercards name=el2} 
<option value="{$oPlayercards->getNhlplayercardId()}" {if $oMatchgoal->getAssist()==$oPlayercards->getNhlplayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()}</option>
{/foreach}
</select>

2a. <select id="assist__{$num}" name="assist__{$num}"><option value="0" {if $oMatchgoal->getAssist2()==0}SELECTED{/if}>Бот</option><option value="-1" {if $oMatchgoal->getAssist2()==-1}SELECTED{/if}>-</option>

{foreach from=$aPlayercards item=oPlayercards name=el2} 
<option value="{$oPlayercards->getNhlplayercardId()}" {if $oMatchgoal->getAssist2()==$oPlayercards->getNhlplayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()}</option>
{/foreach}
</select>

<select id="sostav{$num}" name="sostav{$num}">
	<option value="0" {if $oMatchgoal->getType()==0}SELECTED{/if}>Normal </option>
	<option value="1" {if $oMatchgoal->getType()==1}SELECTED{/if}>Powerplay</option>
	<option value="2" {if $oMatchgoal->getType()==2}SELECTED{/if}>Short-handed</option>
	<option value="3" {if $oMatchgoal->getType()==3}SELECTED{/if}>Penalty shot</option>
</select> 
En?<input type="checkbox" id="PSH" name="PSH1" value="1" {if $oMatchgoal->getEmptyNet()==1}CHECKED="CHECKED"{/if}></p>
{assign var=num value=$num+1}	
{/foreach}
{/if}
			</div>
		</p>

{if $aPlayercards}
<input type="hidden" name="id" id="id" {if $aMatchgoal}value="{$aMatchgoal|@count}"{else} value="0"{/if}>
<table>  

<tr>
  <td colspan="4"><h1>{$aLang.plugin.vs.players}</h1></td>
  </tr>
{foreach from=$positions item=position name=el2}
{if $position.brief=="G"}
<tr>
	<td class="td_team_center">{$position.brief}{if $position.brief!='Bot'}:<select id="player{$position.num}" name="{$position.brief}">
									{foreach from=$aPlayercards item=oPlayercards name=el2} 
									{if $oPlayercards->getG()==1}
										<option value="{$oPlayercards->getNhlplayercardId()}"  
										
										{if $aMatchplayerstat}
											{foreach from=$aMatchplayerstat item=oMatchplayerstat}
											{if $position.brief==$oMatchplayerstat->getPosition() && 
											$oPlayercards->getNhlplayercardId()==$oMatchplayerstat->getPlayercardId()}
											SELECTED
											{/if}
											{/foreach}
										{/if}
										>{$oPlayercards->getFullFio()} </option>
									{/if}
									{/foreach}
									
								</select>{else}<input type="hidden" name="{$position.brief}" id="player{$position.num}" value="0">{/if}</td>
</tr>

  <tr>
  <td><br/></td>
   </tr> 
{/if}
{/foreach}
 <tr>
  <td colspan="4"><h1>{$aLang.plugin.vs.team_stats}</h1></td>
  </tr>
 
  <tr class="odd">
   <td class="td_team_center">{$aLang.plugin.vs.powerplay} (scored/all)</td>
   <td colspan="3" class="td_team_center"><input name="pp_r" type="text" id="pp_r" size="2" {if $oMatchResult}value="{$oMatchResult->getPowerplayRealize()}"{/if}/>/<input name="pp" type="text" id="pp" {if $oMatchResult}value="{$oMatchResult->getPp()}"{/if} size="2" />
<input name="penalties" type="hidden" id="penalties" value="0" size="2" /></td>

  </tr>

  <tr class="even">
   <td class="td_team_center">{$aLang.plugin.vs.faceoff}(won)</td>
   <td class="td_team_center" colspan="3"><input name="faceoff_win" type="text" id="faceoff_win" {if $oMatchResult}value="{$oMatchResult->getFaceoffWin()}"{/if} size="2" /></td>
<tr class="odd">
   <td class="td_team_center">{$aLang.plugin.vs.tia}</td>
   <td class="td_team_center" colspan="3">Minutes<SELECT id="minute_at" NAME="minute_at">{if $oMatchResult}<OPTION value={$oMatchResult->getMinuteAt()}>{$oMatchResult->getMinuteAt()}</OPTION>{/if}<OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION><OPTION value=20>20</OPTION><OPTION value=21>21</OPTION><OPTION value=22>22</OPTION><OPTION value=23>23</OPTION><OPTION value=24>24</OPTION><OPTION value=25>25</OPTION><OPTION value=26>26</OPTION><OPTION value=27>27</OPTION><OPTION value=28>28</OPTION><OPTION value=29>29</OPTION><OPTION value=30>30</OPTION><OPTION value=31>31</OPTION><OPTION value=32>32</OPTION><OPTION value=33>33</OPTION><OPTION value=34>34</OPTION><OPTION value=35>35</OPTION><OPTION value=36>36</OPTION><OPTION value=37>37</OPTION><OPTION value=38>38</OPTION><OPTION value=39>39</OPTION><OPTION value=40>40</OPTION><OPTION value=41>41</OPTION><OPTION value=42>42</OPTION><OPTION value=43>43</OPTION><OPTION value=44>44</OPTION><OPTION value=45>45</OPTION><OPTION value=46>46</OPTION><OPTION value=47>47</OPTION><OPTION value=48>48</OPTION><OPTION value=49>49</OPTION><OPTION value=50>50</OPTION><OPTION value=51>51</OPTION><OPTION value=52>52</OPTION><OPTION value=53>53</OPTION><OPTION value=54>54</OPTION><OPTION value=55>55</OPTION><OPTION value=56>56</OPTION><OPTION value=57>57</OPTION><OPTION value=58>58</OPTION><OPTION value=59>59</OPTION></SELECT>seconds<SELECT id="secunde_at" NAME="secunde_at">{if $oMatchResult}<OPTION value={$oMatchResult->getSecundeAt()}>{$oMatchResult->getSecundeAt()}</OPTION>{/if}<OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION><OPTION value=20>20</OPTION><OPTION value=21>21</OPTION><OPTION value=22>22</OPTION><OPTION value=23>23</OPTION><OPTION value=24>24</OPTION><OPTION value=25>25</OPTION><OPTION value=26>26</OPTION><OPTION value=27>27</OPTION><OPTION value=28>28</OPTION><OPTION value=29>29</OPTION><OPTION value=30>30</OPTION><OPTION value=31>31</OPTION><OPTION value=32>32</OPTION><OPTION value=33>33</OPTION><OPTION value=34>34</OPTION><OPTION value=35>35</OPTION><OPTION value=36>36</OPTION><OPTION value=37>37</OPTION><OPTION value=38>38</OPTION><OPTION value=39>39</OPTION><OPTION value=40>40</OPTION><OPTION value=41>41</OPTION><OPTION value=42>42</OPTION><OPTION value=43>43</OPTION><OPTION value=44>44</OPTION><OPTION value=45>45</OPTION><OPTION value=46>46</OPTION><OPTION value=47>47</OPTION><OPTION value=48>48</OPTION><OPTION value=49>49</OPTION><OPTION value=50>50</OPTION><OPTION value=51>51</OPTION><OPTION value=52>52</OPTION><OPTION value=53>53</OPTION><OPTION value=54>54</OPTION><OPTION value=55>55</OPTION><OPTION value=56>56</OPTION><OPTION value=57>57</OPTION><OPTION value=58>58</OPTION><OPTION value=59>59</OPTION></SELECT></td>

 <tr class="even">
   <td class="td_team_center">{$aLang.plugin.vs.pass_perc}</td>
   <td class="td_team_center" colspan="3"><input name="pass_prc" type="pass" id="pass_prc" {if $oMatchResult}value="{$oMatchResult->getPassPrc()}"{/if} size="3" /></td>

  </tr>
 <tr class="odd">
    <td class="td_team_center">1st star</td>
	 <td colspan="3" class="td_team_center"><SELECT id="star1" NAME="star1"><option value="-1">-</option> 
									{foreach from=$aPlayercards item=oPlayercards name=el2} 						
									<option value="{$oPlayercards->getNhlplayercardId()}" {if $oMatchResult && $oMatchResult->getStar1()==$oPlayercards->getNhlplayercardId()}SELECTED{/if} >{$oPlayercards->getFullFio()}</option>
									{/foreach}</SELECT></td>
</tr>
<tr class="even">
    <td class="td_team_center">2nd star</td>
	 <td colspan="3" class="td_team_center"><SELECT id="star2" NAME="star2"><option value="-1">-</option> 
									{foreach from=$aPlayercards item=oPlayercards name=el2} 							
									<option value="{$oPlayercards->getNhlplayercardId()}" {if $oMatchResult && $oMatchResult->getStar2()==$oPlayercards->getNhlplayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()}</option>
									{/foreach}</SELECT></td>
</tr>
<tr class="odd">
    <td class="td_team_center">3rd star</td>
	 <td colspan="3" class="td_team_center"><SELECT id="star3" NAME="star3"><option value="-1">-</option> 
									{foreach from=$aPlayercards item=oPlayercards name=el2} 							
									<option value="{$oPlayercards->getNhlplayercardId()}" {if $oMatchResult && $oMatchResult->getStar3()==$oPlayercards->getNhlplayercardId()}SELECTED{/if}>{$oPlayercards->getFullFio()}</option>
									{/foreach}</SELECT></td>
</tr>
</table> 

{/if}
 <tr>
  <td colspan="4"><h1>{$aLang.plugin.vs.press}</h1></td>
  </tr>

		<p>
			<textarea id="comment" name="comment" class="comment_textarea" cols="1" rows="1">{if $oMatchResult}{$oMatchResult->getComment()}{/if}</textarea>
		</p>
<p>
	<input type="submit" value="Submit" name="submit">
</p>

</form>		
{literal}
<style>
.comment_textarea{
width: 99%;
height: 200px;
}
</style>
<script>
$(document).ready(function() {
	var params = {};
	params['match_id']={/literal}{$oMatch->getMatchId()}{literal};
	params['security_ls_key']=LIVESTREET_SECURITY_KEY;
	$('#team_id').val({/literal}{$team_result}{literal});
	$('#match_id').val(params['match_id']);
	params['team_id']=$('#team_id').val(); 
	
	$('#result_edit').val(0); 
	
	ls.ajax(aRouter['ajax']+'match/resultgetadmin/', params, function(result){
				if (!result) {
					ls.msg.error('Error15','Please try again later');
				}
				if (result.bStateError) {
					ls.msg.error('Error16','Please try again later');
				} else {
					if(result.away_team!==undefined){
						$("#match_teams_teamplay").html(result.away_team+" - " +result.home_team);
					}else{
						$("#match_teams_teamplay").html(result.away_user+" - " +result.home_user);
					}
					if(result.yess){
						ot="";
						so="";
						if(result.ot==1)ot=" OT";
						if(result.so==1)so=" SO";
						$("#vvel_teamplay").html("(" +result.away+" : " +result.home+ot+so+")");									 
					}
					
				}
			});
});

var players="{/literal}{foreach from=$aPlayercards item=oPlayercards name=el2}<option value='{$oPlayercards->getNhlplayercardId()}'>{$oPlayercards->getFullFio()} </option>{/foreach}{literal}";
function MyAdd(number) {
	var id = document.getElementById("id").value;
	if (number=='') number=0;

	id=parseInt(id);
	number=parseInt(number);
	if (number>id){
		id=parseInt(id)+1;
		for ( var i = id; i <=number; i++ ){
			$("#divTxt").append("<p class='result_scorer' id='row" + i + "'>P.<SELECT id='period" + i + "' NAME='period" + i + "'><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>OT</OPTION></SELECT> M.<SELECT id='minute" + i + "' NAME='minute" + i + "'><OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION></SELECT> S. <SELECT id='secunde" + i + "' NAME='secunde" + i + "'><OPTION value=0>0</OPTION><OPTION value=1>1</OPTION><OPTION value=2>2</OPTION><OPTION value=3>3</OPTION><OPTION value=4>4</OPTION><OPTION value=5>5</OPTION><OPTION value=6>6</OPTION><OPTION value=7>7</OPTION><OPTION value=8>8</OPTION><OPTION value=9>9</OPTION><OPTION value=10>10</OPTION><OPTION value=11>11</OPTION><OPTION value=12>12</OPTION><OPTION value=13>13</OPTION><OPTION value=14>14</OPTION><OPTION value=15>15</OPTION><OPTION value=16>16</OPTION><OPTION value=17>17</OPTION><OPTION value=18>18</OPTION><OPTION value=19>19</OPTION><OPTION value=20>20</OPTION><OPTION value=21>21</OPTION><OPTION value=22>22</OPTION><OPTION value=23>23</OPTION><OPTION value=24>24</OPTION><OPTION value=25>25</OPTION><OPTION value=26>26</OPTION><OPTION value=27>27</OPTION><OPTION value=28>28</OPTION><OPTION value=29>29</OPTION><OPTION value=30>30</OPTION><OPTION value=31>31</OPTION><OPTION value=32>32</OPTION><OPTION value=33>33</OPTION><OPTION value=34>34</OPTION><OPTION value=35>35</OPTION><OPTION value=36>36</OPTION><OPTION value=37>37</OPTION><OPTION value=38>38</OPTION><OPTION value=39>39</OPTION><OPTION value=40>40</OPTION><OPTION value=41>41</OPTION><OPTION value=42>42</OPTION><OPTION value=43>43</OPTION><OPTION value=44>44</OPTION><OPTION value=45>45</OPTION><OPTION value=46>46</OPTION><OPTION value=47>47</OPTION><OPTION value=48>48</OPTION><OPTION value=49>49</OPTION><OPTION value=50>50</OPTION><OPTION value=51>51</OPTION><OPTION value=52>52</OPTION><OPTION value=53>53</OPTION><OPTION value=54>54</OPTION><OPTION value=55>55</OPTION><OPTION value=56>56</OPTION><OPTION value=57>57</OPTION><OPTION value=58>58</OPTION><OPTION value=59>59</OPTION></SELECT> G. <SELECT id='goal" + i + "' NAME='goal" + i + "'>"+ players +"</SELECT> 1a. <SELECT id='assist_" + i + "' NAME='assist_" + i + "'><OPTION value='-1'>-</OPTION>"+ players +"</SELECT> 2a. <SELECT id='assist__" + i + "' NAME='assist__" + i + "'><OPTION value='-1'>-</OPTION>"+ players +"</SELECT><SELECT id='sostav" + i + "' NAME='sostav" + i + "'><OPTION value=0>Normal </OPTION><OPTION value=1>Powerplay</OPTION><OPTION value=2>Penalty Kill</OPTION><OPTION value=3>Penalty shot</OPTION></SELECT> En?<input type='checkbox' id='PSH' name='PSH" + i + "' value='1'>");
		}
		
		id = parseInt(number);
		document.getElementById("id").value = id;
	}
	else if(number<id) 
	{
		for ( var i = id; i >number; i-- ){
			removeFormField("#row" + i);
		}
		id = parseInt(number);
		document.getElementById("id").value = id;
	}
}

function removeFormField(id) {
	$(id).remove();
}
 
function checkForm(form) {
//alert("Проверьте правильность ввода информации! Check that your input are right!");
if (1==1 /*confirm("Вы уверены, что все заполнили правильно? Are you sure that you right?")*/) 
{
var value, 
type,
ipp,
goal,
assist_,
assist__,
sostav,
bot=0; 
var errorList = [];
var t=0;
var errorText = {
1 : "Таки овертайм? Really, overtime? =))",
2 : "Сам себе пас отдал? Красавчег! C'mon, man! Pass to yourself =)",
3 : "Пас при штрафном броске? Pass at penalty shot?",
4 : "Один человек на нескольких позициях? One-man army, dude? =)",
5 : "Что ещё за ничья? What a draw?",
6 : "Вы слишком халатно отнеслись к пресс-конференции. More words and expression for press conference, please",
7 : "Введите правильно время забитых голов. Sumbit goal's time right",
8 : "Вы невнимательно или некорректно ввели игроков в составе или забивших(ассистировавших) или в звездах. You choose wrong players at roster or scoring or assisting or stars.",
9 : "Проверьте звезд. Check your stars.",
10 : "Проверьте вбрасывания. Check your faceoffs.",
11 : "А первый пас? Where is first pass?",
12 : "А время в атаке? Where is time in attack?"
}
if(parseInt(document.getElementById("inputaway_teamplay").value) == parseInt(document.getElementById("inputhome_teamplay").value)) errorList.push(5);
if(Math.abs(parseInt(document.getElementById("inputaway_teamplay").value) - parseInt((document.getElementById("inputhome_teamplay").value)))>1 && (document.getElementById("ot_teamplay").checked==true)) errorList.push(1);

var id = document.getElementById("id").value;
res=0;
for (var i = 0; i <parseInt(id); i++) {
ipp=i+1;
goal=document.getElementById("goal"+ipp+"").value;
assist_=document.getElementById("assist_"+ipp+"").value;
assist__=document.getElementById("assist__"+ipp+"").value;
sostav=document.getElementById("sostav"+ipp+"").value;

period=document.getElementById("period"+ipp+"").value;
minute=document.getElementById("minute"+ipp+"").value;
secunde=document.getElementById("secunde"+ipp+"").value;
if(parseInt(minute)==0 && parseInt(secunde)==0) errorList.push(7);
if(parseInt(document.getElementById("inputaway_teamplay").value)>parseInt(document.getElementById("inputhome_teamplay").value) && (document.getElementById("ot_teamplay").checked==true) && period==4)res=res+1;
if(ipp<parseInt(id)){
for (var r = ipp+1; r <=parseInt(id); r++) {
if(period==document.getElementById("period"+r+"").value && minute == document.getElementById("minute"+r+"").value && secunde == document.getElementById("secunde"+r+"").value) errorList.push(7);

}
}
tes=0;
if(goal!=bot){
for (pl = 1; pl <=7; pl++) {
if(goal==document.getElementById("player"+pl+"").value) tes=tes+1; 
}
if(tes==0)errorList.push(8);
}
tes=0;
if(assist_!=bot && assist_!=-1){
for (pl = 1; pl <=7; pl++) {
if(assist_==document.getElementById("player"+pl+"").value) tes=tes+1; 
}
if(tes==0)errorList.push(8);
}
tes=0;
if(assist__!=bot && assist__!=-1){
for (pl = 1; pl <=7; pl++) {
if(assist__==document.getElementById("player"+pl+"").value) tes=tes+1; 
}
if(tes==0)errorList.push(8);
}
if(assist__!=bot && assist__!=-1 && assist_==-1)errorList.push(11);

if(goal==assist_ && assist_ !=bot && assist_ !=-1) errorList.push(2);
if(goal==assist__ && assist__ !=bot && assist__ !=-1) errorList.push(2);
if(assist__==assist_ && assist_ !=bot && assist_ !=-1) errorList.push(2);
if ((sostav=="3") && (assist_ !="0")) errorList.push(3);
if ((sostav=="3") && (assist__ !="0")) errorList.push(3);
}
minute_at=document.getElementById("minute_at").value;
secunde_at=document.getElementById("secunde_at").value;
if(parseInt(minute_at)==0 && parseInt(secunde_at)==0) errorList.push(12);
for (i = 1; i <=3; i++) {
star=document.getElementById("star"+i+"").value;
tes=0;
	for (var k = 1; k <=7; k++) {
		if(star==document.getElementById("player"+k+"").value) tes=tes+1;
		if(star==-1) tes=tes+1;
		if(star==bot) tes=tes+1;
	}
if(tes==0)errorList.push(8);
	for (var k = 2; k <=3; k++) {
		if(i!=k){
		if(star==document.getElementById("star"+k+"").value && star!=-1 ) errorList.push(9);
		}
	}
}

for (i = 1; i <=7; i++) {
for (var k = 2; k <=7; k++) {
if(i!=k)
	{
	if((document.getElementById("player"+i+"").value == document.getElementById("player"+k+"").value) && (document.getElementById("player"+k+"").value!=bot))t=t+1;
	}
}
}

if (!errorList.length) return true;

var errorMsg = "Warning! Error:\n\n";
for (i = 0; i < errorList.length; i++) {
errorMsg += errorText[errorList[i]] + "\n";
}
alert(errorMsg);
return false;
}
else {
return false;
}
}
function text1Change()
{
 /*a=document.getElementById("comment").value.length;
 if((a)>11){document.form1.t2.value=0; 
 }else{document.form1.t2.value=11-a; }
*/

}
</script>
{/literal}
{/if}


{include file='footer.tpl'}