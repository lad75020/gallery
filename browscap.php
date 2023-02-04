<?php

function get_browser_cached($user_agent)
{
	if(!apcu_exists($user_agent))
		apcu_add($user_agent,get_browser($user_agent, true),0);

	return apcu_fetch($user_agent);
}

?>