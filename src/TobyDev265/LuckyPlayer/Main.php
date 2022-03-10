<?php

/**
 * LuckyPlayer v1.0.2
 * Copyright TobyDev265
 * Released under the GNU General Public License v2.0 license
 * https://github.com/TobyDev265/LuckyPlayer/blob/main/LICENSE
 */

namespace TobyDev265\LuckyPlayer;

use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{

    private Config $cfg;
    private Config $data;

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
    }

    public function onJoin(PlayerJoinEvent $e)
    {
        $player = $e->getPlayer();
        $luckyNumberB = $this->data->get("number");
        $this->data->set("number", $luckyNumberB + 1);
        $luckyNumberA = $this->data->get("number");
        if ($luckyNumberA == $this->cfg->get("luckyNumber")) {
            BedrockEconomyAPI::getInstance()->addToPlayerBalance($player->getName(), $this->cfg->get("luckyMoney"));
            $luckyMessage_1 = str_replace("{PLAYER_NAME}", $player->getName(), $this->cfg->get("message"));
            $luckyMessage_2 = str_replace("{MONEY}", $this->cfg->get("luckyMoney"), $luckyMessage_1);
            $luckyMessage_3 = str_replace("{LUCKY_NUMBER}", $this->cfg->get("luckyNumber"), $luckyMessage_2);
            $player->sendMessage($luckyMessage_3);
            $this->data->set("number", 0);
        }
        $this->data->save();
    }
}