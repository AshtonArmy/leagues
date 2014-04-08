{include file='header.tpl' noSidebar=true}
    <!-- styles -->
    <link href="/builder/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
     
		td.center-align, th.center-align {
			text-align:center;
		}
		td.center-align ul>li {
			text-align:left;
		}
		td.right-align, th.right-align {
			text-align:right;
		}
		.table td {
			vertical-align: middle;
		}
		.table {
			padding 2px 3px;
		}
		#boosts select {
			float:left;
			margin-right:5px;
		}
		#shareform {
			padding-left:29px;
		}
    </style>


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


{*
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">NHL 14 EASHL Player Builder</a>
          <div class="nav-collapse">
            <ul class="nav">
			  <li class="active"><a href="/builder/">New Build</a></li>
			  <li><a href="http://pixelhockey.net/">pixel hockey home</a></li>
              <li><a href="http://twitter.com/jaarons">@jaarons</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
*}
    <div class="">

	<div >
	<! -- tabs --->
		<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#build" data-toggle="tab">Builder</a></li>
			<li><a href="#share" data-toggle="tab">Share</a></li>
			{*<li><a href="#notes" data-toggle="tab">Notes/About</a></li>*}
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="build">
				<form action="" class="well form-inline">
					<label>Player type: &nbsp;</label>
					<select id="player_type" class="span2" onchange="load_player();">
						<option value="PLY">Playmaker</option>
						<option value="SNP">Sniper</option>
						<option value="PWF">Power Forward</option>
						<option value="TWF">Two-Way Forward</option>
						<option value="GRN">Grinder</option>
						<option value="TGH">Tough Guy</option>
						<option value="DFD">Defensive D-man</option>
						<option value="OFD">Offensive D-man</option>
						<option value="TGD">Tough Guy D-man</option>
						<option value="TWD">Two-Way D-man</option></select> &nbsp; 
					<label>Card Level: &nbsp;</label><select id="card_type" class="span2" onchange="change_card();">
						<option value="500">Amateur 1</option>
						<option value="560">Amateur 2</option>
						<option value="640">Amateur 3</option>	
						<option value="730">Rookie 1</option>
						<option value="820">Rookie 2</option>
						<option value="910">Rookie 3</option>
						<option value="1010">Pro 1</option>
						<option value="1110">Pro 2</option>
						<option value="1210">Pro 3</option>
						<option value="1330">Veteran 1</option>
						<option value="1450">Veteran 2</option>
						<option value="1570">Veteran 3</option>
						<option value="1710">Superstar 1</option>
						<option value="1850">Superstar 2</option>
						<option value="1990">Superstar 3</option>
						<option value="2160">Legend 1</option>
						<option value="2330">Legend 2</option>
						<option value="2500">Legend 3</option></select> &nbsp; <label>XP: &nbsp;</label> <input type="text" class="input-small" id="xp" value="500">
				</form>
			<div>
				<div id="offense">
				<h2>Offensive Attributes</h2>
				<div class="btn-toolbar">
					<div class="btn-group">
						<a class="btn btn-info disabled">XP Used:</a>
						<a class="btn disabled" id="off_xp_used">0</a>
					</div>
					<div class="btn-group">
						<a class="btn btn-info disabled">XP Remaining:</a>
						<a class="btn disabled" id="off_xp_rem">500</a>
					</div>
					<div class="btn-group">
						<a class="btn btn-info disabled">Overall:</a>
						<a class="btn disabled" id="off_overall">67</a>
					</div>
				</div>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
					<tr>
						<th width="156" rel="tooltip" title="Attribute Name">Attribute</th>
						<th width="63"  class="center-align" rel="tooltip" title="Base rating for this player type">Base</th>
						<th width="63"  class="center-align" rel="tooltip" title="How many points you can buy before XP cost goes up">CostX</th>
						<th width="63"  class="center-align" rel="tooltip" title="XP needed for the next point">Next Cost</th>
						<th width="118" class="center-align" rel="tooltip" title="How many points to assign to this attribute">Value</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total XP cost for these points">XP Used</th>
						<th width="63"  class="center-align" rel="tooltip" title="Max rating allowed under this player type">Cap</th>
						<th width="63"  class="center-align" rel="tooltip" title="Points added via equipment boosts">Boost</th>
						<th width="63"  class="center-align" rel="tooltip" title="Average XP value for boost points">ABV</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total XP value for boost points">TBV</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total attribute rating: base + assigned points + boost">Total</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td width="156">Deking</td>
						<td width="63"   class="center-align"><span id="dek_base_value">75</span></td>
						<td width="63"   class="center-align"><span id="dek_cost_multi">10</span></td>
						<td width="63"   class="center-align"><span id="dek_next_cost">10</span></td>
						<td width="119"  class="center-align"><i class="icon-minus remxp" name="dek"></i><input style="width:20px; text-align:center;" type="text" value="0" id="dek_qty" onblur="calc_xp('dek');"><i class="icon-plus addxp" name="dek"></i></td>
						<td width="63"   class="center-align"><span id="dek_total_xp">0</span></td>
						<td width="63"   class="center-align"><span id="dek_total_cap">0</span></td>
						<td width="63"   class="center-align"><span id="dek_boost_amt">0</span></td>
						<td width="63"   class="center-align"><span id="dek_boost_avg">0</span></td>
						<td width="63"   class="center-align"><span id="dek_boost_total">0</span></td>
						<td width="63"   class="center-align"><span id="dek_total">0</span></td>
					</tr>
					<tr>
						<td>Hand-Eye</td>
						<td class="center-align"><span id="han_base_value">75</span></td>
						<td class="center-align"><span id="han_cost_multi">10</span></td>
						<td class="center-align"><span id="han_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="han"></i><input style="width:20px; text-align:center;" type="text" value="0" id="han_qty" onblur="calc_xp('han');"><i class="icon-plus addxp" name='han'></i></td>
						<td class="center-align"><span id="han_total_xp">0</span></td>
						<td class="center-align"><span id="han_total_cap">0</span></td>
						<td class="center-align"><span id="han_boost_amt">0</span></td>
						<td class="center-align"><span id="han_boost_avg">0</span></td>
						<td class="center-align"><span id="han_boost_total">0</span></td>
						<td class="center-align"><span id="han_total">0</span></td>
					</tr>
					<tr>
						<td>Off. Awareness</td>
						<td class="center-align"><span id="ofa_base_value">75</span></td>
						<td class="center-align"><span id="ofa_cost_multi">10</span></td>
						<td class="center-align"><span id="ofa_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="ofa"></i><input style="width:20px; text-align:center;" type="text" value="0" id="ofa_qty" onblur="calc_xp('ofa');"><i class="icon-plus addxp" name="ofa"></i></td>
						<td class="center-align"><span id="ofa_total_xp">0</span></td>
						<td class="center-align"><span id="ofa_total_cap">0</span></td>
						<td class="center-align"><span id="ofa_boost_amt">0</span></td>
						<td class="center-align"><span id="ofa_boost_avg">0</span></td>
						<td class="center-align"><span id="ofa_boost_total">0</span></td>
						<td class="center-align"><span id="ofa_total">0</span></td>
					</tr>
					<tr>
						<td>Passing</td>
						<td class="center-align"><span id="pas_base_value">75</span></td>
						<td class="center-align"><span id="pas_cost_multi">10</span></td>
						<td class="center-align"><span id="pas_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="pas"></i><input style="width:20px; text-align:center;" type="text" value="0" id="pas_qty" onblur="calc_xp('pas');"><i class="icon-plus addxp" name="pas"></i></td>
						<td class="center-align"><span id="pas_total_xp">0</span></td>
						<td class="center-align"><span id="pas_total_cap">0</span></td>
						<td class="center-align"><span id="pas_boost_amt">0</span></td>
						<td class="center-align"><span id="pas_boost_avg">0</span></td>
						<td class="center-align"><span id="pas_boost_total">0</span></td>
						<td class="center-align"><span id="pas_total">0</span></td>
					</tr>
					<tr>
						<td>Puck Control</td>
						<td class="center-align"><span id="puc_base_value">75</span></td>
						<td class="center-align"><span id="puc_cost_multi">10</span></td>
						<td class="center-align"><span id="puc_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="puc"></i><input style="width:20px; text-align:center;" type="text" value="0" id="puc_qty" onblur="calc_xp('puc');"><i class="icon-plus addxp" name="puc"></i></td>
						<td class="center-align"><span id="puc_total_xp">0</span></td>
						<td class="center-align"><span id="puc_total_cap">0</span></td>
						<td class="center-align"><span id="puc_boost_amt">0</span></td>
						<td class="center-align"><span id="puc_boost_avg">0</span></td>
						<td class="center-align"><span id="puc_boost_total">0</span></td>
						<td class="center-align"><span id="puc_total">0</span></td>
					</tr>
					<tr>
						<td>SS Accuracy</td>
						<td class="center-align"><span id="ssa_base_value">75</span></td>
						<td class="center-align"><span id="ssa_cost_multi">10</span></td>
						<td class="center-align"><span id="ssa_next_cost">10</span></td>
						<td class="center-align">
							<i class="icon-minus remxp" name="ssa"></i>
							<input style="width:20px; text-align:center;" type="text" value="0" id="ssa_qty" onblur="calc_xp('ssa');">
							<i class="icon-plus addxp" name="ssa"></i>
						</td>
						<td class="center-align"><span id="ssa_total_xp">0</span></td>
						<td class="center-align"><span id="ssa_total_cap">0</span></td>
						<td class="center-align"><span id="ssa_boost_amt">0</span></td>
						<td class="center-align"><span id="ssa_boost_avg">0</span></td>
						<td class="center-align"><span id="ssa_boost_total">0</span></td>
						<td class="center-align"><span id="ssa_total">0</span></td>
					</tr>
					<tr>
						<td>SS Power</td>
						<td class="center-align"><span id="ssp_base_value">75</span></td>
						<td class="center-align"><span id="ssp_cost_multi">10</span></td>
						<td class="center-align"><span id="ssp_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="ssp"></i><input style="width:20px; text-align:center;" type="text" value="0" id="ssp_qty" onblur="calc_xp('ssp');"><i class="icon-plus addxp" name="ssp"></i></td>
						<td class="center-align"><span id="ssp_total_xp">0</span></td>
						<td class="center-align"><span id="ssp_total_cap">0</span></td>
						<td class="center-align"><span id="ssp_boost_amt">0</span></td>
						<td class="center-align"><span id="ssp_boost_avg">0</span></td>
						<td class="center-align"><span id="ssp_boost_total">0</span></td>
						<td class="center-align"><span id="ssp_total">0</span></td>
					</tr>
					<tr>
						<td>WS Accuracy</td>
						<td class="center-align"><span id="wsa_base_value">75</span></td>
						<td class="center-align"><span id="wsa_cost_multi">10</span></td>
						<td class="center-align"><span id="wsa_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="wsa"></i><input style="width:20px; text-align:center;" type="text" value="0" id="wsa_qty" onblur="calc_xp('wsa');"><i class="icon-plus addxp" name="wsa"></i></td>
						<td class="center-align"><span id="wsa_total_xp">0</span></td>
						<td class="center-align"><span id="wsa_total_cap">0</span></td>
						<td class="center-align"><span id="wsa_boost_amt">0</span></td>
						<td class="center-align"><span id="wsa_boost_avg">0</span></td>
						<td class="center-align"><span id="wsa_boost_total">0</span></td>
						<td class="center-align"><span id="wsa_total">0</span></td>
					</tr>
					<tr>
						<td>WS Power</td>
						<td class="center-align"><span id="wsp_base_value">75</span></td>
						<td class="center-align"><span id="wsp_cost_multi">10</span></td>
						<td class="center-align"><span id="wsp_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="wsp"></i><input style="width:20px; text-align:center;" type="text" value="0" id="wsp_qty" onblur="calc_xp('wsp');"><i class="icon-plus addxp" name="wsp"></i></td>
						<td class="center-align"><span id="wsp_total_xp">0</span></td>
						<td class="center-align"><span id="wsp_total_cap">0</span></td>
						<td class="center-align"><span id="wsp_boost_amt">0</span></td>
						<td class="center-align"><span id="wsp_boost_avg">0</span></td>
						<td class="center-align"><span id="wsp_boost_total">0</span></td>
						<td class="center-align"><span id="wsp_total">0</span></td>
					</tr>
					</tbody>
					</table>
				</div>
				<div id="defense">
					<h2>Defensive Attributes</h2>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a class="btn btn-info disabled">XP Used:</a>
							<a class="btn disabled" id="def_xp_used">0</a>
						</div>
						<div class="btn-group">
							<a class="btn btn-info disabled">XP Remaining:</a>
							<a class="btn disabled" id="def_xp_rem">500</a>
						</div>
							<div class="btn-group">
								<a class="btn btn-info disabled">Overall:</a>
								<a class="btn disabled" id="def_overall">67</a>
							</div>
					</div>
					<table class="table table-bordered table-striped table-condensed">
					<thead>
					<tr>
						<th width="156" rel="tooltip" title="Attribute Name">Attribute</th>
						<th width="63"  class="center-align" rel="tooltip" title="Base rating for this player type">Base</th>
						<th width="63"  class="center-align" rel="tooltip" title="How many points you can buy before XP cost goes up">CostX</th>
						<th width="63"  class="center-align" rel="tooltip" title="XP needed for the next point">Next Cost</th>
						<th width="118" class="center-align" rel="tooltip" title="How many points to assign to this attribute">Value</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total XP cost for these points">XP Used</th>
						<th width="63"  class="center-align" rel="tooltip" title="Max rating allowed under this player type">Cap</th>
						<th width="63"  class="center-align" rel="tooltip" title="Points added via equipment boosts">Boost</th>
						<th width="63"  class="center-align" rel="tooltip" title="Average XP value for boost points">ABV</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total XP value for boost points">TBV</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total attribute rating: base + assigned points + boost">Total</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td width="156" >Aggressiveness</td>
						<td width="63"   class="center-align"><span id="agg_base_value">75</span></td>
						<td width="63"   class="center-align"><span id="agg_cost_multi">10</span></td>
						<td width="63"   class="center-align"><span id="agg_next_cost">10</span></td>
						<td width="118"  class="center-align"><i class="icon-minus remxp" name="agg"></i><input style="width:20px; text-align:center;" type="text" value="0" id="agg_qty" onblur="calc_xp('agg');"><i class="icon-plus addxp" name="agg"></i></td>
						<td width="63"   class="center-align"><span id="agg_total_xp">0</span></td>
						<td width="63"   class="center-align"><span id="agg_total_cap">0</span></td>
						<td width="63"   class="center-align"><span id="agg_boost_amt">0</span></td>
						<td width="63"   class="center-align"><span id="agg_boost_avg">0</span></td>
						<td width="63"   class="center-align"><span id="agg_boost_total">0</span></td>
						<td width="63"   class="center-align"><span id="agg_total">0</span></td>
					</tr>
					<tr>
						<td>Body Checking</td>
						<td class="center-align"><span id="bod_base_value">75</span></td>
						<td class="center-align"><span id="bod_cost_multi">10</span></td>
						<td class="center-align"><span id="bod_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="bod"></i><input style="width:20px; text-align:center;" type="text" value="0" id="bod_qty" onblur="calc_xp('bod');"><i class="icon-plus addxp" name="bod"></i></td>
						<td class="center-align"><span id="bod_total_xp">0</span></td>
						<td class="center-align"><span id="bod_total_cap">0</span></td>
						<td class="center-align"><span id="bod_boost_amt">0</span></td>
						<td class="center-align"><span id="bod_boost_avg">0</span></td>
						<td class="center-align"><span id="bod_boost_total">0</span></td>
						<td class="center-align"><span id="bod_total">0</span></td>
					</tr>
					<tr>
						<td>Def. Awareness</td>
						<td class="center-align"><span id="dfa_base_value">75</span></td>
						<td class="center-align"><span id="dfa_cost_multi">10</span></td>
						<td class="center-align"><span id="dfa_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="dfa"></i><input style="width:20px; text-align:center;" type="text" value="0" id="dfa_qty" onblur="calc_xp('dfa');"><i class="icon-plus addxp" name="dfa"></i></td>
						<td class="center-align"><span id="dfa_total_xp">0</span></td>
						<td class="center-align"><span id="dfa_total_cap">0</span></td>
						<td class="center-align"><span id="dfa_boost_amt">0</span></td>
						<td class="center-align"><span id="dfa_boost_avg">0</span></td>
						<td class="center-align"><span id="dfa_boost_total">0</span></td>
						<td class="center-align"><span id="dfa_total">0</span></td>
					</tr>
					<tr>
						<td>Discipline</td>
						<td class="center-align"><span id="dis_base_value">75</span></td>
						<td class="center-align"><span id="dis_cost_multi">10</span></td>
						<td class="center-align"><span id="dis_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="dis"></i><input style="width:20px; text-align:center;" type="text" value="0" id="dis_qty" onblur="calc_xp('dis');"><i class="icon-plus addxp" name="dis"></i></td>
						<td class="center-align"><span id="dis_total_xp">0</span></td>
						<td class="center-align"><span id="dis_total_cap">0</span></td>
						<td class="center-align"><span id="dis_boost_amt">0</span></td>
						<td class="center-align"><span id="dis_boost_avg">0</span></td>
						<td class="center-align"><span id="dis_boost_total">0</span></td>
						<td class="center-align"><span id="dis_total">0</span></td>
					</tr>
					<tr>
						<td>Faceoffs</td>
						<td class="center-align"><span id="fac_base_value">75</span></td>
						<td class="center-align"><span id="fac_cost_multi">10</span></td>
						<td class="center-align"><span id="fac_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="fac"></i><input style="width:20px; text-align:center;" type="text" value="0" id="fac_qty" onblur="calc_xp('fac');"><i class="icon-plus addxp" name="fac"></i></td>
						<td class="center-align"><span id="fac_total_xp">0</span></td>
						<td class="center-align"><span id="fac_total_cap">0</span></td>
						<td class="center-align"><span id="fac_boost_amt">0</span></td>
						<td class="center-align"><span id="fac_boost_avg">0</span></td>
						<td class="center-align"><span id="fac_boost_total">0</span></td>
						<td class="center-align"><span id="fac_total">0</span></td>
					</tr>
					<tr>
						<td>Fighting Skill</td>
						<td class="center-align"><span id="fsk_base_value">75</span></td>
						<td class="center-align"><span id="fsk_cost_multi">10</span></td>
						<td class="center-align"><span id="fsk_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="fsk"></i><input style="width:20px; text-align:center;" type="text" value="0" id="fsk_qty" onblur="calc_xp('fsk');"><i class="icon-plus addxp" name="fsk"></i></td>
						<td class="center-align"><span id="fsk_total_xp">0</span></td>
						<td class="center-align"><span id="fsk_total_cap">0</span></td>
						<td class="center-align"><span id="fsk_boost_amt">0</span></td>
						<td class="center-align"><span id="fsk_boost_avg">0</span></td>
						<td class="center-align"><span id="fsk_boost_total">0</span></td>
						<td class="center-align"><span id="fsk_total">0</span></td>
					</tr>
					<tr>
						<td>Shot Blocking</td>
						<td class="center-align"><span id="sbl_base_value">75</span></td>
						<td class="center-align"><span id="sbl_cost_multi">10</span></td>
						<td class="center-align"><span id="sbl_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="sbl"></i><input style="width:20px; text-align:center;" type="text" value="0" id="sbl_qty" onblur="calc_xp('sbl');"><i class="icon-plus addxp" name="sbl"></i></td>
						<td class="center-align"><span id="sbl_total_xp">0</span></td>
						<td class="center-align"><span id="sbl_total_cap">0</span></td>
						<td class="center-align"><span id="sbl_boost_amt">0</span></td>
						<td class="center-align"><span id="sbl_boost_avg">0</span></td>
						<td class="center-align"><span id="sbl_boost_total">0</span></td>
						<td class="center-align"><span id="sbl_total">0</span></td>
					</tr>
					<tr>
						<td>Stick Checking</td>
						<td class="center-align"><span id="sti_base_value">75</span></td>
						<td class="center-align"><span id="sti_cost_multi">10</span></td>
						<td class="center-align"><span id="sti_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="sti"></i><input style="width:20px; text-align:center;" type="text" value="0" id="sti_qty" onblur="calc_xp('sti');"><i class="icon-plus addxp" name="sti"></i></td>
						<td class="center-align"><span id="sti_total_xp">0</span></td>
						<td class="center-align"><span id="sti_total_cap">0</span></td>
						<td class="center-align"><span id="sti_boost_amt">0</span></td>
						<td class="center-align"><span id="sti_boost_avg">0</span></td>
						<td class="center-align"><span id="sti_boost_total">0</span></td>
						<td class="center-align"><span id="sti_total">0</span></td>
					</tr>
					</tbody>
					</table>
				</div>
				<div id="athletic">
					<h2>Athleticism Attributes</h2>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a class="btn btn-info disabled">XP Used:</a>
							<a class="btn disabled" id="ath_xp_used">0</a>
						</div>
						<div class="btn-group">
							<a class="btn btn-info disabled">XP Remaining:</a>
							<a class="btn disabled" id="ath_xp_rem">500</a>
						</div>
							<div class="btn-group">
								<a class="btn btn-info disabled">Overall:</a>
								<a class="btn disabled" id="ath_overall">67</a>
							</div>
					</div>
					<table class="table table-bordered table-striped table-condensed">
					<thead>
					<tr>
						<th width="156" rel="tooltip" title="Attribute Name">Attribute</th>
						<th width="63"  class="center-align" rel="tooltip" title="Base rating for this player type">Base</th>
						<th width="63"  class="center-align" rel="tooltip" title="How many points you can buy before XP cost goes up">CostX</th>
						<th width="63"  class="center-align" rel="tooltip" title="XP needed for the next point">Next Cost</th>
						<th width="118" class="center-align" rel="tooltip" title="How many points to assign to this attribute">Value</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total XP cost for these points">XP Used</th>
						<th width="63"  class="center-align" rel="tooltip" title="Max rating allowed under this player type">Cap</th>
						<th width="63"  class="center-align" rel="tooltip" title="Points added via equipment boosts">Boost</th>
						<th width="63"  class="center-align" rel="tooltip" title="Average XP value for boost points">ABV</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total XP value for boost points">TBV</th>
						<th width="63"  class="center-align" rel="tooltip" title="Total attribute rating: base + assigned points + boost">Total</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td width="156" >Acceleration</td>
						<td width="63"   class="center-align"><span id="acc_base_value">75</span></td>
						<td width="63"   class="center-align"><span id="acc_cost_multi">10</span></td>
						<td width="63"   class="center-align"><span id="acc_next_cost">10</span></td>
						<td width="118"  class="center-align"><i class="icon-minus remxp" name="acc"></i><input style="width:20px; text-align:center;" type="text" value="0" id="acc_qty" onblur="calc_xp('acc');"><i class="icon-plus addxp" name="acc"></i></td>
						<td width="63"   class="center-align"><span id="acc_total_xp">0</span></td>
						<td width="63"   class="center-align"><span id="acc_total_cap">0</span></td>
						<td width="63"   class="center-align"><span id="acc_boost_amt">0</span></td>
						<td width="63"   class="center-align"><span id="acc_boost_avg">0</span></td>
						<td width="63"   class="center-align"><span id="acc_boost_total">0</span></td>
						<td width="63"   class="center-align"><span id="acc_total">0</span></td>
					</tr>
					<tr>
						<td>Agility</td>
						<td class="center-align"><span id="agi_base_value">75</span></td>
						<td class="center-align"><span id="agi_cost_multi">10</span></td>
						<td class="center-align"><span id="agi_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="agi"></i><input style="width:20px; text-align:center;" type="text" value="0" id="agi_qty" onblur="calc_xp('agi');"><i class="icon-plus addxp" name="agi"></i></td>
						<td class="center-align"><span id="agi_total_xp">0</span></td>
						<td class="center-align"><span id="agi_total_cap">0</span></td>
						<td class="center-align"><span id="agi_boost_amt">0</span></td>
						<td class="center-align"><span id="agi_boost_avg">0</span></td>
						<td class="center-align"><span id="agi_boost_total">0</span></td>
						<td class="center-align"><span id="agi_total">0</span></td>
					</tr>
					<tr>
						<td>Balance</td>
						<td class="center-align"><span id="bal_base_value">75</span></td>
						<td class="center-align"><span id="bal_cost_multi">10</span></td>
						<td class="center-align"><span id="bal_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="bal"></i><input style="width:20px; text-align:center;" type="text" value="0" id="bal_qty" onblur="calc_xp('bal');"><i class="icon-plus addxp" name="bal"></i></td>
						<td class="center-align"><span id="bal_total_xp">0</span></td>
						<td class="center-align"><span id="bal_total_cap">0</span></td>
						<td class="center-align"><span id="bal_boost_amt">0</span></td>
						<td class="center-align"><span id="bal_boost_avg">0</span></td>
						<td class="center-align"><span id="bal_boost_total">0</span></td>
						<td class="center-align"><span id="bal_total">0</span></td>
					</tr>
					<tr>
						<td>Durability</td>
						<td class="center-align"><span id="dur_base_value">75</span></td>
						<td class="center-align"><span id="dur_cost_multi">10</span></td>
						<td class="center-align"><span id="dur_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="dur"></i><input style="width:20px; text-align:center;" type="text" value="0" id="dur_qty" onblur="calc_xp('dur');"><i class="icon-plus addxp" name="dur"></i></td>
						<td class="center-align"><span id="dur_total_xp">0</span></td>
						<td class="center-align"><span id="dur_total_cap">0</span></td>
						<td class="center-align"><span id="dur_boost_amt">0</span></td>
						<td class="center-align"><span id="dur_boost_avg">0</span></td>
						<td class="center-align"><span id="dur_boost_total">0</span></td>
						<td class="center-align"><span id="dur_total">0</span></td>
					</tr>
					<tr>
						<td>Endurance</td>
						<td class="center-align"><span id="end_base_value">75</span></td>
						<td class="center-align"><span id="end_cost_multi">10</span></td>
						<td class="center-align"><span id="end_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="end"></i><input style="width:20px; text-align:center;" type="text" value="0" id="end_qty" onblur="calc_xp('end');"><i class="icon-plus addxp" name="end"></i></td>
						<td class="center-align"><span id="end_total_xp">0</span></td>
						<td class="center-align"><span id="end_total_cap">0</span></td>
						<td class="center-align"><span id="end_boost_amt">0</span></td>
						<td class="center-align"><span id="end_boost_avg">0</span></td>
						<td class="center-align"><span id="end_boost_total">0</span></td>
						<td class="center-align"><span id="end_total">0</span></td>
					</tr>
					<tr>
						<td>Speed</td>
						<td class="center-align"><span id="spd_base_value">75</span></td>
						<td class="center-align"><span id="spd_cost_multi">10</span></td>
						<td class="center-align"><span id="spd_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="spd"></i><input style="width:20px; text-align:center;" type="text" value="0" id="spd_qty" onblur="calc_xp('spd');"><i class="icon-plus addxp" name="spd"></i></td>
						<td class="center-align"><span id="spd_total_xp">0</span></td>
						<td class="center-align"><span id="spd_total_cap">0</span></td>
						<td class="center-align"><span id="spd_boost_amt">0</span></td>
						<td class="center-align"><span id="spd_boost_avg">0</span></td>
						<td class="center-align"><span id="spd_boost_total">0</span></td>
						<td class="center-align"><span id="spd_total">0</span></td>
					</tr>
					<tr>
						<td>Strength</td>
						<td class="center-align"><span id="str_base_value">75</span></td>
						<td class="center-align"><span id="str_cost_multi">10</span></td>
						<td class="center-align"><span id="str_next_cost">10</span></td>
						<td class="center-align"><i class="icon-minus remxp" name="str"></i><input style="width:20px; text-align:center;" type="text" value="0" id="str_qty" onblur="calc_xp('str');"><i class="icon-plus addxp" name="str"></i></td>
						<td class="center-align"><span id="str_total_xp">0</span></td>
						<td class="center-align"><span id="str_total_cap">0</span></td>
						<td class="center-align"><span id="str_boost_amt">0</span></td>
						<td class="center-align"><span id="str_boost_avg">0</span></td>
						<td class="center-align"><span id="str_boost_total">0</span></td>
						<td class="center-align"><span id="str_total">0</span></td>
					</tr>
					</tbody>
					</table>
				</div>
				<div id="boosts">
					<h2>Equipment Boosts</h2>
					<table class="table">
						<thead>
							<th>&nbsp;</th>
							<th>Slot 1</th>
							<th>Slot 2</th>
							<th>Slot 3</th>
						</thead>
						<tbody>
						<tr>
						<td>Stick</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='stick1'>
									<option value="ofa" selected>Off. Awareness</option>
									<option value='ssa'>SS Accuracy</option>
									<option value='ssp'>SS Power</option>
									<option value='wsa'>WS Accuracy</option>
									<option value='wsp'>WS Power</option>
									<option value='dfa'>Def. Awareness</option>
									<option value='fac'>Faceoffs</option>
									<option value='sti'>Stick Checking</option>
								</select>
								<button id="stick1_btn_3" class="btn btn-small" onmouseup="boost_buttons('stick1',3);">+3</button>
								<button id="stick1_btn_5" class="btn btn-small" onmouseup="boost_buttons('stick1',5);">+5</button>
								<button id="stick1_btn_7" class="btn btn-small" onmouseup="boost_buttons('stick1',7);">+7</button>
							</div><input type="hidden" id="stick1_attr" value="ofa"><input type="hidden" id="stick1_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id="stick2">
									<option value='ofa' selected>Off. Awareness</option>
									<option value='ssa'>SS Accuracy</option>
									<option value='ssp'>SS Power</option>
									<option value='wsa'>WS Accuracy</option>
									<option value='wsp'>WS Power</option>
									<option value='dfa'>Def. Awareness</option>
									<option value='fac'>Faceoffs</option>
									<option value='sti'>Stick Checking</option>
								</select>
								<button id="stick2_btn_3" class="btn btn-small" onmouseup="boost_buttons('stick2',3);">+3</button>
								<button id="stick2_btn_5" class="btn btn-small" onmouseup="boost_buttons('stick2',5);">+5</button>
								<button id="stick2_btn_7" class="btn btn-small" onmouseup="boost_buttons('stick2',7);">+7</button>
							</div><input type="hidden" id="stick2_attr" value="ofa"><input type="hidden" id="stick2_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='stick3'>
									<option value='ofa' selected>Off. Awareness</option>
									<option value='ssa'>SS Accuracy</option>
									<option value='ssp'>SS Power</option>
									<option value='wsa'>WS Accuracy</option>
									<option value='wsp'>WS Power</option>
									<option value='dfa'>Def. Awareness</option>
									<option value='fac'>Faceoffs</option>
									<option value='sti'>Stick Checking</option>
								</select>
								<button id="stick3_btn_3" class="btn btn-small" onmouseup="boost_buttons('stick3',3);">+3</button>
								<button id="stick3_btn_5" class="btn btn-small" onmouseup="boost_buttons('stick3',5);">+5</button>
								<button id="stick3_btn_7" class="btn btn-small" onmouseup="boost_buttons('stick3',7);">+7</button>
							</div><input type="hidden" id="stick3_attr" value="ofa"><input type="hidden" id="stick3_boost_val" value="0">
						</td>
					</tr>	
						<tr>
						<td>Skates</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='skates1'>
									<option value='agg' selected>Aggressiveness</option>
									<option value='bod'>Body Checking</option>
									<option value='fsk'>Fighting Skill</option>
									<option value='acc'>Acceleration</option>
									<option value='agi'>Agility</option>
									<option value='bal'>Balance</option>
									<option value='end'>Endurance</option>
									<option value='spd'>Speed</option>
								</select>
								<button id="skates1_btn_3" class="btn btn-small" onmouseup="boost_buttons('skates1',3);">+3</button>
								<button id="skates1_btn_5" class="btn btn-small" onmouseup="boost_buttons('skates1',5);">+5</button>
								<button id="skates1_btn_7" class="btn btn-small" onmouseup="boost_buttons('skates1',7);">+7</button>
							</div><input type="hidden" id="skates1_attr" value="agg"><input type="hidden" id="skates1_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='skates2'>
									<option value='agg' selected>Aggressiveness</option>
									<option value='bod'>Body Checking</option>
									<option value='fsk'>Fighting Skill</option>
									<option value='acc'>Acceleration</option>
									<option value='agi'>Agility</option>
									<option value='bal'>Balance</option>
									<option value='end'>Endurance</option>
									<option value='spd'>Speed</option>
								</select>
									<button id="skates2_btn_3" class="btn btn-small" onmouseup="boost_buttons('skates2',3);">+3</button>
									<button id="skates2_btn_5" class="btn btn-small" onmouseup="boost_buttons('skates2',5);">+5</button>
									<button id="skates2_btn_7" class="btn btn-small" onmouseup="boost_buttons('skates2',7);">+7</button>
								</div><input type="hidden" id="skates2_attr" value="agg"><input type="hidden" id="skates2_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='skates3'>
										<option value='agg' selected>Aggressiveness</option>
										<option value='bod'>Body Checking</option>
										<option value='fsk'>Fighting Skill</option>
										<option value='acc'>Acceleration</option>
										<option value='agi'>Agility</option>
										<option value='bal'>Balance</option>
										<option value='end'>Endurance</option>
										<option value='spd'>Speed</option>
								</select>
									<button id="skates3_btn_3" class="btn btn-small" onmouseup="boost_buttons('skates3',3);">+3</button>
									<button id="skates3_btn_5" class="btn btn-small" onmouseup="boost_buttons('skates3',5);">+5</button>
									<button id="skates3_btn_7" class="btn btn-small" onmouseup="boost_buttons('skates3',7);">+7</button>
								</div><input type="hidden" id="skates3_attr" value="agg"><input type="hidden" id="skates3_boost_val" value="0">
						</td>
					</tr>	
						<tr>
						<td>Helmet</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='helmet1'>
										<option value='dek' selected>Deking</option>
										<option value='han'>Hand-Eye</option>
										<option value='ofa'>Off. Awareness</option>
										<option value='pas'>Passing</option>
										<option value='puc'>Puck Control</option>
										<option value='ssa'>SS Accuracy</option>
										<option value='ssp'>SS Power</option>
										<option value='wsa'>WS Accuracy</option>
										<option value='wsp'>WS Power</option>
										<option value='agg'>Aggressiveness</option>
										<option value='bod'>Body Checking</option>
										<option value='dfa'>Def. Awareness</option>
										<option value='dis'>Discipline</option>
										<option value='fac'>Faceoffs</option>
										<option value='fsk'>Fighting Skill</option>
										<option value='sbl'>Shot Blocking</option>
										<option value='sti'>Stick Checking</option>
										<option value='acc'>Acceleration</option>
										<option value='agi'>Agility</option>
										<option value='bal'>Balance</option>
										<option value='dur'>Durability</option>
										<option value='end'>Endurance</option>
										<option value='str'>Strength</option>
									</select>
									<button id="helmet1_btn_3" class="btn btn-small" onmouseup="boost_buttons('helmet1',3);">+3</button>
									<button id="helmet1_btn_5" class="btn btn-small" onmouseup="boost_buttons('helmet1',5);">+5</button>
									<button id="helmet1_btn_7" class="btn btn-small" onmouseup="boost_buttons('helmet1',7);">+7</button>
								</div><input type="hidden" id="helmet1_attr" value="dek"><input type="hidden" id="helmet1_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='helmet2'>
											<option value='dek' selected>Deking</option>
											<option value='han'>Hand-Eye</option>
											<option value='ofa'>Off. Awareness</option>
											<option value='pas'>Passing</option>
											<option value='puc'>Puck Control</option>
											<option value='ssa'>SS Accuracy</option>
											<option value='ssp'>SS Power</option>
											<option value='wsa'>WS Accuracy</option>
											<option value='wsp'>WS Power</option>
											<option value='agg'>Aggressiveness</option>
											<option value='bod'>Body Checking</option>
											<option value='dfa'>Def. Awareness</option>
											<option value='dis'>Discipline</option>
											<option value='fac'>Faceoffs</option>
											<option value='fsk'>Fighting Skill</option>
											<option value='sbl'>Shot Blocking</option>
											<option value='sti'>Stick Checking</option>
											<option value='acc'>Acceleration</option>
											<option value='agi'>Agility</option>
											<option value='bal'>Balance</option>
											<option value='dur'>Durability</option>
											<option value='end'>Endurance</option>
											<option value='str'>Strength</option>
										</select>
									<button id="helmet2_btn_3" class="btn btn-small" onmouseup="boost_buttons('helmet2',3);">+3</button>
									<button id="helmet2_btn_5" class="btn btn-small" onmouseup="boost_buttons('helmet2',5);">+5</button>
									<button id="helmet2_btn_7" class="btn btn-small" onmouseup="boost_buttons('helmet2',7);">+7</button>
								</div><input type="hidden" id="helmet2_attr" value="dek"><input type="hidden" id="helmet2_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='helmet3'>
											<option value='dek' selected>Deking</option>
											<option value='han'>Hand-Eye</option>
											<option value='ofa'>Off. Awareness</option>
											<option value='pas'>Passing</option>
											<option value='puc'>Puck Control</option>
											<option value='ssa'>SS Accuracy</option>
											<option value='ssp'>SS Power</option>
											<option value='wsa'>WS Accuracy</option>
											<option value='wsp'>WS Power</option>
											<option value='agg'>Aggressiveness</option>
											<option value='bod'>Body Checking</option>
											<option value='dfa'>Def. Awareness</option>
											<option value='dis'>Discipline</option>
											<option value='fac'>Faceoffs</option>
											<option value='fsk'>Fighting Skill</option>
											<option value='sbl'>Shot Blocking</option>
											<option value='sti'>Stick Checking</option>
											<option value='acc'>Acceleration</option>
											<option value='agi'>Agility</option>
											<option value='bal'>Balance</option>
											<option value='dur'>Durability</option>
											<option value='end'>Endurance</option>
											<option value='str'>Strength</option>
										</select>
									<button id="helmet3_btn_3" class="btn btn-small" onmouseup="boost_buttons('helmet3',3);">+3</button>
									<button id="helmet3_btn_5" class="btn btn-small" onmouseup="boost_buttons('helmet3',5);">+5</button>
									<button id="helmet3_btn_7" class="btn btn-small" onmouseup="boost_buttons('helmet3',7);">+7</button>
								</div><input type="hidden" id="helmet3_attr" value="dek"><input type="hidden" id="helmet3_boost_val" value="0">
						</td>
					</tr>	
						<tr>
						<td>Gloves</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='gloves1'>
										<option value='dek' selected>Deking</option>
										<option value='han'>Hand-Eye</option>
										<option value='pas'>Passing</option>
										<option value='puc'>Puck Control</option>
										<option value='dis'>Discipline</option>
										<option value='sbl'>Shot Blocking</option>
										<option value='dur'>Durability</option>
										<option value='str'>Strength</option>
									</select>
									<button id="gloves1_btn_3" class="btn btn-small" onmouseup="boost_buttons('gloves1',3);">+3</button>
									<button id="gloves1_btn_5" class="btn btn-small" onmouseup="boost_buttons('gloves1',5);">+5</button>
									<button id="gloves1_btn_7" class="btn btn-small" onmouseup="boost_buttons('gloves1',7);">+7</button>
								</div><input type="hidden" id="gloves1_attr" value="dek"><input type="hidden" id="gloves1_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='gloves2'>
										<option value='dek' selected>Deking</option>
										<option value='han'>Hand-Eye</option>
										<option value='pas'>Passing</option>
										<option value='puc'>Puck Control</option>
										<option value='dis'>Discipline</option>
										<option value='sbl'>Shot Blocking</option>
										<option value='dur'>Durability</option>
										<option value='str'>Strength</option>
									</select>
									<button id="gloves2_btn_3" class="btn btn-small" onmouseup="boost_buttons('gloves2',3);">+3</button>
									<button id="gloves2_btn_5" class="btn btn-small" onmouseup="boost_buttons('gloves2',5);">+5</button>
									<button id="gloves2_btn_7" class="btn btn-small" onmouseup="boost_buttons('gloves2',7);">+7</button>
								</div><input type="hidden" id="gloves2_attr" value="dek"><input type="hidden" id="gloves2_boost_val" value="0">
						</td>
						<td>
							<div class="btn-group">
								<select class="span6 boost" id='gloves3'>
										<option value='dek' selected>Deking</option>
										<option value='han'>Hand-Eye</option>
										<option value='pas'>Passing</option>
										<option value='puc'>Puck Control</option>
										<option value='dis'>Discipline</option>
										<option value='sbl'>Shot Blocking</option>
										<option value='dur'>Durability</option>
										<option value='str'>Strength</option>
									</select>
									<button id="gloves3_btn_3" class="btn btn-small" onmouseup="boost_buttons('gloves3',3);">+3</button>
									<button id="gloves3_btn_5" class="btn btn-small" onmouseup="boost_buttons('gloves3',5);">+5</button>
									<button id="gloves3_btn_7" class="btn btn-small" onmouseup="boost_buttons('gloves3',7);">+7</button>
								</div><input type="hidden" id="gloves3_attr" value="dek"><input type="hidden" id="gloves3_boost_val" value="0">
						</td>
					</tr>
					</tbody>
					</table>
				
				</div>
			</div>
		</div>
			<div class="tab-pane" id="share">
			<div class="row">
				<div class="span3">
					<div class="well sidebar-nav">
						<ul class="nav nav-list">
							<li class="nav-header">Recently Shared Builds</li>
							
	{foreach from=$aBuilds item=oBuild}
		<li><a href="http://virtualsports.ru/params/builder/{$oBuild->getId()}">{$oBuild->getTitle()}</a></li>
	{/foreach}
						</ul>
					</div>
				</div>
				<div class="well span8" id="shareform">
					<div class="row">
						<h2>Share this build</h2>
						<form class="form-inline">
							<input type="button" class="btn btn-primary add-on" value="Generate Link" id="share_button"><input type="text" class="span8" placeholder='http://virtualsports.ru/params/...' id="share_url">
						</form>
					</div>
					<div class="row">
						<h2>Build Details</h2>
						<span class="span4">Text:<br />
						<textarea rows="25" cols="30" id="build_text"></textarea></span>
						<span class="span4">Markdown (Reddit, etc.):<br />
						<textarea rows="25" cols="30" id="build_markdown"></textarea></span>
					</div><!--
					<div class="row">
						<textarea rows="25" cols="60" id="debug">
						</textarea>
					</div>-->
				</div>
			</div> <!-- /row -->
			</div><!-- /tab-pane -->
			{*<div class="tab-pane" id="notes">
				<div class="row">
					<div class="span8">
						<p>I put this together in the interest of having a player creator tool that is freely available and doesn't rely on a free web host. I wanted something where we could easily save and pull builds, share them with others, and so on.</p>
						<p>This is designed with Twitter's Bootstrap framework and the excellent jQuery project. Hooray open source.</p>
						<p>Thanks to <a href="http://aspspider.org/pdat13/Main.aspx" target="_new">pdat13</a> from the EA forums and <a href="http://angrymikegrrrr.github.com/NHL-12-Player-Creator/" target="_new">AngryMike</a> from the OS forums for inspiration. Mike was the first one to make one of these things, and if not for the work he and pdat did I probably wouldn't have made my own player builder. These guys made my work easier.</p>
						<p>Attribute caps and cost increases pulled from NHL 14 Early Release</p>
						<p>If you have any questions, comments, bug reports or feature requests, hit me up on Twitter at <a href="http://twitter.com/jaarons">@jaarons</a>. I may have one of these available for goalies sometime in the future.</p>
					</div>
				</div>
			</div>*}
		</div> <!-- /tab-content -->
		</div> <!-- /tabbable -->
	</div> <!-- /row -->

    </div> <!-- /container -->

    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {*<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-transition.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-alert.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-modal.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-tab.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-popover.js"></script>
    <script src="/builder/bootstrap/js/bootstrap-button.js"></script>*}
	<script src="http://virtualsports.ru/plugins/vs/templates/skin/default/js/vars.js"></script>
	<script src="http://virtualsports.ru/plugins/vs/templates/skin/default/js/functions.js"></script>

	
{if $oBuilder}
<script>
	var load_attributes = {$oBuilder->getAttributes()};
	
	var load_boosts = {$oBuilder->getBoosts()};
	
	jQuery("#player_type").val('{$oBuilder->getPlayerType()}');
	load_player();
	jQuery('#card_type').val({$oBuilder->getXpValue()});
	change_card();
	for(var a=0; a<attributes.length; a++) {
		attr_name = attributes[a][0];
		load_val = load_attributes[a];
		jQuery("#"+attr_name+"_qty").val(load_val);
		calc_xp(attr_name);
	}
	for(var b=0;b<boost_slots.length;b++) {
	
		boost_slot = load_boosts[b][0];
		boost_type = load_boosts[b][1];
		boost_val = load_boosts[b][2];
	
		if(boost_val > 0) {
			jQuery("#" + boost_slot).val(boost_type);
			jQuery("#" + boost_slot + "_attr").val(boost_type);
			boost_buttons(boost_slot, boost_val);
		}
	
	}
	calc_overall();
	
	// fill out share info
	
	player_type = jQuery("#player_type option:selected").text();
	player_short_type = jQuery("#player_type option:selected").val();
	card_type = jQuery("#card_type option:selected").text();
	card_short_type = jQuery("#card_type option:selected").val();
	overall = jQuery("#off_overall").text();
	
	build_title = player_short_type + " - " + card_type + " - " + overall + " OVR";
		
	var text_code = "";
	var markdown_code = "";
	
	markdown_code = player_type + " - " + card_type + "\n\n";
	markdown_code += "|Attribute|Boost|Total|\n" + "|:-|:-:|:-:|\n";
	
	text_code = player_type + " - " + card_type + "\n\n";
	var post_attr = "";
	var post_boosts = "";
	
	for (var i= 0; i < attributes.length; i++) {

		attr_name = attributes[i][0];
		attr_full_name = attributes[i][2];
		
		attr_qty = jQuery("#" + attr_name + "_qty").val();
		boost_val = parseInt(jQuery("#" + attr_name + "_boost_amt").text());
		total_val = parseInt(jQuery("#" + attr_name + "_total").text());
		
		if(post_attr.length > 0) {
			post_attr += ", ";
			post_attr += attr_qty;
		} else {
			post_attr = "" + attr_qty;
		}
		
		text_code += attr_full_name;
		markdown_code += "|" + attr_full_name + "|";
		if(boost_val > 0) {
			text_code += " (+" + boost_val + ")";
			markdown_code += "+" + boost_val;
		}
		markdown_code += "|" + total_val + "|\n";
		text_code += ": " + total_val + "\n";
	}
		
	share_url = 'http://virtualsports.ru/params/builder/{$oBuilder->getId()}';
	jQuery('#share_url').val(share_url);
	

	jQuery("#build_markdown").val(markdown_code);
	jQuery("#build_text").val(text_code);
	//jQuery("#share_button").attr("disabled","true");
	
	

</script>
{/if}
{include file='footer.tpl'}
