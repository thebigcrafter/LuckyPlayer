<?php

/**
 * Copyright TobyDev265
 * Released under the GNU General Public License v2.0 license
 * https://github.com/thebigcrafter/LuckyPlayer#GPL-2.0-1
 */

namespace TobyDev265\LuckyPlayer;

use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use thebigcrafter\Hydrogen\Hydrogen;

class Main extends PluginBase implements Listener {

	private Config $data;

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		Hydrogen::checkForUpdates($this);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
	}

	public function onJoin(PlayerJoinEvent $e) {
		$player = $e->getPlayer();
		$luckyNumberB = $this->data->get("number");
		$this->data->set("number", $luckyNumberB + 1);
		$luckyNumberA = $this->data->get("number");
		if ($luckyNumberA == $this->getConfig()->get("luckyNumber")) {
			BedrockEconomyAPI::getInstance()->addToPlayerBalance($player->getName(), $this->getConfig()->get("luckyMoney"));
			$luckyMessage_1 = str_replace("{PLAYER_NAME}", $player->getName(), $this->getConfig()->get("message"));
			$luckyMessage_2 = str_replace("{MONEY}", $this->getConfig()->get("luckyMoney"), $luckyMessage_1);
			$luckyMessage_3 = str_replace("{LUCKY_NUMBER}", $this->getConfig()->get("luckyNumber"), $luckyMessage_2);
			$player->sendMessage($luckyMessage_3);
			$this->data->set("number", 0);
		}
		$this->data->save();
	}
}
