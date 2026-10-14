<?php

declare(strict_types=1);

/**
 * Copyright TobyDev265
 * Released under the GNU General Public License v2.0 license
 * https://github.com/thebigcrafter/LuckyPlayer#GPL-2.0-1
 */

namespace tobydev27\LuckyPlayer;

use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use thebigcrafter\Hydrogen\Hydrogen;
use function is_float;
use function is_int;
use function is_string;
use function str_replace;

class Main extends PluginBase implements Listener {

	private Config $data;

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		Hydrogen::checkForUpdates($this);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
	}

	public function onJoin(PlayerJoinEvent $e) : void {
		$player = $e->getPlayer();
		$luckyNumberB = $this->data->get("number", 0);
		if (!is_int($luckyNumberB)) {
			$luckyNumberB = 0;
		}
		$this->data->set("number", $luckyNumberB + 1);
		$luckyNumberA = $this->data->get("number");
		$luckyNumber = $this->getNumberConfig("luckyNumber", 0);
		$luckyMoney = $this->getNumberConfig("luckyMoney", 0);
		if ($luckyNumberA === $luckyNumber) {
			BedrockEconomyAPI::getInstance()->addToPlayerBalance(
				$player->getName(),
				(int) $luckyMoney,
				function (bool $updated) use ($player, $luckyMoney, $luckyNumber) : void {
					if (!$updated) {
						$this->getLogger()->warning("The lucky reward transaction failed; the join counter was not reset.");
						return;
					}

					$luckyMessage_1 = str_replace("{PLAYER_NAME}", $player->getName(), $this->getStringConfig("message"));
					$luckyMessage_2 = str_replace("{MONEY}", (string) $luckyMoney, $luckyMessage_1);
					$luckyMessage_3 = str_replace("{LUCKY_NUMBER}", (string) $luckyNumber, $luckyMessage_2);
					$player->sendMessage($luckyMessage_3);
					$this->data->set("number", 0);
					$this->data->save();
				},
			);
		}
		$this->data->save();
	}

	private function getNumberConfig(string $key, int|float $default) : int|float {
		$value = $this->getConfig()->get($key, $default);
		return is_int($value) || is_float($value) ? $value : $default;
	}

	private function getStringConfig(string $key) : string {
		$value = $this->getConfig()->get($key, "");
		return is_string($value) ? $value : "";
	}
}
