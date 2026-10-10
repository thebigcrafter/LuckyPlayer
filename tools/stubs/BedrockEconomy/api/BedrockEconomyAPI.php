<?php

declare(strict_types=1);

namespace cooldogedev\BedrockEconomy\api;

final class BedrockEconomyAPI {
	public static function getInstance() : self {}

	public function addToPlayerBalance(string $player, int|float $amount) : void {}
}
