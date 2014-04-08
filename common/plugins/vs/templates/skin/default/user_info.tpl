
  {if $oUser}

    <div class="Popupinfo_UserMoreInfo">
      <div class="AvatarHolder">
        {assign var="oSession" value=$oUser->getSession()}
		{if $oSession}
        {assign var="dDateLastVisit" value=$oSession->getDateLast()}
        {assign var="bUserOnline" value=(time() - strtotime($dDateLastVisit))<900}
        
        <img src="{$oUser->getProfileAvatarPath(48)}" alt="avatar" class="avatar" title="{date_format date=$dDateLastVisit hours_back="12" minutes_back="60" now="60" day="day H:i" format="d F Y, H:i"} {if $oUser->getProfileSex()=='man'}{$aLang.Popupinfo_Was_Online_M}{elseif $oUser->getProfileSex()=='woman'}{$aLang.Popupinfo_Was_Online_W}{else}{$aLang.Popupinfo_Was_Online}{/if}" />
        {/if}
        {if $bUserOnline}
          <div class="OnlineStatus"></div>
        {/if}
        
        {if $oUserCurrent && $oUserCurrent->getId()!=$oUser->getId()}
          <br />
          <a class="Talk" href="{router page='talk'}add/?talk_users={$oUser->getLogin()}" title="{$aLang.user_write_prvmsg}"></a>
        {/if}
        
        {hook run='pi_user_info_avatar' oUser=$oUser}
      </div>
      <div class="TextHolder">
        {if $oUser->getProfileName()}
          <h3>{$oUser->getProfileName()|escape:'html'}</h3>
        {else}
          <h3>{$oUser->getLogin()}</h3>
        {/if}
        <div class="SecondLine">
          <span class="Sex {if $oUser->getProfileSex()=='man'}Man{elseif $oUser->getProfileSex()=='woman'}Woman{/if}">
            {if $oUser->getProfileSex()=='man'}
              {$aLang.Popupinfo_Sex_M}
            {elseif $oUser->getProfileSex()=='woman'}
              {$aLang.Popupinfo_Sex_W}
            {else}
              {$aLang.Popupinfo_Sex_O}
            {/if}
          </span>
          <span class="Skill">
            {$oUser->getSkill()}
          </span>
          <span class="Rating">
            {$oUser->getRating()}
          </span>
        </div>
        <div class="SecondLine Location">
          {if ($oUser->getProfileCountry() || $oUser->getProfileCity())}
            {if $oUser->getProfileCountry()}
              <a href="{router page='people'}country/{$oUser->getProfileCountry()|escape:'html'}/">{$oUser->getProfileCountry()|escape:'html'}</a>{if $oUser->getProfileCity()},{/if}
            {/if}
            {if $oUser->getProfileCity()}
              <a href="{router page='people'}city/{$oUser->getProfileCity()|escape:'html'}/">{$oUser->getProfileCity()|escape:'html'}</a>
            {/if}
          {/if}
        </div>
        <div class="SecondLine Publications">
          <dl>
            <dt>Топиков:</dt>
            <dd>{$iCountTopicUser}</dd>
          </dl>
          <dl>
            <dt>Комментариев:</dt>
            <dd>{$iCountCommentUser}</dd>
          </dl>
        </div>
        {hook run='pi_user_info_text' oUser=$oUser}
        
      </div>
      {hook run='pi_user_info_wrapper' oUser=$oUser}
    </div>

  {/if}
