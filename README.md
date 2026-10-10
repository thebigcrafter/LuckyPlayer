<!-- [![Build Status](https://www.travis-ci.com/thebigcrafter/LuckyPlayer.svg?branch=main)](https://www.travis-ci.com/thebigcrafter/LuckyPlayer) -->
[![PoggitCI](https://poggit.pmmp.io/ci.shield/thebigcrafter/LuckyPlayer/LuckyPlayer)](https://poggit.pmmp.io/ci/thebigcrafter/LuckyPlayer/LuckyPlayer)
![GitHub all releases](https://img.shields.io/github/downloads/thebigcrafter/LuckyPlayer/total)
[![](https://poggit.pmmp.io/shield.state/LuckyPlayer)](https://poggit.pmmp.io/p/LuckyPlayer)
[![](https://poggit.pmmp.io/shield.dl.total/LuckyPlayer)](https://poggit.pmmp.io/p/LuckyPlayer)
# LuckyPlayer
**Give money to players when they join the server at lucky time.**  
For example: You config ```luckyMoney: 100``` and ```luckyNumber: 1000```. If player is the 1000th player join the server, they will have 100$  
``NOTE!`` Make sure [BedrockEconomy](https://github.com/cooldogedev/BedrockEconomy) is installed.
# Config
```yaml
luckyMoney: 100
# Players who join the 1000th server will receive $ 100
luckyNumber: 1000

message: "{PLAYER_NAME} is the {LUCKY_NUMBER}th player so he/she have {MONEY}$ for free!"
# {PLAYER_NAME} for the name of lucky player
# {MONEY} for the luckyMoney
# {LUCKY_NUMBER} for the luckyNumber
```
# Installation
- Download `LuckyPlayer.phar` from the latest release.
- Install BedrockEconomy if you want LuckyPlayer to award balances.
- Place `LuckyPlayer.phar` in the server's `plugins` folder and restart the server.

# License
Released under the GPL-2.0 license.
