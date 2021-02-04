<?php

/**
 * LuckyPlayer v1.0.0
 * Copyright TobyDev265
 * Released under the GNU General Public License v2.0 license
 * https://github.com/TobyDev265/LuckyPlayer/blob/main/LICENSE
 */

namespace TobyDev265\LuckyPlayer;

use pocketmine\{Server, Player};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\{Config, TextFormat as C};

use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener {
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
    }
    public function onJoin(PlayerJoinEvent $e) {
        $player = $e->getPlayer();
        $luckyNumberB = $this->data->get("number");
        $this->data->set("number", $luckyNumberB + 1);
        $this->data->save();
        $luckyNumberA = $this->data->get("number");
        if($luckyNumberA == $this->cfg->get("luckyNumber")) {
            EconomyAPI::getInstance()->addMoney($player, $this->cfg->get("luckyMoney"));
            $player->sendMessage($this->cfg->get("message"));
            $this->data->set("number", 0);
            $this->data->save();
        }
    }

}