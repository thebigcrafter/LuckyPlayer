![GitHub all releases](https://img.shields.io/github/downloads/thebigcrafter/LuckyPlayer/total)
[![License](https://img.shields.io/github/license/thebigcrafter/LuckyPlayer)](https://github.com/thebigcrafter/LuckyPlayer#GPL-2.0-1)
# LuckyPlayer
**Give money to players when they join an Axolotl-PM server at a configured lucky time.**
For example, with `luckyMoney: 100` and `luckyNumber: 1000`, the 1000th player to join receives 100 through [BedrockEconomy](https://github.com/cooldogedev/BedrockEconomy).

BedrockEconomy must be installed because LuckyPlayer uses it to award the balance.
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
- Download `LuckyPlayer.phar` from [GitHub Releases](https://github.com/thebigcrafter/LuckyPlayer/releases). Use an older release only when investigating a compatibility issue.
- Install BedrockEconomy before enabling LuckyPlayer.
- Place `LuckyPlayer.phar` in the Axolotl-PM `plugins` folder and restart the server.

# License
Released under the GPL-2.0 license.
